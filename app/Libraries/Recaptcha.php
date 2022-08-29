<?php

namespace App\Libraries;

class Recaptcha
{

    function send($response, $ip)
    {

        $curl   = curl_init();
        curl_setopt_array($curl,
            [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_USERAGENT      => $_SERVER['HTTP_USER_AGENT'],
                CURLOPT_FOLLOWLOCATION => 1,
                CURLOPT_URL            => 'https://www.google.com/recaptcha/api/siteverify',
                CURLOPT_POST           => 1,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_VERBOSE        => 1,
                CURLOPT_POSTFIELDS     => [
                    'secret'   => env('RECAPTCHA_SECRETKEY'),
                    'response' => $response,
                    'remoteip' => $ip
                ],
        ]);
        $result = json_decode(curl_exec($curl));
        curl_close($curl);

        return $result;
    }
}