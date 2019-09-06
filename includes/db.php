<?php

$con = mysqli_connect("localhost","root","","ecommerce");

if (mysqli_connect_errno()) {
	echo "MySQL Connection Error".mysqli_connect_error();
}
?>