<?php

namespace App\Constants;

class OrderStatus
{
    const CREATED = 'CREATED';
    const PENDING = 'PENDING';
    const APPROVED = 'APPROVED';
    const FAILED = 'FAILED';
    const REJECTED = 'REJECTED';

    public static function get_order_status_array()
    {
        return array(
            OrderStatus::CREATED,
            OrderStatus::PENDING,
            OrderStatus::APPROVED,
            OrderStatus::REJECTED,
            OrderStatus::FAILED,
        );
    }
}
