<?php

namespace LukaPeharda\PayPal\Billing;

class BillingCycle
{
    const TENURE_TYPE_TRIAL = 'TRIAL';
    const TENURE_TYPE_REGULAR = 'REGULAR';

    /**
     * @var Frequency
     */
    protected $frequency;

    /**
     * @var PricingScheme
     */
    protected $pricingScheme;

    /**
     * @var string
     */
    protected $tenureType = 'REGULAR';

    /**
     * @var int
     */
    protected $sequence = 1;

    /**
     * @var int
     */
    protected $totalCycles = 0;

    /**
     * Create billing cycle object from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $billingCycle = new BillingCycle;

        if (isset($data['frequency'])) {
            $billingCycle->setFrequency(Frequency::fromArray((array) $data['frequency']));
        }

        if (isset($data['pricing_scheme'])) {
            $billingCycle->setPricingScheme(PricingScheme::fromArray((array) $data['pricing_scheme']));
        }

        if (isset($data['tenure_type'])) {
            $billingCycle->setTenureType($data['tenure_type']);
        }

        if (isset($data['sequence'])) {
            $billingCycle->setSequence((int) $data['sequence']);
        }

        if (isset($data['total_cycles'])) {
            $billingCycle->setTotalCycles((int) $data['total_cycles']);
        }

        return $billingCycle;
    }

    /**
     * Return billing cycle as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'frequency' => $this->getFrequency()->toArray(),
            'pricing_scheme' => $this->getPricingScheme()->toArray(),
            'tenure_type' => $this->getTenureType(),
            'sequence' => $this->getSequence(),
            'total_cycles' => $this->getTotalCycles(),
        ];
    }

    /**
     * Return frequency.
     *
     * @return  Frequency
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Set frequency.
     *
     * @param   Frequency  $frequency
     *
     * @return  self
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Return pricing scheme.
     *
     * @return  PricingScheme
     */
    public function getPricingScheme()
    {
        return $this->pricingScheme;
    }

    /**
     * Set pricing scheme.
     *
     * @param   PricingScheme  $pricingScheme
     *
     * @return  self
     */
    public function setPricingScheme($pricingScheme)
    {
        $this->pricingScheme = $pricingScheme;

        return $this;
    }

    /**
     * Return tenureType.
     *
     * @return  string
     */
    public function getTenureType()
    {
        return $this->tenureType;
    }

    /**
     * Set tenureType.
     *
     * @param   string  $tenureType
     *
     * @return  self
     */
    public function setTenureType($tenureType)
    {
        $this->tenureType = $tenureType;

        return $this;
    }

    /**
     * Return sequence.
     *
     * @return  int
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * Set sequence.
     *
     * @param   int  $sequence
     *
     * @return  self
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;

        return $this;
    }

    /**
     * Return total cycles.
     *
     * @return  int
     */
    public function getTotalCycles()
    {
        return $this->totalCycles;
    }

    /**
     * Set total cycles.
     *
     * @param   int  $totalCycles
     *
     * @return  self
     */
    public function setTotalCycles($totalCycles)
    {
        $this->totalCycles = $totalCycles;

        return $this;
    }
}
