<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_mobile',
        'status',
        'subtotal',
        'tax',
        'discount',
        'total',
        'customer_id',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
    public function cusrtomer()
    {
        return $this->belongsTo(Customer::class);
    }

}
