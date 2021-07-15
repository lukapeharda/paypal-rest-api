<?php

require_once('../vendor/autoload.php');

$paypal = new LukaPeharda\PayPal\Client('Af29d5QkzNo4cxbOyybsJ8a_NzjJriJ3wGG2UBrVSiR6-slTiCMlM_CPVNZnwQRskqLu8AywIfF7zaYq', 'EJGgHD6CCANJECczEhKdVCa7fRq8Xv2gI_5M80hNHfn-yYW2DfkiNSDkchqoITnnsrqfo0Oqcs64F-2F', 'sandbox');

$fixedPrice = new LukaPeharda\PayPal\Billing\FixedPrice;
$fixedPrice->setValue(1);
$fixedPrice->setCurrencyCode('USD');

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

$paymentPreferences = new LukaPeharda\PayPal\Billing\PaymentPreferences;
$paymentPreferences->setAutoBillOutstanding(true);
$paymentPreferences->setPaymentFailureThreshold(2);

$plan = new LukaPeharda\PayPal\Billing\Plan;
$plan->setProductId('PROD-8R900327CG417213B');
$plan->setName('Dummy plan name');
$plan->setStatus(LukaPeharda\PayPal\Billing\Plan::STATUS_ACTIVE);
$plan->setDescription('Dummy description');
$plan->setBillingCycles([
    $billingCycle
]);
$plan->setPaymentPreferences($paymentPreferences);

// try {
//     var_dump($paypal->plans->create($plan));
// } catch (Exception $e) {
//     var_dump($e);
// }

// try {
//     var_dump($paypal->plans->all());
// } catch (Exception $e) {
//     var_dump($e);
// }

// try {
//     var_dump($paypal->plans->retrieve('P-53A70810UJ707810AMC2JMKA'));
// }  catch (Exception $e) {
//     var_dump($e);
// }

try {
    $paypal->plans->deactivate('P-53A70810UJ707810AMC2JMKA');
}  catch (Exception $e) {
    var_dump($e);
}