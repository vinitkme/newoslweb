<?php

include 'db_connect2.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$email = $request->Email;
$website = $request->Website;

$mailmessage = "Email :".$email."\nWebsite :".$website;

mail('vid@opensenselabs.com','Client Interested',$mailmessage);

$sql = "INSERT INTO leads (email,website) VALUES ('".$email."','".$website."')";

if ($conn->query($sql) === TRUE) {
  //  echo "New record created successfully";
} else {
  //  echo "Error: " . $sql . "<br>" . $conn->error;
}

echo "Thank You! We will get back to you in 24 hours.";

?>
