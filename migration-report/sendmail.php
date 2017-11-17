<?php

$email = $_POST['email'];
mail('vid@opensenselabs.com','Client Interested',"Email : ".$email);
mail('devanshu@opensenselabs.com','Client Interested',"Email : ".$email);
echo "Thank You! We will contact you asap";

?>
