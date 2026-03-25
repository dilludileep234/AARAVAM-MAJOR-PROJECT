<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'user_id',
        'student_name',
        'reg_no',
        'semester',
        'department',
        'email',
        'status'
    ];

    /**
     * Get the items registered for this registration.
     */
    public function items()
    {
        return $this->hasMany(RegistrationItem::class);
    }
}
