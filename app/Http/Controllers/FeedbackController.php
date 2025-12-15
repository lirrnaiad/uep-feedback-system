<?php

namespace App\Http\Controllers;

use App\Models\FeedbackEntry;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Show the feedback form.
     */
    public function create()
    {
        $questions = Question::where('is_active', true)->orderBy('code')->get();
        
        return view('feedback.create', compact('questions'));
    }

    /**
     * Store the feedback entry and responses.
     */
    public function store(Request $request)
    {
        // Validate the feedback entry data
        $validated = $request->validate([
            'unit_office' => 'required|string|max:255',
            'transaction_date' => 'required|date',
            'client_name' => 'nullable|string|max:255',
            'client_type' => 'required|string|in:Citizen,Business,Internal,External',
            'sex' => 'required|string|in:Male,Female',
            'age' => 'required|integer|min:1|max:150',
            'region' => 'required|string|max:255',
            'campus' => 'required|string|in:UEP Main Campus (Catarman),UEP Laoang Campus,UEP Catubig Campus',
            'office' => 'required|string|max:255',
            'service_availed' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'cc1_awareness' => 'required|integer|min:1|max:4',
            'cc2_visibility' => 'nullable|integer|min:0|max:4',
            'cc3_helpfulness' => 'nullable|integer|min:0|max:4',
            'suggestions' => 'nullable|string',
            'responses' => 'required|array',
            'responses.*' => 'required|integer|min:0|max:5',
        ]);

        // Create the feedback entry
        $feedbackEntry = FeedbackEntry::create([
            'unit_office' => $validated['unit_office'],
            'transaction_date' => $validated['transaction_date'],
            'client_name' => $validated['client_name'] ?? null,
            'client_type' => $validated['client_type'],
            'sex' => $validated['sex'],
            'age' => $validated['age'],
            'region' => $validated['region'],
            'campus' => $validated['campus'],
            'office' => $validated['office'],
            'service_availed' => $validated['service_availed'],
            'email' => $validated['email'] ?? null,
            'cc1_awareness' => $validated['cc1_awareness'],
            'cc2_visibility' => $validated['cc2_visibility'] ?? null,
            'cc3_helpfulness' => $validated['cc3_helpfulness'] ?? null,
            'suggestions' => $validated['suggestions'] ?? null,
        ]);

        // Create responses for each question
        $questions = Question::where('is_active', true)->orderBy('code')->get();
        
        foreach ($questions as $question) {
            if (isset($validated['responses'][$question->id])) {
                Response::create([
                    'feedback_entry_id' => $feedbackEntry->id,
                    'question_id' => $question->id,
                    'score' => $validated['responses'][$question->id],
                ]);
            }
        }

        return redirect()->route('feedback.create')
            ->with('success', 'Thank you for your feedback! Your response has been recorded.');
    }
}
