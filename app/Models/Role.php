<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'roles';

    public const ADMIN = 1;
    public const FORMAN = 2;
    public const DRIVER = 3;
    public const HELPER = 4;

    public const ROLES = ['Admin','Forman', 'Driver', 'Helper'];

    protected $fillable = [
        'user_id',
        'role',
    ];
}
