<?php

namespace LukaPeharda\PayPal\Billing;

class PricingScheme
{
    /**
     * @var FixedPrice
     */
    protected $fixedPrice;

    /**
     * Init a new pricing scheme object from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $pricingScheme = new PricingScheme;

        if (isset($data['fixed_price'])) {
            $pricingScheme->setFixedPrice(FixedPrice::fromArray((array) $data['fixed_price']));
        }

        return $pricingScheme;
    }

    /**
     * Return pricing scheme as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'fixed_price' => $this->getFixedPrice()->toArray(),
        ];
    }

    /**
     * Return fixed price.
     *
     * @return  FixedPrice
     */
    public function getFixedPrice()
    {
        return $this->fixedPrice;
    }

    /**
     * Set fixed price object.
     *
     * @param   FixedPrice  $fixedPrice
     *
     * @return  self
     */
    public function setFixedPrice($fixedPrice)
    {
        $this->fixedPrice = $fixedPrice;

        return $this;
    }
}
