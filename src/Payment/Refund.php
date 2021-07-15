<?php

namespace LukaPeharda\PayPal\Payment;

class Refund
{
    const STATE_PENDING = 'pending';
    const STATE_COMPLETED = 'completed';

    /**
     * @var string
     */
    protected $saleId;

    /**
     * @var string
     */
    protected $state = 'pending';

    /**
     * @var float
     */
    protected $total;

    /**
     * ISO-4217
     *
     * @var string
     */
    protected $currency;

    /**
     * ISO-8601
     *
     * @var string
     */
    protected $createTime;

    /**
     * @var string
     */
    protected $custom;

    /**
     * Init data from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $refund = new static;

        if (isset($data['sale_id'])) {
            $refund->setSaleId($data['sale_id']);
        }

        if (isset($data['amount'], $data['amount']['total'])) {
            $refund->setTotal((float) $data['amount']['total']);
        }

        if (isset($data['amount'], $data['amount']['currency'])) {
            $refund->setCurrency($data['amount']['currency']);
        }

        if (isset($data['create_time'])) {
            $refund->setCreateTime($data['create_time']);
        }

        if (isset($data['custom'])) {
            $refund->setCustom($data['custom']);
        }

        if (isset($data['state'])) {
            $refund->setState($data['state']);
        }

        return $refund;
    }

    /**
     * Return refund data as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'sale_id' => $this->getSaleId(),
            'amount' => [
                'total' => $this->getTotal(),
                'currency' => $this->getCurrency(),
            ],
            'create_time' => $this->getCreateTime(),
            'custom' => $this->getCustom(),
            'state' => $this->getState(),
        ];
    }

    /**
     * Return sale id.
     *
     * @return  string
     */
    public function getSaleId()
    {
        return $this->saleId;
    }

    /**
     * Set sale id.
     *
     * @param   string  $saleId
     *
     * @return  self
     */
    public function setSaleId($saleId)
    {
        $this->saleId = $saleId;

        return $this;
    }

    /**
     * Return total.
     *
     * @return  string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set total.
     *
     * @param   string  $total
     *
     * @return  self
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Return currency.
     *
     * @return  string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set currency.
     *
     * @param   string  $currency
     *
     * @return  self
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Return create time.
     *
     * @return  string
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set create time.
     *
     * @param   string  $createTime
     *
     * @return  self
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Return custom id.
     *
     * @return  string
     */
    public function getCustom()
    {
        return $this->custom;
    }

    /**
     * Set custom id.
     *
     * @param   string  $custom
     *
     * @return  self
     */
    public function setCustom($custom)
    {
        $this->custom = $custom;

        return $this;
    }

    /**
     * Return state.
     *
     * @return  string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set state.
     *
     * @param   string  $state
     *
     * @return  self
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }
}
