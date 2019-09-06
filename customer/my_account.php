<!DOCTYPE html>

<!-- INCLUDE THE functions.php FOLDER SO THAT THE getCats() AND THE getBrands() FUNCTIONS CAN OPERATE NORMALLY -->
<?php
session_start();
include('../functions/functions.php');
?>
<html>
<head>
	<title>Bunduki Ecommerce</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="styles/style.css">

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

	<style>
/*body {margin:0;}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
    position: fixed;
    top: 0;
    width: 100%;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #4CAF50;
}*/

</style>
</head>
<body>
<!--A FIXED TOP NAVIGATION BAR -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top" style="float: left;">
  <span class="navbar-text" style="margin-left: 2%; color: magenta; font-size: 150%;">
    BUNDUKI ECOMMERCE
  </span>

  <!-- <a class="navbar-brand" href="#">Bunduki</a> -->

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="../index.php" >Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../all_products.php" >All Products</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../customer/my_account.php" >My Account</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../customer_register.php" >Signup</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../cart.php" >Shopping Cart</a>
    </li>
    <!-- CODE FOR SEARCH BOX/BAR -->
     <form class="form-inline" action="results.php" style="float: right;">
    <input class="form-control mr-sm-2" type="text" name="search_query" placeholder="Search">
    <button class="btn btn-success" type="submit" name="search">Search</button>
  </form>
    <!-- <div id="form" style="float: right; line-height: 25px; margin-right: 2%; margin-top: 0.5%;">
        <form method="get" action="results.php" enctype="multipart/form-data">
          <input type="text" name="user_query" placeholder="Search a Product"/ > 
          <input type="submit" name="search" value="Search" />
        </form>
      </div> -->
  </ul>
</nav>
<!-- END OF NAVIGATION BAR -->

<div class="container-fluid" style="margin-top:4.2%">
  
<div class="row">
    <!-- SIDEBAR -->
    <div class="col-sm-2" style="background-color:lavender;">

      <!-- CATEGORIES OF ITEMS AS A LIST GROUP -->
      <div class="container">
          <h2>MyAccount</h2>
          <div class="list-group">

             
            <!-- LETS CALL THE getCats FUNCTION TO DISPLAY THE LIST OF CATEGORIES FROM THE DATABASE -->
            <?
        //PHP CODE BELOW TO DISPLAY CUSTOMER IMAGE
          <?php 
          
       $user = (isset($_SESSION['customer_email']) ? $_SESSION['customer_email'] : "Guest");
        
        $get_img = "select * from customers where customer_email='$user'";
        
        $run_img = mysqli_query($con, $get_img); 
        
        $row_img = mysqli_fetch_array($run_img); 
        
        $c_image = $row_img['customer_image'];
        
        $c_name = $row_img['customer_name'];
        
        echo "<p style='text-align:center;'><img src='customer_images/$c_image' width='150' height='150'/></p>";
        
        ?>
            <a href="my_orders.php?my_orders" class="list-group-item">My Orders</a>
            <a href="edit_account.php" class="list-group-item">Edit Account</a>
            <a href="change_pass.php" class="list-group-item">Change Password</a>
            <a href="delete_account.php" class="list-group-item">Delete Account</a>

          </div>
      </div>

 <!-- ITEMS BRANDS AS A LIST GROUP -->
      <div class="container">
         
      </div>
    </div>
    <!-- CALL THE CART FUNCTION TO ADD AN ITEM TO THE CART -->
<?php cart(); ?>
    <!-- MAIN CONTENT AREA -->
    <div class="col-sm-10" style="background-color:skyblue;">

      <div style="width: 80%; height: 15%; background: black; color: white;">
        <span style="float: right; font-size: 18px; padding: 5px; line-height: 40px; margin-left: 0.5%;"> 

          <?php
          if(isset($_SESSION['customer_email'])){
          echo "<b>Welcome  </b>   "  .  $_SESSION['customer_email'];
        }
          ?>
          
          <?php 
          if (!isset($_SESSION['customer_email'])) {
            echo "<a href='../checkout.php' style='color: orange;'>Login</a>";
          }
          else{
            echo "<a href='../logout.php' style='color: orange;' >Logout</a>";
          }
           ?>

        </span>
      </div>
<!-- LET'S CALL AND ECHO THE IP ADDRESS OF THE USER IN THE WEBSITE -->
<?php echo"IP Address".$ip=getIp(); ?>
      <div id="products_box">

       <?php
       if(!isset($_GET['my_orders'])){
       if(!isset($_GET['edit_account'])){
       if(!isset($_GET['change_pass'])){
       if(!isset($_GET['delete_account'])){

           echo "
           <!-- IF CUSTOMER IS ACTIVE WELCOME THEM BY THEIR NAME -->
       <h2 style='padding: 20px; margin-top: 0px;''> Welcome <?php echo $c_name;?></h2>
           <b>To See Your Orders Progress Click Here <a href='my_account.php?my_orders'>link</a></b>";
     }
     }
     }
     }
       ?>

       <?php
       if(isset($_GET['edit_account'])){
       include("edit_account.php");
     }
       ?>
      </div>
    </div>
  </div>

  <!-- THE FOOTER -->
  <div class="row" style="text-align: center; padding: 20px; background: lavender;">
    <h2 style="margin-left: 30%;">Copyright &copy Bunduki.Inc | All Rights Reserved</h2>
  </div>
</div>
</body> 
</html> 