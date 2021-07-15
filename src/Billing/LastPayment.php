<?php

namespace LukaPeharda\PayPal\Billing;

class LastPayment
{
    /**
     * @var FixedPrice
     */
    protected $amount;

    /**
     * Datetime in ISO-8601 format
     *
     * @var string
     */
    protected $time;

    /**
     * Init from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $lastPayment = new self;

        if (isset($data['amount'])) {
            $lastPayment->setAmount(FixedPrice::fromArray((array) $data['amount']));
        }

        if (isset($data['time'])) {
            $lastPayment->setTime($data['time']);
        }

        return $lastPayment;
    }

    /**
     * Return last payment as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'amount' => $this->getAmount() ? $this->getAmount()->toArray() : null,
            'time' => $this->getTime(),
        ];
    }

    /**
     * Return amount/fixed price object.
     *
     * @return  FixedPrice
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set amount/fixed price.
     *
     * @param   FixedPrice  $amount
     *
     * @return  self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Return time of last payment.
     *
     * @return  string ISO-8601
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set datetime of last payment.
     *
     * @param   string  $time  ISO-8601
     *
     * @return  self
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }
}
