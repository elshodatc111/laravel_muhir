<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hodim extends Model{
    use HasFactory;
    protected $fillable = [
        'coato',
        'fio',
        'phone',
        'lavozim',
        'status',
    ];
}