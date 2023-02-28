<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'path',
        'creator_id',
    ];

    public function owner(){
        return $this->belongsTo(User::class,'creator_id');
    }
}
