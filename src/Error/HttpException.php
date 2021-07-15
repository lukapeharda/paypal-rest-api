<?php

namespace LukaPeharda\PayPal\Error;

use PayPalHttp\HttpException as PayPalHttpException;

class HttpException extends PayPalHttpException
{
    /**
     * Init parent.
     *
     * @param   string  $message
     * @param   int  $statusCode
     * @param   array  $headers
     */
    public function __construct($message, $statusCode, $headers)
    {
        parent::__construct($message, $statusCode, $headers);
    }

    /**
     * Create wrapped HTTP exception.
     *
     * @param   PayPalHttpException  $exception
     *
     * @return  self
     */
    public static function fromBase(PayPalHttpException $exception)
    {
        return new self($exception->getMessage(), $exception->statusCode, $exception->headers);
    }
}
