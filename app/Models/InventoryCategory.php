<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\InventoryList;

class InventoryCategory extends Model
{
    use HasFactory;

    protected $table = 'inventory_category';

    protected $fillable = [
        'user_id',
        'company_id',
        'customer_name',
        'dest_customer_name',
        'customer_phone',
        'dest_customer_phone',
        'address',
        'dest_address'
    ];

    public function creater(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function inventories(){
        return $this->hasMany(InventoryList::class,'category_id');
    }
}
