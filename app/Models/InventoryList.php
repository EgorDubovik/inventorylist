<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryList extends Model
{
    use HasFactory;

    protected $table = 'inventory_list';

    protected $fillable =[
        'category_id',
        'number',
        'furniture_name',
    ];
}
