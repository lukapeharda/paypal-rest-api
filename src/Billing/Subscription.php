<?php

namespace LukaPeharda\PayPal\Billing;

class Subscription
{
    const STATUS_APPROVAL_PENDING = 'APPROVAL_PENDING';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_SUSPENDED = 'SUSPENDED';
    const STATUS_CANCELLED = 'CANCELLED';
    const STATUS_EXPIRED = 'EXPIRED';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var Plan
     */
    protected $plan;

    /**
     * ISO8601 date format (ATOM)
     *
     * @var string
     */
    protected $startTime;

    /**
     * @var string
     */
    protected $customId;

    /**
     * @var int
     */
    protected $quantity = 1;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var Subscriber
     */
    protected $subscriber;

    /**
     * @var ApplicationContext
     */
    protected $applicationContext;

    /**
     * @var string
     */
    protected $approveUrl;

    /**
     * @var string
     */
    protected $suspendUrl;

    /**
     * @var BillingInfo
     */
    protected $billingInfo;

    /**
     * Init subscription from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $subscription = new self;

        if (isset($data['id'])) {
            $subscription->setId($data['id']);
        }

        if (isset($data['plan'])) {
            $subscription->setPlan(Plan::fromArray((array) $data['plan']));
        }

        if (isset($data['plan_id'])) {
            if ($subscription->plan !== null) {
                $subscription->plan->setId($data['plan_id']);
            } else {
                $subscription->setPlan(Plan::fromArray(['id' => $data['plan_id']]));
            }
        }

        if (isset($data['start_time'])) {
            $subscription->setStartTime($data['start_time']);
        }

        if (isset($data['custom_id'])) {
            $subscription->setCustomId($data['custom_id']);
        }

        if (isset($data['quantity'])) {
            $subscription->setQuantity((int) $data['quantity']);
        }

        if (isset($data['status'])) {
            $subscription->setStatus($data['status']);
        }

        if (isset($data['subscriber'])) {
            $subscription->setSubscriber(Subscriber::fromArray((array) $data['subscriber']));
        }

        if (isset($data['application_context'])) {
            $subscription->setApplicationContext(ApplicationContext::fromArray((array) $data['application_context']));
        }

        if (isset($data['billing_info'])) {
            $subscription->setBillingInfo(BillingInfo::fromArray((array) $data['billing_info']));
        }

        if (isset($data['links'])) {
            $subscription->setApproveUrl($subscription->parseLinks($data['links'], 'approve'));
            $subscription->setSuspendUrl($subscription->parseLinks($data['links'], 'suspend'));
        }

        return $subscription;
    }

    /**
     * Return subscription data as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'plan' => $this->getPlan()->toArray(),
            'plan_id' => $this->getPlan()->getId(),
            'start_time' => $this->getStartTime(),
            'custom_id' => $this->getCustomId(),
            'quantity' => $this->getQuantity(),
            'status' => $this->getStatus(),
            'subscriber' => $this->getSubscriber() ? $this->getSubscriber()->toArray() : null,
            'approve_url' => $this->getApproveUrl(),
            'suspend_url' => $this->getSuspendUrl(),
            'billing_info' => $this->getBillingInfo() ? $this->getBillingInfo()->toArray() : null,
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
     * Set id.
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
     * Return plan.
     *
     * @return  Plan
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * Set plan.
     *
     * @param   Plan  $plan
     *
     * @return  self
     */
    public function setPlan($plan)
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Return start time as ISO8601 date format (ATOM).
     *
     * @return  string
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set start time.
     *
     * @param   string  $startTime ISO8601 date format (ATOM)
     *
     * @return  self
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

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
     * Return quantity.
     *
     * @return  int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set quantity.
     *
     * @param   int  $quantity
     *
     * @return  self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

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
     * Return subscriber.
     *
     * @return  Subscriber
     */
    public function getSubscriber()
    {
        return $this->subscriber;
    }

    /**
     * Set subscriber.
     *
     * @param   Subscriber  $subscriber
     *
     * @return  self
     */
    public function setSubscriber($subscriber)
    {
        $this->subscriber = $subscriber;

        return $this;
    }

    /**
     * Return approve URL.
     *
     * @return  string|null
     */
    public function getApproveUrl()
    {
        return $this->approveUrl;
    }

    /**
     * Set approve URL.
     *
     * @param   string  $approveUrl
     *
     * @return  self
     */
    public function setApproveUrl($approveUrl)
    {
        $this->approveUrl = $approveUrl;

        return $this;
    }

    /**
     * Return suspend URL.
     *
     * @return  string|null
     */
    public function getSuspendUrl()
    {
        return $this->suspendUrl;
    }

    /**
     * Set suspend URL.
     *
     * @param   string  $suspendUrl
     *
     * @return  self
     */
    public function setSuspendUrl($suspendUrl)
    {
        $this->suspendUrl = $suspendUrl;

        return $this;
    }

    /**
     * Return application context.
     *
     * @return  ApplicationContext
     */
    public function getApplicationContext()
    {
        return $this->applicationContext;
    }

    /**
     * Set application context.
     *
     * @param   ApplicationContext  $applicationContext
     *
     * @return  self
     */
    public function setApplicationContext($applicationContext)
    {
        $this->applicationContext = $applicationContext;

        return $this;
    }

    /**
     * Return billing info.
     *
     * @return  BillingInfo
     */
    public function getBillingInfo()
    {
        return $this->billingInfo;
    }

    /**
     * Set billing info.
     *
     * @param   BillingInfo  $billingInfo
     *
     * @return  self
     */
    public function setBillingInfo($billingInfo)
    {
        $this->billingInfo = $billingInfo;

        return $this;
    }

    /**
     * Find $rel URL in links.
     *
     * @param   array  $links
     * @param   string $rel
     *
     * @return  string|null
     */
    protected function parseLinks($links, $rel)
    {
        foreach ($links as $link) {
            // Ensure $link is an object
            $link = (object) $link;

            if ($link->rel !== $rel) {
                continue;
            }

            return $link->href;
        }

        return null;
    }
}
