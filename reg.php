<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = htmlspecialchars($_POST["first_name"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
	
$url = "https://api.paystack.co/customer";

//Gather the data to be sent to the endpoint
$data = [
    "first_name" => $first_name,
    "last_name" => $last_name,
    "email" => $email,
    "phone" => $phone
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
    "Authorization: Bearer sssssssssssssssssssssssssssssssssssssssssssss",
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
if($result->status = true){
$customer_code = $result->data->customer_code;
header("Location: van.php?customer_code=" . $customer_code);
}else{
	die("Registration Did Not Succeed! Refresh this page.");
}    
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Generate Dedicated Virtual Account Number</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Sign Up and Get Dedicated Virtual Account Number</h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="first-name">First Name</label>
                <input type="text" id="first-name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" id="last-name" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
