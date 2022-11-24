<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    protected $table = 'addresses';
    protected $fillable = [
        'street',
        'city',
        'state',
        'zip'
    ];

    use HasFactory;
}
