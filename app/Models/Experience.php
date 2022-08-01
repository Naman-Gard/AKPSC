<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'isworking',
        'designation',
        'serving',
        'type',
        'year',
        'specify',
        'org_type',
        'org_name',
        'org_year',
    ];
}