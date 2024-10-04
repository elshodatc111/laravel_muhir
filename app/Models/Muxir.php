<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muxir extends Model
{
    use HasFactory;
    protected $fillable = [
        'coato',
        'number',
        'type',
        'status',
        'faktura',
        'meneger',
    ];
}