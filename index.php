<?php
/**
 * Created by PhpStorm.
 * User: talibehackeur
 * Date: 07/11/2016
 * Time: 01:57
 */
require __DIR__ . "/vendor/autoload.php";
use Stripe\Customer;
use Stripe\Error;
use Stripe\Stripe;

Stripe::setApiKey('sk_test_RjUUjoOIph5e4ddYJUzuV7yB');
if ($_SERVER['REQUEST_URI'] === '/index.php/customer') {
} elseif ($_SERVER['REQUEST_URI'] === '/charge') {
    die("lol");
} elseif ($_SERVER['REQUEST_URI'] === '/index.php/customer/sources/add') {

    //Attach a new payment source to the Customer for the currently-logged in user
    $customer_id = "1234"; // Load the Stripe Customer ID for your logged in user

    try {
        $customer = \Stripe\Customer::retrieve($customer_id);
        $customer->sources->create(array("source" => $_POST["source"]));
        http_response_code(200);
    } catch (Error\Base $e) {
        http_response_code(402);
    }
} elseif ($_SERVER['REQUEST_URI'] === '/index.php/customer/default_source') {

} elseif ($_SERVER['REQUEST_URI'] === '/index.php/customer/get') {
    //Retrieve the Customer object for the currently logged-in use
    try {
        $customer_id = "123449484"; // Load the Stripe Customer ID for your logged in user
        $customer = Customer::retrieve($customer_id);
        header('Content-Type: application/json');
        echo $customer->jsonSerialize();
    } catch (Error\Base $e) {
        var_dump($e->getMessage());
        http_response_code(402);
    }
}
