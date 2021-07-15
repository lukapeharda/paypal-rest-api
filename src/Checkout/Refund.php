<?php

namespace LukaPeharda\PayPal\Checkout;

class Refund
{
    const STATUS_PENDING = 'PENDING';
    const STATUS_COMPLETED = 'COMPLETED';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $status = 'PENDING';

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
    protected $customId;

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

        if (isset($data['id'])) {
            $refund->setId($data['id']);
        }

        if (isset($data['amount'], $data['amount']['value'])) {
            $refund->setValue((float) $data['amount']['value']);
        }

        if  (isset($data['amount'], $data['amount']['currency_code'])) {
            $refund->setCurrencyCode($data['amount']['currency_code']);
        }

        if (isset($data['create_time'])) {
            $refund->setCreateTime($data['create_time']);
        }

        if (isset($data['custom_id'])) {
            $refund->setCustomId($data['custom_id']);
        }

        if (isset($data['status'])) {
            $refund->setStatus($data['status']);
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
            'id' => $this->getId(),
            'amount' => [
                'value' => $this->getValue(),
                'currency_code' => $this->getCurrencyCode(),
            ],
            'create_time' => $this->getCreateTime(),
            'custom_id' => $this->getCustomId(),
            'status' => $this->getStatus(),
        ];
    }

    /**
     * Return id.
     *
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Id.
     *
     * @param   string  $id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
    public function getCustomId()
    {
        return $this->customId;
    }

    /**
     * Set custom id.
     *
     * @param   string  $customId
     *
     * @return  self
     */
    public function setCustomId($customId)
    {
        $this->customId = $customId;

        return $this;
    }

    /**
     * Return status.
     *
     * @return  string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status.
     *
     * @param   string  $status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}
