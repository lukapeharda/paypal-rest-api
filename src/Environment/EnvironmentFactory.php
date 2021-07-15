<?php

namespace LukaPeharda\PayPal\Environment;

use LukaPeharda\PayPal\Error\InvalidEnvironmentException;

class EnvironmentFactory
{
    /**
     * Create environment from give type and client credentials.
     *
     * @param   string  $clientId
     * @param   string  $clientSecret
     * @param   string  $environment
     *
     * @return  \PayPalHttp\Environment
     */
    public static function create($clientId, $clientSecret, $environment)
    {
        if ( ! in_array($environment, ['production', 'sandbox'])) {
            throw new InvalidEnvironmentException("Environment $environment is invalid. Only 'production' and 'sandbox' are allowed.");
        }

        if ($environment === 'production') {
            return new ProductionEnvironment($clientId, $clientSecret);
        }

        return new SandboxEnvironment($clientId, $clientSecret);
    }
}
