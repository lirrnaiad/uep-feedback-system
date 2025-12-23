<?php

namespace App\Http\Controllers;

use App\Models\FeedbackEntry;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Admin login page
    public function login()
    {
        return view('admin.login');
    }

    // Check password and login
    public function authenticate(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        // Check password from .env file
        $adminPassword = env('ADMIN_PASSWORD', 'admin123');

        if ($request->password === $adminPassword) {
            session(['admin_authenticated' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['password' => 'Incorrect password.']);
    }

    // Logout
    public function logout()
    {
        session()->forget('admin_authenticated');
        return redirect()->route('admin.login');
    }

    // Dashboard page
    public function dashboard()
    {
        try {
            $totalEntries = FeedbackEntry::count();
            $todayEntries = FeedbackEntry::whereDate('created_at', today())->count();
            $weekEntries = FeedbackEntry::where('created_at', '>=', now()->subDays(7))->count();
            $monthEntries = FeedbackEntry::whereMonth('created_at', now()->month)->count();

            // Get average SQD score
            $avgSqdScore = Response::where('score', '>', 0)->avg('score');

            // Get average CC scores
            $avgCc1 = FeedbackEntry::avg('cc1_awareness');
            $avgCc2 = FeedbackEntry::where('cc2_visibility', '>', 0)->avg('cc2_visibility');
            $avgCc3 = FeedbackEntry::where('cc3_helpfulness', '>', 0)->avg('cc3_helpfulness');

            // Count by campus
            $campusStats = FeedbackEntry::select('campus', DB::raw('count(*) as total'))
                ->groupBy('campus')
                ->get();

            // Count by client type
            $clientTypeStats = FeedbackEntry::select('client_type', DB::raw('count(*) as total'))
                ->groupBy('client_type')
                ->get();

            // Recent entries (last 10)
            $recentEntries = FeedbackEntry::orderBy('created_at', 'desc')
                ->take(10)
                ->get();

            // Daily trend for last 7 days
            $dailyTrend = FeedbackEntry::where('created_at', '>=', now()->subDays(7))
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            return view('admin.dashboard', compact(
                'totalEntries',
                'todayEntries',
                'weekEntries',
                'monthEntries',
                'avgSqdScore',
                'avgCc1',
                'avgCc2',
                'avgCc3',
                'campusStats',
                'clientTypeStats',
                'recentEntries',
                'dailyTrend'
            ));
        } catch (\Exception $e) {
            // Show error message if something goes wrong
            return view('admin.dashboard')->with('error', 'Unable to load dashboard data.');
        }
    }

    // Analytics page with filters
    public function analytics(Request $request)
    {
        try {
            $dateFrom = $request->input('date_from', now()->subMonths(1)->format('Y-m-d'));
            $dateTo = $request->input('date_to', now()->format('Y-m-d'));

            // Get base query
            $baseQuery = FeedbackEntry::whereBetween('created_at', [$dateFrom, $dateTo]);

            // Calculate SQD scores
            $questions = Question::where('is_active', true)->orderBy('code')->get();
            $sqdScores = [];
            foreach ($questions as $question) {
                $avgScore = Response::where('question_id', $question->id)
                    ->where('score', '>', 0)
                    ->avg('score');
                $sqdScores[] = [
                    'question' => $question,
                    'average' => round($avgScore, 2),
                    'responses' => Response::where('question_id', $question->id)->where('score', '>', 0)->count(),
                ];
            }

            // CC Analysis - had to fix the query cloning issue
            $ccAnalysis = [
                'cc1' => [
                    'average' => round(FeedbackEntry::whereBetween('created_at', [$dateFrom, $dateTo])->avg('cc1_awareness'), 2),
                    'distribution' => $this->getCcDistribution($dateFrom, $dateTo, 'cc1_awareness'),
                ],
                'cc2' => [
                    'average' => round(FeedbackEntry::whereBetween('created_at', [$dateFrom, $dateTo])->where('cc2_visibility', '>', 0)->avg('cc2_visibility'), 2),
                    'distribution' => $this->getCcDistribution($dateFrom, $dateTo, 'cc2_visibility'),
                ],
                'cc3' => [
                    'average' => round(FeedbackEntry::whereBetween('created_at', [$dateFrom, $dateTo])->where('cc3_helpfulness', '>', 0)->avg('cc3_helpfulness'), 2),
                    'distribution' => $this->getCcDistribution($dateFrom, $dateTo, 'cc3_helpfulness'),
                ],
            ];

            // Demographics - fixed the queries
            $demographics = [
                'gender' => FeedbackEntry::whereBetween('created_at', [$dateFrom, $dateTo])
                    ->select('sex', DB::raw('count(*) as total'))
                    ->groupBy('sex')
                    ->get(),
                'client_type' => FeedbackEntry::whereBetween('created_at', [$dateFrom, $dateTo])
                    ->select('client_type', DB::raw('count(*) as total'))
                    ->groupBy('client_type')
                    ->get(),
                'campus' => FeedbackEntry::whereBetween('created_at', [$dateFrom, $dateTo])
                    ->select('campus', DB::raw('count(*) as total'))
                    ->groupBy('campus')
                    ->get(),
                'age_groups' => $this->getAgeGroups($dateFrom, $dateTo),
            ];

            return view('admin.analytics', compact('sqdScores', 'ccAnalysis', 'demographics', 'dateFrom', 'dateTo'));
        } catch (\Exception $e) {
            return view('admin.analytics')->with('error', 'Unable to load analytics data.');
        }
    }

    /**
     * Show feedback entries list
     */
    public function entries(Request $request)
    {
        try {
            $query = FeedbackEntry::query()->with('responses.question');

            // Apply filters
            if ($request->filled('campus')) {
                $query->where('campus', $request->campus);
            }
            if ($request->filled('office')) {
                $query->where('office', 'LIKE', '%' . $request->office . '%');
            }
            if ($request->filled('client_type')) {
                $query->where('client_type', $request->client_type);
            }
            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }
            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            $entries = $query->orderBy('created_at', 'desc')->paginate(20);

            return view('admin.entries', compact('entries'));
        } catch (\Exception $e) {
            return view('admin.entries')->with('error', 'Unable to load entries.');
        }
    }

    /**
     * Show single feedback entry
     */
    public function showEntry($id)
    {
        try {
            $entry = FeedbackEntry::with('responses.question')->findOrFail($id);
            return view('admin.entry-detail', compact('entry'));
        } catch (\Exception $e) {
            return redirect()->route('admin.entries')->with('error', 'Entry not found.');
        }
    }

    /**
     * Show suggestions page
     */
    public function suggestions(Request $request)
    {
        try {
            $query = FeedbackEntry::whereNotNull('suggestions')->where('suggestions', '!=', '');

            // Apply filters
            if ($request->filled('search')) {
                $query->where('suggestions', 'LIKE', '%' . $request->search . '%');
            }

            $suggestions = $query->orderBy('created_at', 'desc')->paginate(20);

            return view('admin.suggestions', compact('suggestions'));
        } catch (\Exception $e) {
            return view('admin.suggestions')->with('error', 'Unable to load suggestions.');
        }
    }

    /**
     * Export entries to CSV
     */
    public function export(Request $request)
    {
        try {
            $query = FeedbackEntry::query()->with('responses.question');

            // Apply same filters as entries page
            if ($request->filled('campus')) {
                $query->where('campus', $request->campus);
            }
            if ($request->filled('office')) {
                $query->where('office', 'LIKE', '%' . $request->office . '%');
            }
            if ($request->filled('client_type')) {
                $query->where('client_type', $request->client_type);
            }
            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }
            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            $entries = $query->orderBy('created_at', 'desc')->get();
            $questions = Question::where('is_active', true)->orderBy('code')->get();

            $filename = 'feedback_export_' . now()->format('Y-m-d_His') . '.csv';

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            $callback = function() use ($entries, $questions) {
                $file = fopen('php://output', 'w');

                // Headers
                $header = [
                    'ID', 'Date Submitted', 'Transaction Date', 'Campus', 'Office',
                    'Client Name', 'Client Type', 'Sex', 'Age', 'Region', 'Service Availed',
                    'CC1 Awareness', 'CC2 Visibility', 'CC3 Helpfulness'
                ];

                // Add SQD question headers
                foreach ($questions as $question) {
                    $header[] = $question->code;
                }

                $header[] = 'Suggestions';

                fputcsv($file, $header);

                // Data rows
                foreach ($entries as $entry) {
                    $row = [
                        $entry->id,
                        $entry->created_at->format('Y-m-d H:i:s'),
                        $entry->transaction_date->format('Y-m-d'),
                        $entry->campus,
                        $entry->office,
                        $entry->client_name,
                        $entry->client_type,
                        $entry->sex,
                        $entry->age,
                        $entry->region,
                        $entry->service_availed,
                        $entry->cc1_awareness,
                        $entry->cc2_visibility ?? 'N/A',
                        $entry->cc3_helpfulness ?? 'N/A',
                    ];

                    // Add SQD responses
                    foreach ($questions as $question) {
                        $response = $entry->responses->firstWhere('question_id', $question->id);
                        $row[] = $response ? ($response->score == 0 ? 'N/A' : $response->score) : '';
                    }

                    $row[] = $entry->suggestions;

                    fputcsv($file, $row);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unable to export data.');
        }
    }

    // Helper function for CC distribution
    private function getCcDistribution($dateFrom, $dateTo, $column)
    {
        $distribution = [];
        $baseQuery = FeedbackEntry::whereBetween('created_at', [$dateFrom, $dateTo]);
        
        for ($i = 1; $i <= 4; $i++) {
            $distribution[$i] = (clone $baseQuery)->where($column, $i)->count();
        }
        
        $distribution['NA'] = (clone $baseQuery)
            ->where(function($q) use ($column) {
                $q->where($column, 0)->orWhereNull($column);
            })
            ->count();
            
        return $distribution;
    }

    // Helper function for age groups
    private function getAgeGroups($dateFrom, $dateTo)
    {
        $baseQuery = FeedbackEntry::whereBetween('created_at', [$dateFrom, $dateTo]);
        
        return [
            '18-24' => (clone $baseQuery)->whereBetween('age', [18, 24])->count(),
            '25-34' => (clone $baseQuery)->whereBetween('age', [25, 34])->count(),
            '35-44' => (clone $baseQuery)->whereBetween('age', [35, 44])->count(),
            '45-54' => (clone $baseQuery)->whereBetween('age', [45, 54])->count(),
            '55+' => (clone $baseQuery)->where('age', '>=', 55)->count(),
        ];
    }
}
