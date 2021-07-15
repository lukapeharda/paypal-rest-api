<?php

namespace LukaPeharda\PayPal\Service;

use LukaPeharda\PayPal\Billing\Plan;

class PlansService extends AbstractService
{
    /**
     * Returns an array with plans from PayPal
     *
     * @return  mixed
     */
    public function all()
    {
        $response = $this->request('get', '/v1/billing/plans');

        if ($response->result === null) {
            return [];
        }

        return array_map(function ($plan) {
            return Plan::fromArray((array) $plan);
        }, $response->result->plans);
    }

    /**
     * Persist a plan on PayPal.
     *
     * @param   Plan  $plan
     *
     * @return  Plan
     */
    public function create(Plan $plan)
    {
        $response = $this->request('post', '/v1/billing/plans', $plan->toArray());

        return Plan::fromArray((array) $response->result);
    }

    /**
     * Fetch a plan from PayPal.
     *
     * @param   string  $id
     *
     * @return  Plan
     */
    public function retrieve($id)
    {
        $response = $this->request('get', '/v1/billing/plans/' . $id);

        return Plan::fromArray((array) $response->result);
    }

    /**
     * Deactvates a plan.
     *
     * @param   string  $id
     *
     * @return  void
     */
    public function deactivate($id)
    {
        $this->request('post', '/v1/billing/plans/' . $id . '/deactivate');
    }
}
