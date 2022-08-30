<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsWorking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'isworking',
        'designation',
        'serving',
        'isprior',
        'status',
        'organization_name'
    ];
}