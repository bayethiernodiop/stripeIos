<?php
/**
 * Created by PhpStorm.
 * User: talibehackeur
 * Date: 07/11/2016
 * Time: 01:57
 */
require __DIR__ . "/vendor/autoload.php";
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Error;
use Stripe\Error\Base;
use Stripe\Error\Card;
use Stripe\Stripe;

Stripe::setApiKey('sk_test_RjUUjoOIph5e4ddYJUzuV7yB');
if ($_SERVER['REQUEST_URI'] === '/index.php/charge' or $_SERVER['REQUEST_URI'] === '/charge') {
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE); //convert JSON into array
    $token = $input['token'];
    $amount = $input['amount'];
    $currency = $input['currency'];
    $description = $input['description'];
    try {
        $charge = Charge::create(array(
            "amount" => $amount * 100,
            "currency" => $currency,
            "source" => $token,
            "description" => $description
        ));
        http_response_code(200);
        echo json_encode(array("message"=>"SUCCESS TRANSFER"));
    } catch (Card $e) {
        http_response_code(400);
        echo json_encode(array("message"=>"error with your card"));
    }
}

