<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signatures extends Model
{
    use HasFactory;
    protected $table = "signatures";
    protected $fillable = [
        'signature',
        'category_id',
        'wh',
    ];
}
