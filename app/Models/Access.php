<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    use HasFactory;

    protected $table = 'accesses';

    protected $fillable = [
        'user_id',
        'category_id',
        'creator_id',
    ];
}
