<?php

namespace App\Services;

use GuzzleHttp\Client;

class SmscService
{
    /**
     * Send SMS message.
     *
     * @param string $phones Phone numbers to send the message to (comma-separated).
     * @param string $message The message content.
     * @return int The HTTP status code of the response.
     */
    public function sendMessage(string $phone_number,string $message)
    {
        $client = new Client();

        $response = $client->request('POST', 'https://smsc.ru/sys/send.php', [
            'form_params' => [
                'login' => env('SMS_API_LOGIN'),
                'psw' => env('SMS_API_PASSWORD'),
                'phones' => $phone_number,
                'mes' => $message,
            ]
        ]);

        $statusCode = $response->getStatusCode();

        return $statusCode;
    }
}
