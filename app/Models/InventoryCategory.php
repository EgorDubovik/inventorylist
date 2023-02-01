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
    public const PADDING = 0;
    public const PICKED_UP = 1;
    public const DELIVERED = 2;
    public const ARCHIVE = 4;

    public const STATUS = ['Created', 'Picked Up', 'Delivered', 'Archived'];

    protected $fillable = [
        'user_id',
        'company_id',
        'customer_name',
        'dest_customer_name',
        'customer_phone',
        'dest_customer_phone',
        'customer_email',
        'dest_customer_email',
        'address',
        'dest_address',
        'order_number',
        'tape_lot_number',
        'tape_color',
        'van_number',
        'status',
    ];

    public function creater(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function inventories(){
        return $this->hasMany(InventoryList::class,'category_id');
    }

    public function addressM(){
        return $this->hasOne(Addresses::class,'id','address');
    }

    public function dest_addressM(){
        return $this->hasOne(Addresses::class,'id','dest_address');
    }

    public function signatures(){
        return $this->hasMany(Signatures::class,'category_id');
    }

    public function accesses(){
        return $this->hasMany(Access::class,'category_id');
    }

    public function remark(){
        return $this->hasOne(Remarks::class,'category_id', 'id');
    }

}
