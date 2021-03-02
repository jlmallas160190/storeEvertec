<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends BaseModel
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
