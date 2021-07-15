<?php

namespace LukaPeharda\PayPal\Billing;

class PaymentPreferences
{
    /**
     * @var bool
     */
    protected $autoBillOutstanding = true;

    /**
     * @var int
     */
    protected $paymentFailureThreshold = 2;

    /**
     * @var FixedPrice
     */
    protected $setupFee;

     /**
     * Create payment preferences object from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $paymentPreferences = new PaymentPreferences;

        if (isset($data['auto_bill_outstanding'])) {
            $paymentPreferences->setAutoBillOutstanding((bool) $data['auto_bill_outstanding']);
        }

        if (isset($data['payment_failure_threshold'])) {
            $paymentPreferences->setPaymentFailureThreshold((int) $data['payment_failure_threshold']);
        }

        if (isset($data['setup_fee'])) {
            $paymentPreferences->setSetupFee(FixedPrice::fromArray((array) $data['setup_fee']));
        }

        return $paymentPreferences;
    }

    /**
     * Return payment preferences as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'auto_bill_outstanding' => $this->getAutoBillOutstanding(),
            'payment_failure_threshold' => $this->getPaymentFailureThreshold(),
            'setup_fee' => $this->getSetupFee() && $this->getSetupFee()->getValue() > 0 ? $this->getSetupFee()->toArray() : null,
        ];
    }

    /**
     * Return auto bill outstanding.
     *
     * @return  bool
     */
    public function getAutoBillOutstanding()
    {
        return $this->autoBillOutstanding;
    }

    /**
     * Set auto bill outstanding.
     *
     * @param   bool  $autoBillOutstanding
     *
     * @return  self
     */
    public function setAutoBillOutstanding($autoBillOutstanding)
    {
        $this->autoBillOutstanding = $autoBillOutstanding;

        return $this;
    }

    /**
     * Return payment failure threshold.
     *
     * @return  bool
     */
    public function getPaymentFailureThreshold()
    {
        return $this->paymentFailureThreshold;
    }

    /**
     * Set payment failure threshold.
     *
     * @param   int  $paymentFailureThreshold
     *
     * @return  self
     */
    public function setPaymentFailureThreshold($paymentFailureThreshold)
    {
        $this->paymentFailureThreshold = $paymentFailureThreshold;

        return $this;
    }

    /**
     * Return setup fee (fixed price object).
     *
     * @return  FixedPrice
     */
    public function getSetupFee()
    {
        return $this->setupFee;
    }

    /**
     * Set setup fee as "FixedPrice" object as it has the same params.
     *
     * @param   FixedPrice  $setupFee
     *
     * @return  self
     */
    public function setSetupFee($setupFee)
    {
        $this->setupFee = $setupFee;

        return $this;
    }
}
