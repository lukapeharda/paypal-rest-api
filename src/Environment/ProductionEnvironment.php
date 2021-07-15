<?php

namespace LukaPeharda\PayPal\Environment;

class ProductionEnvironment extends PayPalEnvironment
{
    /**
     * Return API base URL for production environment.
     *
     * @return  string
     */
    public function baseUrl()
    {
        return "https://api.paypal.com";
    }
}
