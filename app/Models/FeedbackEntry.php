<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FeedbackEntry extends Model
{
    protected $fillable = [
        'unit_office',
        'transaction_date',
        'client_name',
        'client_type',
        'sex',
        'age',
        'region',
        'campus',
        'office',
        'service_availed',
        'email',
        'cc1_awareness',
        'cc2_visibility',
        'cc3_helpfulness',
        'suggestions',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'cc1_awareness' => 'integer',
        'cc2_visibility' => 'integer',
        'cc3_helpfulness' => 'integer',
        'age' => 'integer',
    ];

    // Get responses for this entry
    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }
}
