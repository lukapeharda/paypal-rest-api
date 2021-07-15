<?php

namespace LukaPeharda\PayPal\Billing;

class FixedPrice
{
    /**
     * @var float
     */
    protected $value = 0;

    /**
     * @var string
     */
    protected $currencyCode = 'USD';

    /**
     * Init fixed price as array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $fixedPrice = new static();

        if (isset($data['value'])) {
            $fixedPrice->setValue((float) $data['value']);
        }

        if (isset($data['currency_code'])) {
            $fixedPrice->setCurrencyCode($data['currency_code']);
        }

        return $fixedPrice;
    }

    /**
     * Return object as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'value' => $this->getValue(),
            'currency_code' => $this->getCurrencyCode(),
        ];
    }

    /**
     * Return value amount.
     *
     * @return  float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set value amount.
     *
     * @param   float  $value
     *
     * @return  self
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Return currency used.
     *
     * @return  string ISO-4217
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * Set currency
     *
     * @param   string  $currencyCode  ISO-4127
     *
     * @return  self
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }
}
