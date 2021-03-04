<?php

namespace App\Constants;

class OrderStatus
{
    const CREATED = 'CREATED';
    const IN_PROCESS = 'IN_PROCESS';
    const PAYED = 'PAYED';
    const REJECTED = 'REJECTED';

    public static function get_order_status_array()
    {
        return array(
            OrderStatus::CREATED,
            OrderStatus::IN_PROCESS,
            OrderStatus::PAYED,
            OrderStatus::REJECTED,
        );
    }
}
