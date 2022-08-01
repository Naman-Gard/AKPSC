<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'specialization',
        'super_specialization',
        'type',
        'name',
        'subject',
        'passing_year',
        'status'
    ];
}