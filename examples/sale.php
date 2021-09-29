<?php

require_once('../vendor/autoload.php');

ini_set('precision', 20);

$sale = LukaPeharda\PayPal\Payment\Sale::fromArray([
    'amount' => [
        'total' => '35.95',
    ]
]);
$sale->setTaxRate(10);

var_dump($sale->getGrossPrice());
var_dump($sale->getNetPrice());