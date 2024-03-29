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
        'condition',
        'blankets',
    ];

    public function category(){
        return $this->belongsTo(InventoryCategory::class);
    }

    public function images(){
        return $this->hasMany(InventoryImages::class, 'inventory_id');
    }
}
