<?php

namespace App\Services;

use Carbon\Carbon;

class PlaceToPayService
{

    public function getCredentials()
    {
        $nonce = $this->generateNonce();
        $seed = Carbon::now()->format('c');
        $tranKey = base64_encode(sha1($nonce . $seed . env('PLACE_TO_PAY_SECRETKEY'), true));
        return [
            'login' => env('PLACE_TO_PAY_LOGIN'),
            'tranKey' => $tranKey,
            'nonce' => base64_encode($nonce),
            "seed" => $seed,
        ];
    }

    public function generateNonce()
    {
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        return $nonce;
    }
}
