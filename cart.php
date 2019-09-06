<!DOCTYPE html>

<!-- INCLUDE THE functions.php FOLDER SO THAT THE getCats() AND THE getBrands() FUNCTIONS CAN OPERATE NORMALLY -->
<?php
 session_start();
 include("functions/functions.php");
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
    <!-- CALL THE CART FUNCTION TO ADD AN ITEM TO THE CART -->
<?php cart(); ?>
    <!-- MAIN CONTENT AREA -->
    <div class="col-sm-10" style="background-color:skyblue;">

      <div style="width: 80%; height: 6%; background: black; color: white;">
        <span style="float: right; font-size: 18px; padding: 5px; line-height: 40px; margin-left: 0.5%;">

             <?php
          if(isset($_SESSION['customer_email'])){
          echo "<b>Welcome  </b>   "  .  $_SESSION['customer_email'];
        }
        else{
          echo "<b>Welcome Guest</b>";
        }
          ?>
         
       <b style="color: red;"> Total Products:<?php echo "  "; total_items();//CALL THE total_items() FUNCTION TO DISPLAY THE TOTAL AMOUNT OF PRODUCTS ADDED TO CART?> Total Price:<?php total_price(); //CALL THE total_price() FUNCTION TO DISPLAY THE TOTAL AMOUNT OF MONEY FOR ALL THE ITEMS IN THE SHOPPING CART?> </b><a href="index.php" style="text-decoration: none;">Back to Shop</a>
       <br>
          <?php 
          if (!isset($_SESSION['customer_email'])) {
            echo "<a href='checkout.php' style='color: orange;'>Login</a>";
          }
          else{
            echo "<a href='logout.php' style='color: maroon;' >Logout</a>";
          }
           ?>

        </span>
      </div>
<!-- LET'S CALL AND ECHO THE IP ADDRESS OF THE USER IN THE WEBSITE -->
<?php echo"Your IP Address is".$ip=getIp(); ?>
      <div id="products_box">
        <br>
        <!-- THE MAIN SHOPPING CART -->
        <form action="" method="post" enctype="multipart/form-data">
          <table align="center" width="80%" bgcolor="cyan">
            <tr align="center">
              <th>Remove</th>
              <th>Product (S)</th>
              <th>Quantity</th>
              <th>Total Price</th>
            </tr>
