<?php

namespace LukaPeharda\PayPal;

use PayPalHttp\HttpRequest;

class Request extends HttpRequest
{
    /**
     * Wrap PayPal's HTTP request object with our own and set POST body if
     * applicable.
     *
     * @param   string  $path
     * @param   string  $method
     * @param   array|null  $data
     */
    public function __construct($path, $method, $data = null)
    {
        parent::__construct($path, $method);

        if ($method === 'POST' || $method === 'PUT' || $method === 'PATCH') {
            $this->headers['Content-Type'] = 'application/json';

            $this->body = $data;
        }
    }
}
