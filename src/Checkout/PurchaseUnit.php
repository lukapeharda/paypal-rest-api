<?php

namespace LukaPeharda\PayPal\Checkout;

use LukaPeharda\PayPal\Payment\Capture;
use LukaPeharda\PayPal\Billing\FixedPrice;

class PurchaseUnit
{
    /**
     * @var string
     */
    protected $referenceId;

    /**
     * @var FixedPrice
     */
    protected $amount;

    /**
     * @var string
     */
    protected $customId;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var array
     */
    protected $captures;

    /**
     * Init purchase unit from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $purchaseUnit = new static;

        if (isset($data['reference_id'])) {
            $purchaseUnit->setReferenceId($data['reference_id']);
        }

        if (isset($data['amount'])) {
            $purchaseUnit->setAmount(FixedPrice::fromArray((array) $data['amount']));
        }

        if (isset($data['custom_id'])) {
            $purchaseUnit->setCustomId($data['custom_id']);
        }

        if (isset($data['description'])) {
            $purchaseUnit->setDescription($data['description']);
        }

        if (isset($data['payments']) && isset($data['payments']->captures)) {
            $purchaseUnit->setCaptures(array_map(function ($captures) {
                return Capture::fromArray((array) $captures);
            }, $data['payments']->captures));
        }

        return $purchaseUnit;
    }

    /**
     * Return purchase unit as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'reference_id' => $this->getReferenceId(),
            'amount' => $this->getAmount() ? $this->getAmount()->toArray() : null,
            'custom_id' => $this->getCustomId(),
            'description' => $this->getDescription(),
            'captures' => array_map(function ($capture) {
                return $capture->toArray();
            }, $this->getCaptures()),
        ];
    }

    /**
     * Return reference id.
     *
     * @return  string
     */
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * Set reference id.
     *
     * @param   string  $referenceId
     *
     * @return  self
     */
    public function setReferenceId($referenceId)
    {
        $this->referenceId = $referenceId;

        return $this;
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
     * Return description.
     *
     * @return  string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description.
     *
     * @param   string  $description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Return capture.
     *
     * @return  array
     */
    public function getCaptures()
    {
        return $this->captures;
    }

    /**
     * Set capture.
     *
     * @param   array  $captures
     *
     * @return  self
     */
    public function setCaptures($captures)
    {
        $this->captures = $captures;

        return $this;
    }
}
