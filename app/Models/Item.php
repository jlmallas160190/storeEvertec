<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quantity',
        'unit_price',
        'total',
        'tax',
        'subtotal',
        'description',
        'order_id',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
