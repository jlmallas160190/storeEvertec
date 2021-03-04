<?php

namespace App\Jobs;

use App\Constants\OrderStatus;
use App\Repositories\OrderRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OrderStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $requestId;
    protected $orderId;

    public $tries = 5;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($requestId, $orderId)
    {
        $this->requestId = $requestId;
        $this->orderId = $orderId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(OrderRepository $order)
    {
        Log::info('Starting OrderStatusJob with the Id [' . $this->requestId . ']');
        $result = $order->getTransactionStatus($this->requestId);
        Log::info('Status [' . $result->status->status . ']');
        if ($result->status->status !== OrderStatus::PENDING) {
            $orderFound = $order->findById($this->orderId);
            $orderFound->status = $result->status->status;
            $orderFound->save();
        } else {
            return $this->release(now()->addMinute(1));
        }

    }
}
