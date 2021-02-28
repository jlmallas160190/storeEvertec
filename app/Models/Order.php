<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
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
