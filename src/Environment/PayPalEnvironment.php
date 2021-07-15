<?php

namespace LukaPeharda\PayPal\Environment;

use PayPalHttp\Environment;

abstract class PayPalEnvironment implements Environment
{
    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * Initialize with client ID and secret.
     *
     * @param   string  $clientId
     * @param   string  $clientSecret
     */
    public function __construct($clientId, $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * Generate base64 encoded authorization string.
     *
     * @return  string
     */
    public function authorizationString()
    {
        return base64_encode($this->clientId . ":" . $this->clientSecret);
    }
}
