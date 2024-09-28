<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Korzinka extends Model{
    use HasFactory;
    protected $fillable = [
        'number',
        'coato',
        'fio',
        'opertor',
        'count',
        'scanner',
        'scanner_url',
    ];
}