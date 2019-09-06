<!DOCTYPE html>

<!-- INCLUDE THE functions.php FOLDER SO THAT THE getCats() AND THE getBrands() FUNCTIONS CAN OPERATE NORMALLY -->
<?php include("functions/functions.php");?>
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
      <a class="nav-link" href="index.php" >Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="all_products.php" >All Products</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="customer/my_account.php" >My Account</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="customer_register.php" >Signup</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="cart.php" >Shopping Cart</a>
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
          <h2>CATEGORIES</h2>
          <div class="list-group">
            <!-- LETS CALL THE getCats FUNCTION TO DISPLAY THE LIST OF CATEGORIES FROM THE DATABASE -->
            <?php getCats();?>
            <!-- <a href="#" class="list-group-item">CELLPHONES</a>
            <a href="#" class="list-group-item">CAMERAS</a>
            <a href="#" class="list-group-item">CLOTHES</a>
            <a href="#" class="list-group-item">LAPTOPS</a>
            <a href="#" class="list-group-item">VEHICLES</a>
            <a href="#" class="list-group-item">SHOES</a> -->
          </div>
      </div>

 <!-- ITEMS BRANDS AS A LIST GROUP -->
      <div class="container">
          <h2>BRANDS</h2>
          <div class="list-group">
             <!-- LETS CALL THE getBrands FUNCTION TO DISPLAY THE LIST OF CATEGORIES FROM THE DATABASE -->
             <?php getBrands();?>
            <!-- <a href="#" class="list-group-item">HP</a>
            <a href="#" class="list-group-item">SONY</a>
            <a href="#" class="list-group-item">DELL</a>
            <a href="#" class="list-group-item">BATA</a>
            <a href="#" class="list-group-item">MITUMBA</a> -->
          </div>
      </div>
    </div>

    <!-- MAIN CONTENT AREA -->
    <div class="col-sm-10" style="background-color:skyblue;">

      <div style="width: 80%; height: 7%; background: black; color: white;">
        <span style="float: right; font-size: 18px; padding: 5px; line-height: 40px; margin-left: 0%;">
          <?php 
          if(isset($_SESSION['customer_email'])){
          echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'> Your</b>" ;
          }
          else {
          echo "<b>Welcome Guest:</b>";
          }
          ?>
          <b style="color: red;">Total Products:<?php echo "  "; total_items();//CALL THE total_items() FUNCTION TO DISPLAY THE TOTAL AMOUNT OF PRODUCTS ADDED TO CART?> Total Price:<?php total_price(); //CALL THE total_price() FUNCTION TO DISPLAY THE TOTAL AMOUNT OF MONEY FOR ALL THE ITEMS IN THE SHOPPING CART?> </b> <a href="cart.php" style="text-decoration: none;">Open Cart</a></span>
      </div>
<!-- LET'S CALL AND ECHO THE IP ADDRESS OF THE USER IN THE WEBSITE -->
<?php echo"YA IP Address is".$ip=getIp(); ?>
        <?php
        // capture the product id from the url
        if (isset($_GET['pro_id'])) {
          // store the product id captured from the url in a variable
          $product_id = $_GET['pro_id'];
          // CODE TO GET 8 RANDOM PRODUCTS FROM THE DATABASE
$get_pro = "SELECT * FROM products WHERE product_id='$product_id'";
$run_pro = mysqli_query($con, $get_pro);
while ($row_pro=mysqli_fetch_array($run_pro)) {
      $pro_id = $row_pro['product_id'];
      $pro_title = $row_pro['product_title'];
      $pro_price = $row_pro['product_price'];
      $pro_image = $row_pro['product_image'];
      $pro_desc = $row_pro['product_desc'];
    
  // DISPLAYING PRODUCTS IN THE MAIN CONTENT AREA
    echo "
        <div id='single_product' style=''>
        
          <h3 style='text-align:center; margin-left: 40%;'>$pro_title</h3>
          
          <img src='admin_area/product_images/$pro_image' width='500' height='450' style='margin-left:20%;'/>

          <p><b style='text-align:center; margin:0px; padding:0px; margin-left:50%;'>Price Ksh. $pro_price</b></p>

          <p style='text-align:center; margin:0px;'>$pro_desc</>

          <br>

          <a href='index.php' style='float:left; margin:0%; margin-left:15%; padding:0%;'>Back</a>
          <a href='index.php?pro_id=$pro_id'><button style='float:right;margin:0%; padding:0%;'>Add To Cart</button></a>
          </div>
          ";
}
        }
        
        ?>
    </div>
  </div>

  <!-- THE FOOTER -->
  <div class="row" style="text-align: center; padding: 20px; background: lavender;">
    <h2 style="margin-left: 30%;">Copyright &copy Bunduki.Inc | All Rights Reserved</h2>
  </div>
</div>
</body> 
</html>