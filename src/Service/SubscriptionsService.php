<?php

namespace LukaPeharda\PayPal\Service;

use LukaPeharda\PayPal\Billing\Subscription;

class SubscriptionsService extends AbstractService
{
    /**
     * Create a subscription on PayPal.
     *
     * @param   Subscription  $subscription
     *
     * @return  Subscription
     */
    public function create(Subscription $subscription)
    {
        $response = $this->request('post', '/v1/billing/subscriptions', $subscription->toArray());

        return Subscription::fromArray((array) $response->result);
    }

    /**
     * Fetch a subscription from PayPal.
     *
     * @param   string  $id
     *
     * @return  Subscription
     */
    public function retrieve($id)
    {
        $response = $this->request('get', '/v1/billing/subscriptions/' . $id);

        return Subscription::fromArray((array) $response->result);
    }

    /**
     * Cancel a subscription.
     *
     * @param   string  $id
     *
     * @return  void
     */
    public function cancel($id)
    {
        $this->request('post', '/v1/billing/subscriptions/' . $id . '/cancel');
    }
}
