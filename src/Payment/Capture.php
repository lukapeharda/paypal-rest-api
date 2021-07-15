<?php

namespace LukaPeharda\PayPal\Payment;

class Capture
{
    const STATUS_COMPLETED = 'COMPLETED';
    const STATUS_DECLINED = 'DECLINED';
    const STATUS_PARTIALLY_REFUNDED = 'PARTIALLY_REFUNDED';
    const STATUS_PENDING = 'PENDING';
    const STATUS_REFUNDED = 'REFUNDED';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $status;

    /**
     * Init capture from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $capture = new static;

        if (isset($data['id'])) {
            $capture->setId($data['id']);
        }

        if (isset($data['status'])) {
            $capture->setStatus($data['status']);
        }

        return $capture;
    }

    /**
     * Return capture as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
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
