<?php

require_once('../vendor/autoload.php');

$paypal = new LukaPeharda\PayPal\Client('Af29d5QkzNo4cxbOyybsJ8a_NzjJriJ3wGG2UBrVSiR6-slTiCMlM_CPVNZnwQRskqLu8AywIfF7zaYq', 'EJGgHD6CCANJECczEhKdVCa7fRq8Xv2gI_5M80hNHfn-yYW2DfkiNSDkchqoITnnsrqfo0Oqcs64F-2F', 'sandbox');

// var_dump($paypal->orders->retrieve('4L932281WK418540F'));
// var_dump($paypal->orders->retrieve('71116597MY4303620'));

$order = $paypal->orders->retrieve('6KK21469396905236');
var_dump($order->getPurchaseUnits()[0]->getCaptures()[0]);

// try {
//     var_dump($paypal->orders->refund('6KK21469396905236'));
// } catch(Exception $exception) {
//     var_dump($exception->getMessage());
// }
