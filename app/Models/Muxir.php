<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muxir extends Model{
    use HasFactory;
    protected $fillable = [
        'number',
        'operator',
        'type',
        'number_id',
    ];
}