<?php

require_once('../vendor/autoload.php');

$paypal = new LukaPeharda\PayPal\Client('Af29d5QkzNo4cxbOyybsJ8a_NzjJriJ3wGG2UBrVSiR6-slTiCMlM_CPVNZnwQRskqLu8AywIfF7zaYq', 'EJGgHD6CCANJECczEhKdVCa7fRq8Xv2gI_5M80hNHfn-yYW2DfkiNSDkchqoITnnsrqfo0Oqcs64F-2F', 'sandbox');

$product = new LukaPeharda\PayPal\Catalog\Product;
$product->setId('PROD-0N016366KA002280K');
$product->setName('API test Name');
$product->setDescription('Testing API calls Desc');

// var_dump($paypal->products->create($product));

// var_dump($paypal->products->all());

// try {
//     var_dump($paypal->products->retrieve('PROD-0N016366KA002280K'));
// } catch (Exception $e) {
//     var_dump($exception);
// }

try {
    var_dump($paypal->products->update($product));
} catch (Exception $e) {
    var_dump($exception);
}