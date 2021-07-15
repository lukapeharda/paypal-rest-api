<?php

namespace LukaPeharda\PayPal\Service;

use LukaPeharda\PayPal\Checkout\Order;

class OrdersService extends AbstractService
{
    /**
     * Create an order on PayPal.
     *
     * @param   Order  $order
     *
     * @return  Order
     */
    public function create(Order $order)
    {
        $response = $this->request('post', '/v2/checkout/orders', $order->toArray());

        return Order::fromArray((array) $response->result);
    }

    /**
     * Fetch an order from PayPal.
     *
     * @param   string  $id
     *
     * @return  Order
     */
    public function retrieve($id)
    {
        $response = $this->request('get', '/v2/checkout/orders/' . $id);

        return Order::fromArray((array) $response->result);
    }
}
