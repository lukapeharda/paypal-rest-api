<?php

namespace LukaPeharda\PayPal;

use PayPalHttp\HttpResponse;

class Response extends HttpResponse
{
    /**
     * Extend base response.
     *
     * @param   int  $statusCode
     * @param   array|string  $body
     * @param   array  $headers
     */
    public function __construct($statusCode, $body, $headers)
    {
        parent::__construct($statusCode, $body, $headers);
    }

    /**
     * Create wrapper response object from given PayPal response.
     *
     * @param   HttpResponse  $httpResponse
     *
     * @return  self
     */
    public static function fromBase(HttpResponse $httpResponse)
    {
        return new self($httpResponse->statusCode, $httpResponse->result, $httpResponse->headers);
    }
}
