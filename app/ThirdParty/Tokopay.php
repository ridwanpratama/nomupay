<?php

namespace App\ThirdParty;

class Tokopay
{
    public function __invoke(string $channel, string $trxId, int $amount)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://api.tokopay.id/v1/order',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => [
                'merchant_id'    => env('tokopay.id'),
                'kode_channel'   => $channel,
                'reff_id'        => $trxId,
                'amount'         => $amount,
                'customer_name'  => session()->get('name'),
                'customer_email' => session()->get('email'),
                'customer_phone' => str_replace('-', '', session()->get('phone')),
                'expired_ts'     => 0,
                'signature'      => md5(env('tokopay.id')) . md5(env('tokopay.token')) . md5($trxId),
            ],
        ]);

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);

        if (isset($error_msg)) {
            return $error_msg;
        }
        return $response;
    }
}
