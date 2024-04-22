<?php

namespace App\Helpers;

class GetClientIP
{
    /**
     * Retrieves the client's IP address from the $_SERVER superglobal array.
     *
     * This function checks various HTTP headers to determine the client's IP address.
     * It first checks for the 'HTTP_CLIENT_IP' header, then the 'HTTP_CF_CONNECTING_IP' header
     * (when behind Cloudflare), then the 'HTTP_X_FORWARDED' header, then the 'HTTP_X_FORWARDED_FOR'
     * header, then the 'HTTP_FORWARDED' header, then the 'HTTP_FORWARDED_FOR' header, and finally
     * the 'REMOTE_ADDR' header. If none of these headers are present, it returns the string '0.0.0.0'.
     *
     * @return string The client's IP address.
     */
    public static function get(): string
    {
        return $clientIP = $_SERVER['HTTP_CLIENT_IP']
            ?? $_SERVER["HTTP_CF_CONNECTING_IP"]
            ?? $_SERVER['HTTP_X_FORWARDED']
            ?? $_SERVER['HTTP_X_FORWARDED_FOR']
            ?? $_SERVER['HTTP_FORWARDED']
            ?? $_SERVER['HTTP_FORWARDED_FOR']
            ?? $_SERVER['REMOTE_ADDR']
            ?? '0.0.0.0';
    }
}
