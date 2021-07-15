<?php

namespace LukaPeharda\PayPal\Checkout;

class Order
{
    const STATUS_CREATED = 'CREATED';
    const STATUS_SAVED = 'SAVED';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_VOIDED = 'VOIDED';
    const STATUS_COMPLETED = 'COMPLETED';
    const STATUS_PAYER_ACTION_REQUIRED = 'PAYER_ACTION_REQUIRED';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $status;

    /**
     * ISO-8601
     *
     * @var string
     */
    protected $createTime;

    /**
     * @var array
     */
    protected $purchaseUnits = [];

    /**
     * Init order from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $order = new static;

        if (isset($data['id'])) {
            $order->setId($data['id']);
        }

        if (isset($data['status'])) {
            $order->setStatus($data['status']);
        }

        if (isset($data['create_time'])) {
            $order->setCreateTime($data['create_time']);
        }

        if (isset($data['purchase_units'])) {
            $order->setPurchaseUnits(array_map(function ($purchaseUnit) {
                return PurchaseUnit::fromArray((array) $purchaseUnit);
            }, $data['purchase_units']));
        }

        return $order;
    }

    /**
     * Return order as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'status' => $this->getStatus(),
            'create_time' => $this->getCreateTime(),
            'purchase_units' => array_map(function ($purchaseUnit) {
                return $purchaseUnit->toArray();
            }, $this->getPurchaseUnits()),
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
     * Return purchase units.
     *
     * @return  array
     */
    public function getPurchaseUnits()
    {
        return $this->purchaseUnits;
    }

    /**
     * Set purchase units.
     *
     * @param   array  $purchaseUnits
     *
     * @return  self
     */
    public function setPurchaseUnits($purchaseUnits)
    {
        $this->purchaseUnits = $purchaseUnits;

        return $this;
    }
}
