<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistrationItem extends Model
{
    protected $fillable = [
        'registration_id',
        'event_id',
        'score',
        'rank'
    ];

    /**
     * Get the registration that owns the item.
     */
    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    /**
     * Get the event associated with the item.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
