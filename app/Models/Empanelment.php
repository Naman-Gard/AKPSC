<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empanelment extends Model
{
    use HasFactory;

    protected $fillable=[
        'empanelment_id',
        'user_id',
        'file_number',
        'date_of_empanel',
        'secret_code1',
        'secret_code2'
    ];
}
