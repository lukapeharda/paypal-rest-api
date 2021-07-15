<?php

namespace LukaPeharda\PayPal\Billing;

class BillingInfo
{
    /**
     * @var LastPayment
     */
    protected $lastPayment;

    /**
     * Init object from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $billingInfo = new self;

        if (isset($data['last_payment'])) {
            $billingInfo->setLastPayment(LastPayment::fromArray((array) $data['last_payment']));
        }

        return $billingInfo;
    }

    /**
     * Return data as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'last_payment' => $this->getLastPayment() ? $this->getLastPayment()->toArray() : null,
        ];
    }

    /**
     * Return last payment.
     *
     * @return  LastPayment
     */
    public function getLastPayment()
    {
        return $this->lastPayment;
    }

    /**
     * Set last payment.
     *
     * @param   LastPayment  $lastPayment
     *
     * @return  self
     */
    public function setLastPayment($lastPayment)
    {
        $this->lastPayment = $lastPayment;

        return $this;
    }
}
