<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    use HasFactory;

    protected $table = 'inventory_category';

    protected $fillable = [
        'user_id',
        'company_id',
        'customer_name',
        'customer_address',
    ];
}
