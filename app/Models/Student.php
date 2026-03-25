<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';   // 👈 IMPORTANT
    protected $fillable = ['Name', 'Age'];
}

