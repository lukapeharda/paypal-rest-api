<?php

namespace LukaPeharda\PayPal\Environment;

class SandboxEnvironment extends PayPalEnvironment
{
    /**
     * Return API base URL for sandbox environment.
     *
     * @return  string
     */
    public function baseUrl()
    {
        return "https://api.sandbox.paypal.com";
    }
}
