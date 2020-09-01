<?php 
$price = $_POST["totalprice"];
$name = $_POST["buyername"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$shop = 'shopping';


include 'src/instamojo.php';

$api = new Instamojo\Instamojo('test_68bef11c9251ea50a7e361aa255', 'test_70028f0948ca36d179c451e3493','https://test.instamojo.com/api/1.1/');


try {
    $response = $api->paymentRequestCreate(array(
	    "purpose" => $shop,
        "amount" => $price,
        "buyer_name" => $name,
        "phone" => $phone,
        "send_email" => true,
        "send_sms" => true,
        "email" => $email,
        'allow_repeated_payments' => false,
        "redirect_url" => "http://localhost/ecommerce/cart/thankyou.php",
        "webhook" => "http://localhost/ecommerce/cart/webhook.php"
        ));
    //print_r($response);

    $pay_ulr = $response['longurl'];
    
    //Redirect($response['longurl'],302); //Go to Payment page

    header("Location: $pay_ulr");
    exit();

}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}     
  ?>