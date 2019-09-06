<?php 

session_start();

session_destroy();
// ONCE YOU LOGOUT, YOU WILL BE REDIRECTED TO THE HOME PAGE i.e index.php
echo "<script>window.open('index.php','_self')</script>";
 ?>