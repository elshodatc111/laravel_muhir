<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NaryadBlankaFaktura extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'coato',
        'coato_name',
        'count',
        'hodim',
        'operator',
        'scanner',
        'scanner_url',
    ];
}
