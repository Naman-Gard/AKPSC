<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalStatus extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'register_id',
        'status',
        'empanelled',
        'blacklisted',
        'appointed',
        'dor'
    ];
}
