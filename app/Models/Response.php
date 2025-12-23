<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Response extends Model
{
    protected $fillable = [
        'feedback_entry_id',
        'question_id',
        'score',
    ];

    protected $casts = [
        'score' => 'integer',
    ];

    // Get the feedback entry
    public function feedbackEntry(): BelongsTo
    {
        return $this->belongsTo(FeedbackEntry::class);
    }

    // Get the question
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
