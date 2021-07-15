<?php

require_once('../vendor/autoload.php');

$paypal = new LukaPeharda\PayPal\Client('Af29d5QkzNo4cxbOyybsJ8a_NzjJriJ3wGG2UBrVSiR6-slTiCMlM_CPVNZnwQRskqLu8AywIfF7zaYq', 'EJGgHD6CCANJECczEhKdVCa7fRq8Xv2gI_5M80hNHfn-yYW2DfkiNSDkchqoITnnsrqfo0Oqcs64F-2F', 'sandbox');

$fixedPrice = new LukaPeharda\PayPal\Billing\FixedPrice;
$fixedPrice->setValue(1560);
$fixedPrice->setCurrencyCode('EUR');

$pricingScheme = new LukaPeharda\PayPal\Billing\PricingScheme;
$pricingScheme->setFixedPrice($fixedPrice);

$frequency = new LukaPeharda\PayPal\Billing\Frequency;
$frequency->setIntervalUnit(LukaPeharda\PayPal\Billing\Frequency::INTERVAL_UNIT_DAY);
$frequency->setIntervalCount(1);

$billingCycle = new LukaPeharda\PayPal\Billing\BillingCycle;
$billingCycle->setFrequency($frequency);
$billingCycle->setPricingScheme($pricingScheme);
$billingCycle->setTenureType(LukaPeharda\PayPal\Billing\BillingCycle::TENURE_TYPE_REGULAR);
$billingCycle->setSequence(1);
$billingCycle->setTotalCycles(0);

$taxes = new LukaPeharda\PayPal\Billing\Taxes;
$taxes->setPercentage(20);
$taxes->setInclusive(false);

$plan = new LukaPeharda\PayPal\Billing\Plan;
$plan->setId('P-43D746467D453342MMC2NFXI');
$plan->setBillingCycles([
    $billingCycle
]);
$plan->setTaxes($taxes);

$applicationContext = new LukaPeharda\PayPal\Billing\ApplicationContext;
$applicationContext->setBrandName('OP#3');
$applicationContext->setReturnUrl('http://3.optimizepress.local/pay-pal-1/?hash=test1');

$subscription = new LukaPeharda\PayPal\Billing\Subscription;
$subscription->setPlan($plan);
$subscription->setCustomId('ASDF123');
$subscription->setStartTime(date(DateTime::ISO8601, strtotime('+3 hour')));
$subscription->setQuantity(1);
$subscription->setApplicationContext($applicationContext);

// var_dump($subscription);

try {
    var_dump($paypal->subscriptions->create($subscription));
} catch (Exception $e) {
    var_dump($e);
}

// try {
//     var_dump($paypal->subscriptions->retrieve('I-H93XA7RD1WET'));
// } catch (Exception $e) {
//     var_dump($e);
// }

// try {
//     var_dump($paypal->subscriptions->cancel('I-H93XA7RD1WET'));
// } catch (Exception $e) {
//     var_dump($e);
// }