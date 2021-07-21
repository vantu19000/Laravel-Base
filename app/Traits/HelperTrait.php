<?php


namespace App\Traits;


trait HelperTrait
{
    function generateRandomString($length = 6) : string {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function isBase64($str) : bool {
        return base64_encode(base64_decode($str, true)) === $str;
    }
}
