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
use Stripe\Error\Base;
use Stripe\Stripe;

Stripe::setApiKey('sk_test_RjUUjoOIph5e4ddYJUzuV7yB');
if ($_SERVER['REQUEST_URI'] === '/index.php/customer/sources') {
    //Attach a new payment source to the Customer for the currently-logged in user
    $customer_id = "1234"; // Load the Stripe Customer ID for your logged in user

    try {
        $customer = \Stripe\Customer::retrieve($customer_id);
        $customer->sources->create(array("source" => $_POST["source"]));
        http_response_code(200);
    } catch (Base $e) {
        var_dump($e->getMessage());
        http_response_code(402);
    }
} elseif ($_SERVER['REQUEST_URI'] === '/index.php/customer/default_source') {
    //This is called when the user changes their selected payment method in our UI. For this
    $customer_id = "13323123";

    try {
        $customer = \Stripe\Customer::retrieve($customer_id);
        $customer->default_source = $_GET["default_source"];
        $customer->save();
        http_response_code(200);
    } catch (Base $e) {
        var_dump($e->getMessage());
        http_response_code(402);
    }

} elseif ($_SERVER['REQUEST_URI'] === '/index.php/customer') {
    //Retrieve the Customer object for the currently logged-in use
    try {
        $customer_id = Customer::create(array(
            "description" => "Customer for avery.williams@example.com",
        ));
        die($customer_id);
        $customer = Customer::retrieve($customer_id);
        header('Content-Type: application/json');
        echo $customer->jsonSerialize();
    } catch (Base $e) {
        var_dump($e->getMessage());
        http_response_code(402);
    }
}
