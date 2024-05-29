<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST,GET,PUT,PATCH,DELETE');
header("Content-Type: application/json");
header("Accept: application/json");
header('Access-Control-Allow-Headers:Access-Control-Allow-Origin,Access-Control-Allow-Methods,Content-Type');

if(isset($_POST['action']) && $_POST['action'] === 'payOrder'){

    $razorpay_mode = 'test';

    $razorpay_test_key = 'rzp_test_g2t5mCo5BZUbOF'; // Your Test Key
    $razorpay_test_secret_key = '87vcLOTKRo1hnEKsRiu6S3t2'; // Your Test Secret Key

    $razorpay_live_key = 'Your_Live_Key';
    $razorpay_live_secret_key = 'Your_Live_Secret_Key';

    if($razorpay_mode === 'test'){
        $razorpay_key = $razorpay_test_key;
        $authAPIkey = "Basic " . base64_encode($razorpay_test_key . ":" . $razorpay_test_secret_key);
    } else {
        $authAPIkey = "Basic " . base64_encode($razorpay_live_key . ":" . $razorpay_live_secret_key);
        $razorpay_key = $razorpay_live_key;
    }

    // Set transaction details
    $order_id = uniqid(); 

    $billing_name = $_POST['billing_name'];
    $billing_mobile = $_POST['billing_mobile'];
    $billing_email = $_POST['billing_email'];
    $payAmount = $_POST['payAmount']; 

    $note = "Payment of amount Rs. " . $payAmount;

    $postdata = array(
        "amount" => $payAmount * 100,
        "currency" => "INR",
        "receipt" => $note,
        "notes" => array(
            "notes_key_1" => $note,
        )
    );

    // Debugging statement: Log request data
    error_log("AJAX Request Data: " . json_encode($_POST));

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($postdata),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: ' . $authAPIkey
        ),
    ));

    $response = curl_exec($curl);

    // Debugging statement: Log response from Razorpay API
    error_log("Response from Razorpay API: " . $response);

    curl_close($curl);

    $orderRes = json_decode($response);
 
    if(isset($orderRes->id)){
        $rpay_order_id = $orderRes->id;
     
        $dataArr = array(
            'amount' => $payAmount,
            'description' => "Pay bill of Rs. " . $payAmount,
            'rpay_order_id' => $rpay_order_id,
            'name' => $billing_name,
            'email' => $billing_email,
            'mobile' => $billing_mobile
        );

        // Debugging statement: Log successful response
        error_log("Successful response: " . json_encode(['res'=>'success','order_number'=>$order_id,'userData'=>$dataArr,'razorpay_key'=>$razorpay_key]));

        echo json_encode(['res'=>'success','order_number'=>$order_id,'userData'=>$dataArr,'razorpay_key'=>$razorpay_key]); 
        exit;
    } else {
        // Debugging statement: Log error response
        error_log("Error response: " . json_encode(['res'=>'error','order_id'=>$order_id,'info'=>'Error with payment']));

        echo json_encode(['res'=>'error','order_id'=>$order_id,'info'=>'Error with payment'.$payAmount]); 
        exit;
    }
} else {
    // Debugging statement: Log invalid request
    error_log("Invalid request");

    echo json_encode(['res'=>'error']); 
    exit;
}
?>
