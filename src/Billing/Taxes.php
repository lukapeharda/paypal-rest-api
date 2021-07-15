<?php

namespace LukaPeharda\PayPal\Billing;

class Taxes
{
    /**
     * @var float
     */
    protected $percentage = 0;

    /**
     * @var bool
     */
    protected $inclusive = false;

    /**
     * Init taxes from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $taxes = new Taxes;

        if (isset($data['percentage'])) {
            $taxes->setPercentage((float) $data['percentage']);
        }

        if (isset($data['inclusive'])) {
            $taxes->setInclusive(!! $data['inclusive']);
        }

        return $taxes;
    }

    /**
     * Return taxes as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'percentage' => $this->getPercentage(),
            'inclusive' => $this->getInclusive(),
        ];
    }

    /**
     * Return tax percentage.
     *
     * @return  float
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * Set tax percentage.
     *
     * @param   float  $percentage
     *
     * @return  self
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * Check if tax amount is inclusive.
     *
     * @return  bool
     */
    public function getInclusive()
    {
        return $this->inclusive;
    }

    /**
     * Set tax inclusivity.
     *
     * @param   bool  $inclusive
     *
     * @return  self
     */
    public function setInclusive($inclusive)
    {
        $this->inclusive = $inclusive;

        return $this;
    }
}
