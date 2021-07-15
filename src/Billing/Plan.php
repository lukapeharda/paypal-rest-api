<?php

namespace LukaPeharda\PayPal\Billing;

class Plan
{
    const STATUS_CREATED = 'CREATED';
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $productId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $status = 'ACTIVE';

    /**
     * @var string
     */
    protected $description;

    /**
     * @var array
     */
    protected $billingCycles = [];

    /**
     * @var PaymentPreferences
     */
    protected $paymentPreferences;

    /**
     * @var Taxes
     */
    protected $taxes;

    /**
     * Init plan from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $plan = new static;

        if (isset($data['id'])) {
            $plan->setId($data['id']);
        }

        if (isset($data['product_id'])) {
            $plan->setProductId($data['product_id']);
        }

        if (isset($data['name'])) {
            $plan->setName($data['name']);
        }

        if (isset($data['status'])) {
            $plan->setStatus($data['status']);
        }

        if (isset($data['description'])) {
            $plan->setDescription($data['description']);
        }

        if (isset($data['billing_cycles'])) {
            $plan->setBillingCycles(array_map(function ($billingCycle) {
                return BillingCycle::fromArray((array) $billingCycle);
            }, $data['billing_cycles']));
        }

        if (isset($data['payment_preferences'])) {
            $plan->setPaymentPreferences(PaymentPreferences::fromArray((array) $data['payment_preferences']));
        }

        if (isset($data['taxes'])) {
            $plan->setTaxes(Taxes::fromArray((array) $data['taxes']));
        }

        return $plan;
    }

    /**
     * Return plan as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'product_id' => $this->getProductId(),
            'name' => $this->getName(),
            'status' => $this->getStatus(),
            'description' => $this->getDescription(),
            'billing_cycles' => array_map(function ($billingCycle) {
                return $billingCycle->toArray();
            }, $this->getBillingCycles()),
            'payment_preferences' => $this->getPaymentPreferences() ? $this->getPaymentPreferences()->toArray() : null,
            'taxes' => $this->getTaxes() ? $this->getTaxes()->toArray() : null,
        ];
    }

    /**
     * Return ID.
     *
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ID.
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
     * Return product ID.
     *
     * @return  string
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set product ID.
     *
     * @param   string  $productId
     *
     * @return  self
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Return name.
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param   string  $name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * Return billing cycles.
     *
     * @return  string
     */
    public function getBillingCycles()
    {
        return $this->billingCycles;
    }

    /**
     * Set billing cycles.
     *
     * @param   string  $billingCycles
     *
     * @return  self
     */
    public function setBillingCycles($billingCycles)
    {
        $this->billingCycles = $billingCycles;

        return $this;
    }

    /**
     * Return payment preferences.
     *
     * @return  PaymentPreferences
     */
    public function getPaymentPreferences()
    {
        return $this->paymentPreferences;
    }

    /**
     * Set payment preferences.
     *
     * @param   string  $paymentPreferences
     *
     * @return  self
     */
    public function setPaymentPreferences($paymentPreferences)
    {
        $this->paymentPreferences = $paymentPreferences;

        return $this;
    }

    /**
     * Return taxes.
     *
     * @return  string
     */
    public function getTaxes()
    {
        return $this->taxes;
    }

    /**
     * Set taxes.
     *
     * @param   string  $taxes
     *
     * @return  self
     */
    public function setTaxes($taxes)
    {
        $this->taxes = $taxes;

        return $this;
    }
}
