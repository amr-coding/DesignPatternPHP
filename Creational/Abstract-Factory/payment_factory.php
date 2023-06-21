<?php

interface PaymentFactory
{
    public function createPaymentProcessor(): PaymentProcessor;
    public function createPaymentGateway(): PaymentGateway;
}

interface PaymentProcessor
{
    public function processPayment($amount);
}

interface PaymentGateway
{
    public function authorize($amount);
    public function capture($amount);
    public function refund($amount);
}

class StripePaymentFactory implements PaymentFactory
{
    public function createPaymentProcessor(): PaymentProcessor
    {
        return new StripePaymentProcessor;
    }
    public function createPaymentGateway(): PaymentGateway
    {
        return new StripePaymentGateway;
    }
}

class PayPalPaymentFactory implements PaymentFactory
{
    public function createPaymentProcessor(): PaymentProcessor
    {
        return new PayPalPaymentProcessor;
    }
    public function createPaymentGateway(): PaymentGateway
    {
        return new PayPalPaymentGateway;
    }
}

class StripePaymentProcessor implements PaymentProcessor
{

    public function processPayment($amount)
    {
        echo "Stripe payment process for amount: " . $amount;
    }
}

class StripePaymentGateway implements PaymentGateway
{
    public function authorize($amount)
    {
        echo "Amount: " . $amount . " Has been authorized.";
    }
    public function capture($amount)
    {
        echo "Payment has been captured with amount: " . $amount;
    }
    public function refund($amount)
    {
        echo "Payment refund request with the amount: " . $amount;
    }
}


class PayPalPaymentProcessor implements PaymentProcessor
{
    public function processPayment($amount)
    {
        echo "PayPal payment is processing for amount: " . $amount;
    }
}

class PayPalPaymentGateway implements PaymentGateway
{
    public function authorize($amount)
    {
        echo "Amount: " . $amount . " has beeen authorized";
    }
    public function capture($amount)
    {
        echo "Amount: " . $amount . " is captured successfully.";
    }
    public function refund($amount)
    {
        echo "A refund request is issued with the amount: " . $amount;
    }
}

$payment = new StripePaymentFactory;
$process = $payment->createPaymentProcessor();
$process->processPayment(100);
$gateway = $payment->createPaymentGateway();
$authorize = $gateway->authorize(100);

$paypalPayment = new PayPalPaymentFactory;
$processPayPal = $paypalPayment->createPaymentProcessor()->processPayment(500);