<?php 
  // LET US SET THE DEFAULT TOTAL PRICE TO ZERO. i.e IF THERE ARE NO PRODUCTS IN THE CART, THE TOTAL PRICE WILL BE ZERO
    $total = 0;
    
    global $con; 
    
    // CAPTURE THE IP ADDRESS OF ANYBODY VISITING THIS WEBSITE 
    $ip = getIp(); 
    
    // GET THE PRODUCTS WHICH ARE ASSOCIATED WITH THE CAPTURED IP ADDRESS IN THE DATABASE
    $sel_price = "select * from cart where ip_add='$ip'";
    
    // query the database
    $run_price = mysqli_query($con, $sel_price); 
    
    while($p_price=mysqli_fetch_array($run_price)){
      
      $pro_id = $p_price['p_id']; 
      
      // WE USE THE p_id FROM THE cart TABLE TO OBTAIN MORE DATA FROM THE products TABLE BY RELATING p-id WITH product_id . THIS IS CREATING A RELATION. THIS IS POSSIBLE BECAUSE WE HAVE product id column in both the cart table and the products table. i.e p_id IN THE cart table AND product_id IN THE products table.
      // WE ARE TAKING DATA FROM PRODUCTS TABLE USING THE PRODUCT_ID AND USING THE PRODUCT_ID AS A REFERNCE TO GO TO THE CART TABLE TO OBTAIN MORE DATA
      $pro_price = "select * from products where product_id='$pro_id'";
      
      $run_pro_price = mysqli_query($con,$pro_price); 
      
      while ($pp_price = mysqli_fetch_array($run_pro_price)){
      
      $product_price = array($pp_price['product_price']);
      
      $product_title = $pp_price['product_title'];
      
      $product_image = $pp_price['product_image']; 
      
      $single_price = $pp_price['product_price'];
      
      $values = array_sum($product_price); 
      
      $total += $values; 
          
          ?>
          
          <tr align="center">
            <!-- DISPLAY THE PRODUCT CHECKBOXES BELOW THE REMOVE HEADING-->
            <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"/></td>
            <!-- PRINT THE PRODUCT TITLE BELOW THE PRODUCT(S) HEADING -->
            <td><?php echo $product_title; ?><br>
              <!-- DISPLAY THE PRODUCT IMAGE NEXT BELOW THE PRODUCT TITLE -->
            <img src="admin_area/product_images/<?php echo $product_image;?>" width="60" height="60"/>
            </td>
            <!-- INDICATE THE TEXTFIELD FOR INPUTTING THE QUANTITY OF THE PRODUCTS -->
            <td><input type="text" size="4" name="qty" value="<?php echo $_SESSION['qty'];?>"/></td>
            <?php 
            // CODE FOR COMPUTING THE PRICE OF MANY QUANTITIES OF A SINGLE PRODUCT
            if(isset($_POST['update_cart'])){//WHEN THE BUTTON NAMED update_cart IS CLICKED, STORE THE THE VALUES OF THE INPUT TEXT NAME qty IN THE VARIABLE CALLED $qty
            
              $qty = $_POST['qty'];
              
              $update_qty = "update cart set qty='$qty'";
              
              $run_qty = mysqli_query($con, $update_qty); 
              
              // NOW WE USE SESSIONS TO STORE/KEEP THE QUANTITY VALUE ENTRED BY THE CUSTOMER WE USE SESSSIONS
              $_SESSION['qty']=$qty;
              
              $total = $total*$qty;
            }
            
            
            ?>
            
            <!-- PRINT THE PRICE OF THE PRODUCTS -->
            <td><?php echo "KSh " . $single_price; ?></td>
          </tr>
          
          
        <?php } } ?>
        
        <tr>
           <!-- PRINT THE SUBTOTAL PRICE -->
            <td colspan="4" align="right"><b>Sub Total:</b></td>
            <td><?php echo "$" . $total;?></td>
          </tr>
          
          <tr align="center">
            <td colspan="2"><input type="submit" name="update_cart" value="Update Cart"/></td>
            <td><input type="submit" name="continue" value="Continue Shopping" /></td>
            <td><button><a href="checkout.php" style="text-decoration:none; color:black;">Checkout</a></button></td>
          </tr>
          
        </table> 
      <td><b> <a href="#" style="text-decoration: none; color: green; font-size: 30; margin-top: 10px;">Print</a> </b></td>
      </form>
      
  <?php 
    // IF THE WHOLE ISSET IS NOT HECTILE IT GENERATES AN ERROR WHICH IS REMOVED BY CREATING A FUNCTION
  function updatecart(){
    
    global $con; 
    
    $ip = getIp();
    
    // DELETE FROM THE SHOPPING CART THE PRODUCTS WHICH ARE SELECTED FOR REMOVE UPON CLICKING OF THE UPDATE_CART BUTTON
    if(isset($_POST['update_cart'])){
    
      foreach($_POST['remove'] as $remove_id){
      
      $delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
      
      $run_delete = mysqli_query($con, $delete_product); 
      
      if($run_delete){
      
      echo "<script>window.open('cart.php','_self')</script>";
      
      }
      
      }
    
    }
    if(isset($_POST['continue'])){
    
    echo "<script>window.open('index.php','_self')</script>";
    
    }
  
  }
  // TO ADD @ PRESS SHIFT + A. IT SIMPLY MEANS IF THE WHOLE FUNCTION IS NOT WORKING, IT WILL NOT GENERATE AN ERROR
  echo @$up_cart = updatecart();
  
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