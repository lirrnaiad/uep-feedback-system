<?php

namespace Database\Seeders;

use App\Models\FeedbackEntry;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FeedbackTestDataSeeder extends Seeder
{
    public function run(): void
    {
        echo "Generating 1995 test feedback entries...\n";
        
        // Get all active questions
        $questions = Question::where('is_active', true)->get();
        
        if ($questions->isEmpty()) {
            echo "Error: No questions found. Run QuestionSeeder first.\n";
            return;
        }

        $campuses = [
            'UEP Main Campus (Catarman)',
            'UEP Laoang Campus',
            'UEP Catubig Campus'
        ];

        $offices = [
            'Registrar Office',
            'Cashier Office',
            'Library',
            'Admission Office',
            'Student Affairs',
            'Guidance Office',
            'IT Department',
            'Accounting Office',
            'Human Resource',
            'Medical Clinic'
        ];

        $clientTypes = ['Citizen', 'Business', 'Internal', 'External'];
        $sexes = ['Male', 'Female'];
        
        $regions = [
            'VIII',
        ];

        $services = [
            'Enrollment',
            'Certificate Request',
            'Transcript of Records',
            'ID Request',
            'Clearance',
            'Payment',
            'Book Borrowing',
            'Consultation',
            'Document Verification',
            'Scholarship Application'
        ];

        $names = [
            'Juan Dela Cruz', 'Maria Santos', 'Jose Reyes', 'Ana Garcia',
            'Pedro Martinez', 'Carmen Lopez', 'Miguel Rodriguez', 'Sofia Gonzales',
            'Carlos Hernandez', 'Isabel Perez', null, null // some anonymous
        ];

        $suggestions = [
            'Great service, very helpful staff!',
            'Process could be faster.',
            'Need more staff during peak hours.',
            'Very satisfied with the service.',
            'The office is clean and organized.',
            'Staff are very courteous.',
            'Waiting time is too long.',
            'Need better ventilation in the office.',
            'Online services would be helpful.',
            'Thank you for the excellent service!',
            null, null, null // some without suggestions
        ];

        // Generate entries spread over the last 30 days
        for ($i = 0; $i < 1995; $i++) {
            // Random date within last 30 days
            $daysAgo = rand(0, 29);
            $createdAt = Carbon::now()->subDays($daysAgo)->setTime(rand(8, 16), rand(0, 59));
            $transactionDate = $createdAt->copy()->subDays(rand(0, 2));

            // Create feedback entry
            $entry = FeedbackEntry::create([
                'unit_office' => $offices[array_rand($offices)],
                'transaction_date' => $transactionDate,
                'client_name' => $names[array_rand($names)],
                'client_type' => $clientTypes[array_rand($clientTypes)],
                'sex' => $sexes[array_rand($sexes)],
                'age' => rand(18, 65),
                'region' => $regions[array_rand($regions)],
                'campus' => $campuses[array_rand($campuses)],
                'office' => $offices[array_rand($offices)],
                'service_availed' => $services[array_rand($services)],
                'email' => rand(0, 100) > 30 ? 'user' . $i . '@example.com' : null,
                'cc1_awareness' => rand(1, 4),
                'cc2_visibility' => rand(0, 10) > 2 ? rand(1, 4) : null, // 20% N/A
                'cc3_helpfulness' => rand(0, 10) > 2 ? rand(1, 4) : null, // 20% N/A
                'suggestions' => $suggestions[array_rand($suggestions)],
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            // Create SQD responses
            foreach ($questions as $question) {
                $score = rand(0, 100) > 5 ? rand(1, 5) : 0; // 5% N/A responses
                
                Response::create([
                    'feedback_entry_id' => $entry->id,
                    'question_id' => $question->id,
                    'score' => $score,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }

            // Progress indicator
            if (($i + 1) % 100 == 0) {
                echo "Generated " . ($i + 1) . " entries...\n";
            }
        }

        echo "\nDone! Generated 1995 test feedback entries.\n";
        echo "Total entries now: " . FeedbackEntry::count() . "\n";
    }
}
