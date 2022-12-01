<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signatures extends Model
{
    use HasFactory;

    public const CUSTOMER_AT_ORIGIN = 'cusorg';
    public const CUSTOMER_AT_DESTINATION = 'cusdest';
    public const CARRIER_AT_ORIGIN = 'carorg';
    public const CARRIER_AT_DESTINATION = 'cardest';

    protected $table = "signatures";
    protected $fillable = [
        'signature',
        'category_id',
        'wh',
    ];
}
