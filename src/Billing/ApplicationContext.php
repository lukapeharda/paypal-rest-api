<?php

namespace LukaPeharda\PayPal\Billing;

class ApplicationContext
{
    /**
     * @var string
     */
    protected $brandName;

    /**
     * @var string
     */
    protected $locale = 'en-US';

    /**
     * @var string
     */
    protected $returnUrl;

    /**
     * @var string
     */
    protected $cancelUrl;

    /**
     * Init application context from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $applicationContext = new self;

        if (isset($data['brand_name'])) {
            $applicationContext->setBrandName($data['brand_name']);
        }

        if (isset($data['locale'])) {
            $applicationContext->setLocale($data['locale']);
        }

        if (isset($data['return_url'])) {
            $applicationContext->setReturnUrl($data['return_url']);
        }

        if (isset($data['cancel_url'])) {
            $applicationContext->setCancelUrl($data['cancel_url']);
        }

        return $applicationContext;
    }

    /**
     * Return as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'brand_name' => $this->getBrandName(),
            'locale' => $this->getLocale(),
            'return_url' => $this->getReturnUrl(),
            'cancel_url' => $this->getCancelUrl(),
        ];
    }

    /**
     * Return brand name.
     *
     * @return  string
     */
    public function getBrandName()
    {
        return $this->brandName;
    }

    /**
     * Set brand name.
     *
     * @param   string  $brandName
     *
     * @return  self
     */
    public function setBrandName($brandName)
    {
        $this->brandName = $brandName;

        return $this;
    }

    /**
     * Return locale.
     *
     * @return  string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set locale.
     *
     * @param   string  $locale
     *
     * @return  self
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Return return URL.
     *
     * @return  string
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    /**
     * Set return URL.
     *
     * @param   string  $returnUrl
     *
     * @return  self
     */
    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;

        return $this;
    }

    /**
     * Return cancel URL.
     *
     * @return  string
     */
    public function getCancelUrl()
    {
        return $this->cancelUrl;
    }

    /**
     * Set cancel URL.
     *
     * @param   string  $cancelUrl
     *
     * @return  self
     */
    public function setCancelUrl($cancelUrl)
    {
        $this->cancelUrl = $cancelUrl;

        return $this;
    }
}
