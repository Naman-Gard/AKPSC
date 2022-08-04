<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'paper_setter',
        'interview',
        'line_1',
        'line_2',
        'pincode',
        'state',
        'district',
        'brief',
        'enquiry',
        'status'
    ];
}