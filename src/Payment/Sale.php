<?php

namespace LukaPeharda\PayPal\Payment;

class Sale
{
    const STATE_PENDING = 'pending';
    const STATE_COMPLETED = 'completed';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
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
     * @var string
     */
    protected $state = 'pending';

    /**
     * @var string
     */
    protected $invoiceNumber;

    /**
     * @var string
     */
    protected $billingAgreementId;

    /**
     * Not a part of the sale object per se, but added in order to be able to
     * calculate net price and other required values.
     *
     * @var float
     */
    protected $taxRate;

    /**
     * Init data from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $sale = new self;

        if (isset($data['id'])) {
            $sale->setId($data['id']);
        }

        if (isset($data['amount'], $data['amount']['total'])) {
            $sale->setTotal($data['amount']['total']);
        }

        if (isset($data['amount'], $data['amount']['currency'])) {
            $sale->setCurrency($data['amount']['currency']);
        }

        if (isset($data['create_time'])) {
            $sale->setCreateTime($data['create_time']);
        }

        if (isset($data['custom'])) {
            $sale->setCustom($data['custom']);
        }

        if (isset($data['state'])) {
            $sale->setState($data['state']);
        }

        if (isset($data['invoice_number'])) {
            $sale->setInvoiceNumber($data['invoice_number']);
        }

        if (isset($data['billing_agreement_id'])) {
            $sale->setBillingAgreementId($data['billing_agreement_id']);
        }

        return $sale;
    }

    /**
     * Return sale data as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'amount' => [
                'total' => $this->getTotal(),
                'currency' => $this->getCurrency(),
            ],
            'create_time' => $this->getCreateTime(),
            'custom' => $this->getCustom(),
            'state' => $this->getState(),
            'invoice_number' => $this->getInvoiceNumber(),
            'billing_agreement_id' => $this->getBillingAgreementId(),
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

    /**
     * Return invoice number.
     *
     * @return  string
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * Set invoice number.
     *
     * @param   string  $invoiceNumber
     *
     * @return  self
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    /**
     * Return billing agreement ID (subscription ID).
     *
     * @return  string
     */
    public function getBillingAgreementId()
    {
        return $this->billingAgreementId;
    }

    /**
     * Set billing agreement ID (subscription ID).
     *
     * @param   string  $billingAgreementId
     *
     * @return  self
     */
    public function setBillingAgreementId($billingAgreementId)
    {
        $this->billingAgreementId = $billingAgreementId;

        return $this;
    }

    /**
     * Return tax rate.
     *
     * @return  float
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * Set tax rate.
     *
     * @param   float  $taxRate
     *
     * @return  self
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    /**
     * Return gross price / total.
     *
     * @return  float
     */
    public function getGrossPrice()
    {
        return (float) $this->getTotal();
    }

    /**
     * Return net price.
     *
     * @return  float
     */
    public function getNetPrice()
    {
        return $this->getGrossPrice() / (1 + $this->getTaxRate());
    }

    /**
     * Return tax value.
     *
     * @return  float
     */
    public function getTaxValue()
    {
        return $this->getGrossPrice() - $this->getNetPrice();
    }
}
