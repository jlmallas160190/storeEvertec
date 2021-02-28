<?php

namespace App\Constants;

class OrderStatus
{
    const CREATED = 'CREATED';
    const PAYED = 'PAYED';
    const REJECTED = 'REJECTED';

    public static function get_order_status_array()
    {
        return array(
            OrderStatus::CREATED,
            OrderStatus::PAYED,
            OrderStatus::REJECTED,
        );
    }
}
