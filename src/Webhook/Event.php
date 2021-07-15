<?php

namespace LukaPeharda\PayPal\Webhook;

use LukaPeharda\PayPal\Payment\Sale;
use LukaPeharda\PayPal\Payment\Refund as SubscriptionRefund;
use LukaPeharda\PayPal\Checkout\Order;
use LukaPeharda\PayPal\Checkout\Refund as CaptureRefund;
use LukaPeharda\PayPal\Billing\Subscription;

class Event
{
    const BILLING_SUBSCRIPTION_CREATED = 'BILLING.SUBSCRIPTION.CREATED';
    const BILLING_SUBSCRIPTION_CANCELLED = 'BILLING.SUBSCRIPTION.CANCELLED';
    const BILLING_SUBSCRIPTION_ACTIVATED = 'BILLING.SUBSCRIPTION.ACTIVATED';
    const PAYMENT_SALE_PENDING = 'PAYMENT.SALE.PENDING';
    const PAYMENT_SALE_REFUNDED = 'PAYMENT.SALE.REFUNDED';
    const PAYMENT_SALE_COMPLETED = 'PAYMENT.SALE.COMPLETED';
    const CHECKOUT_ORDER_APPROVED = 'CHECKOUT.ORDER.APPROVED';
    const PAYMENT_CAPTURE_REFUNDED = 'PAYMENT.CAPTURE.REFUNDED';
    const PAYMENT_CAPTURE_COMPLETED = 'PAYMENT.CAPTURE.COMPLETED';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var mixed
     */
    protected $resource;

    /**
     * Init event from array. Create resource if set
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $event = new static;

        if (isset($data['id'])) {
            $event->setId($data['id']);
        }

        if (isset($data['event_type'])) {
            $event->setType($data['event_type']);
        }

        if (isset($data['resource_type']) && isset($data['resource'])) {
            $event->setResource(
                $event->createResource($data['resource_type'], $data['event_type'], $data['resource'])
            );
        }

        return $event;
    }

    /**
     * Return event as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'type' => $this->getType(),
            'resource' => $this->getResource() ? $this->getResource()->toArray() : null,
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
     * Return type.
     *
     * @return  string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type.
     *
     * @param   string  $type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Return resource object if one was successfully created.
     *
     * @return  mixed|null
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set resource.
     *
     * @param   mixed|null  $resource
     *
     * @return  self
     */
    public function setResource($resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Create resource object for given type and data.
     *
     * Return null if type is not one of specified.
     *
     * @param   string  $type
     * @param   string  $event
     * @param   array  $data
     *
     * @return  mixed|null
     */
    protected function createResource($type, $event, $data)
    {
        switch ($type) {
            case 'subscription':
                return Subscription::fromArray($data);
            case 'sale':
                return Sale::fromArray($data);
            case 'checkout-order':
                return Order::fromArray($data);
            case 'refund':
                if ($event === self::PAYMENT_SALE_REFUNDED) {
                    return SubscriptionRefund::fromArray($data);
                } else if ($event === self::PAYMENT_CAPTURE_REFUNDED) {
                    return CaptureRefund::fromArray($data);
                }
            default:
                return null;
        }
    }
}
