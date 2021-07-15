<?php

namespace LukaPeharda\PayPal\Service;

use LukaPeharda\PayPal\Client;

class ServiceFactory
{
    /**
     * @var array
     */
    private static $classMap = [
        'plans' => \LukaPeharda\PayPal\Service\PlansService::class,
        'orders' => \LukaPeharda\PayPal\Service\OrdersService::class,
        'captures' => \LukaPeharda\PayPal\Service\CapturesService::class,
        'products' => \LukaPeharda\PayPal\Service\ProductsService::class,
        'subscriptions' => \LukaPeharda\PayPal\Service\SubscriptionsService::class,
    ];

    /**
     * @var \LukaPeharda\PayPal\Client
     */
    private $client;

    /**
     * @var array
     */
    private $services;

    /**
     * Init client.
     *
     * @param   \LukaPeharda\PayPal\Client  $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->services = [];
    }

    /**
     * Accessor for API service.
     *
     * Does a lazy instantiation for a service and saves initialized service to
     * an array.
     *
     * @param   string  $name
     *
     * @return  \LukaPeharda\PayPal\Service\AbstractService
     */
    public function __get($name)
    {
        $serviceClass = $this->getServiceClass($name);

        if (null !== $serviceClass) {
            if ( ! \array_key_exists($name, $this->services)) {
                $this->services[$name] = new $serviceClass($this->client);
            }

            return $this->services[$name];
        }

        \trigger_error('Undefined property: ' . static::class . '::$' . $name);

        return null;
    }

    /**
     * Returns service class from a given name.
     *
     * @param   string  $name
     *
     * @return  string
     */
    protected function getServiceClass($name)
    {
        return \array_key_exists($name, self::$classMap) ? self::$classMap[$name] : null;
    }
}