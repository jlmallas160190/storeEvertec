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
        'customer_document_number',
        'status',
        'subtotal',
        'tax',
        'discount',
        'total',
        'request_id',
        'customer_id',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
