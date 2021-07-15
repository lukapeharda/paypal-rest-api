<?php

namespace LukaPeharda\PayPal\Service;

use LukaPeharda\PayPal\Client;

abstract class AbstractService
{
    /**
     * @var \LukaPeharda\PayPal\Client
     */
    protected $client;

    /**
     * Init client.
     *
     * @param   \LukaPeharda\PayPal\Client  $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Returns client.
     *
     * @return  \LukaPeharda\PayPal\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Runs a request on the underlying client.
     *
     * @param   string  $method
     * @param   string  $path
     * @param   array|null  $data
     *
     * @return  mixed
     */
    protected function request($method, $path, $data = null)
    {
        return $this->getClient()->request($method, $path, $data);
    }
}