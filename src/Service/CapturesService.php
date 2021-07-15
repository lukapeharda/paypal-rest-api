<?php

namespace LukaPeharda\PayPal\Service;

use LukaPeharda\PayPal\Checkout\Order;

class CapturesService extends AbstractService
{
    /**
     * Refund the capture.
     *
     * @param   string  $id
     *
     * @return  void
     */
    public function refund($id)
    {
        $this->request('post', '/v2/payments/captures/' . $id . '/refund');
    }
}