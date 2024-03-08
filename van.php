<?php
if(isset($_GET["customer_code"])){
	$customer_code = htmlspecialchars($_GET["customer_code"]);
$url = "https://api.paystack.co/dedicated_account";

//Gather the data to be sent to the endpoint
$data = [
    "customer" => $customer_code
];

//Create cURL session
$curl = curl_init($url);

//Turn off Mandatory SSL Checker
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//Configure the cURL  session based on the type of request
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//Decide that this is a POST request
curl_setopt($curl, CURLOPT_POST, true);

//Convert the request data to a JSON data
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

//Set the API headers
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer ssssssssssssssssssssssssssssssssssssssssssss",
    "Content-type: Application/json"
]);

//Run the curl
$run = curl_exec($curl);

//Error checker
$error = curl_error($curl);

if($error){
    die("Curl returned some errors: " . $error);
}
//Close cURL session
curl_close($curl);

//var_dump($run);
$result = json_decode($run);
$bank_name = $result->data->bank->name;
$account_name = $result->data->account_name;
$account_no = $result->data->account_number;
$first_name = $result->data->customer->first_name;
$last_name = $result->data->customer->last_name;
$email = $result->data->customer->email;
} else{
	die("No customer was supplied! Go Back");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Dedidcated Virtual Account Number</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="registration-details">
        <p class="thank-you">Thank you for registering</p>
        <ul class="details-list">
            <li><strong>Bank Name:</strong> <?php echo $bank_name; ?></li>
            <li><strong>Account Name:</strong> <?php echo $account_name; ?></li>
            <li><strong>Account Number:</strong> <?php echo $account_no; ?></li>
            <li><strong>First Name:</strong> <?php echo $first_name; ?></li>
            <li><strong>Last Name:</strong> <?php echo $last_name; ?></li>
            <li><strong>Email:</strong> <?php echo $email; ?></li>
        </ul>
        <a href="reg.php" class="back-button">Back</a>
    </div>
</body>
</html>

