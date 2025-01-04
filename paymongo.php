<?php

require_once "vendor/autoload.php";
require "app/config/constants.php";


class PayMongo {


    public function generateUrl($amount, $payment_id) {
        $client = new \GuzzleHttp\Client();
        $payment_id_hash = $this->encryptData($payment_id);
        
        // Define the POST data
        $postData = [
            "data" => [
                "attributes" => [
                    "amount" => $amount * 100,
                    "redirect" => [
                        "success" => "http://localhost/RishaTech9/payment/success.php?payment_id=" . $payment_id_hash."&amount=" . $amount,
                        "failed" => "http://localhost/RishaTech9/payment/failed.php"
                    ],
                    "type" => "gcash",
                    "currency" => "PHP"
                ]
            ]
        ];
    
        try {
            // Make the API request
            $response = $client->request('POST', 'https://api.paymongo.com/v1/sources', [
                'json' => $postData, // use 'json' to automatically encode the data
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9xTTdQTnJVN3REM0VxUXNrUldBc2FUeW06',
                    'content-type' => 'application/json',
                ],
            ]);
    
            // Print the status code and the response body for debugging
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            // echo "Status Code: $statusCode\n";
            // echo "Response Body: $body\n";
    
            return json_decode($body);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Catch request errors and print them
            echo "Error: " . $e->getMessage();
            if ($e->hasResponse()) {
                $errorResponse = $e->getResponse();
                echo "Error Response: " . $errorResponse->getBody();
            }
        }
    }
    

    public function computeAmount($monthlyPayment, $duedate) {
        // Create a DateTime object for today's date
        $today = new DateTime();
    
        // Create a DateTime object for the due date
        $dueDate = new DateTime($duedate);
    
        // Check if today's date is greater than the due date
        if ($today > $dueDate) {
            // Add 25% of the monthly payment to the original monthly payment
            $payableAmount = $monthlyPayment + ($monthlyPayment * 0.25);
        } else {
            // If the due date is not passed, return the original monthly payment
            $payableAmount = $monthlyPayment;
        }
    
        // Return the calculated payable amount
        return $payableAmount;
    }

    // Function to encrypt data
    function encryptData($data) {
        return openssl_encrypt($data, 'aes-256-cbc', OPENSSL_KEY, 0, '1234567890123456');
    }

    // Function to decrypt data
    function decryptData($encryptedData) {
        return openssl_decrypt($encryptedData, 'aes-256-cbc', OPENSSL_KEY, 0, '1234567890123456');
    }

}

?>