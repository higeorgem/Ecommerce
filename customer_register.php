<!DOCTYPE html>

<!-- INCLUDE THE functions.php FOLDER SO THAT THE getCats() AND THE getBrands() FUNCTIONS CAN OPERATE NORMALLY -->
<?php 
// START THE SESSION
session_start();
include("functions/functions.php");
include("includes/db.php");
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
          echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'> Your</b>" ;
          }
          else {
          echo "<b>Welcome Guest:</b>";
          }
          ?>
          <b style="color: red;"> Total Products:<?php echo "  "; total_items();//CALL THE total_items() FUNCTION TO DISPLAY THE TOTAL AMOUNT OF PRODUCTS ADDED TO CART?> Total Price:<?php total_price(); //CALL THE total_price() FUNCTION TO DISPLAY THE TOTAL AMOUNT OF MONEY FOR ALL THE ITEMS IN THE SHOPPING CART?> </b><a href="cart.php" style="text-decoration: none;">Open Cart</a></span>
      </div>
<!-- LET'S CALL AND ECHO THE IP ADDRESS OF THE USER IN THE WEBSITE -->
<?php echo"YA IP Address is".$ip=getIp(); ?>

      <!-- ACTION DETERMINES TO WHICH PAGE THE PERSON SHOULD GO AFTER CLICKING SUBMIT BUTTON  METHOD DETERMINES TO WHICH METHOD THAT WE ARE RECEIVING THE DATA. GET method shows data in the browser while POST method hides the data -->
      <form action="customer_register.php" method="POST" enctype="multipart/form-data" >
        <table align="center" width="750" bgcolor="cyan">
          <tr align="center">
            <td colspan="8"><h2>Create an Account</h2></td>
          </tr>

          <tr>
            <td align="right">Customer Name</td>
            <td><input type="text" name="c_name" required></td>
          </tr>

          <tr>
            <td align="right">Customer Email</td>
            <td><input type="text" name="c_email" required></td>
          </tr>

          <tr>
            <td align="right">Customer Password</td>
            <td><input type="password" name="c_pass" required></td>
          </tr>

           <tr>
            <td align="right">Customer Image</td>
            <td><input type="file" name="c_image" required></td>
          </tr>

          <tr>
            <td align="right">Customer Country</td>
            <td>
              <select name="c_country">
                <option>Select Country</option>
                <option>Kenya</option>
                <option>Uganda</option>
                <option>Tanzania</option>
                <option>Ethiopia</option>
                <option>Burundi</option>
                <option>Rwanda</option>
                <option>Sudan</option>
                <option>Egypt</option>
                <option>South Africa</option>
              </select>
            </td>
          </tr>

          <tr>
            <td align="right">Customer City</td>
            <td><input type="text" name="c_city" required></td>
          </tr>


          <tr>
            <td align="right">Customer Contact</td>
            <td><input type="text" name="c_contact" required></td>
          </tr>

          <tr>
            <td align="right">Customer Address</td>
            <td><input type="text" name="c_address" required></td>
          </tr>

          <tr align="center">
            <td colspan="6"><input type="submit" name="register" value="Create Account"></td>
          </tr>
        </table>
      </form>
    </div>
  </div>

  <!-- THE FOOTER -->
  <div class="row" style="text-align: center; padding: 20px; background: lavender;">
    <h2 style="margin-left: 30%;">Copyright &copy Bunduki.Inc | All Rights Reserved</h2>
  </div>
</div>
</body> 
</html>

<?php 
if (isset($_POST['register'])) {
  
  $ip = getIp();

  $c_name = $_POST['c_name']; 

  $c_email = $_POST['c_email'];

  $c_pass = md5($_POST['c_pass']);

  // FOR IMAGE WE DONT USE $_POST ARRAY BUT WE USE $_FILES ARRAY
  $c_image = $_FILES['c_image'];

  // BELOW IS THE SYNTAX FOR GETTING THE IMAGE DATA
  $c_image_tmp = $_FILES['c_image'] ['tmp_name'];

  $c_country = $_POST['c_country']; 

  $c_city = $_POST['c_city']; 

  $c_contact = $_POST['c_contact']; 

  $c_address = $_POST['c_address']; 

  move_uploaded_file($c_image_tmp, 'customer/customer_images/$c_image');

  $insert_customer = "INSERT INTO customers(customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) values('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')"; 

  $run_insert_customer_ = mysqli_query($con, $insert_customer);

  // if ($run_insert_customer) {
  //   echo "<script>alert('Successfully Registered')</script>";
  //   echo "<br>";
  //   echo"<script>window.open('cart.php','_self')</script>";
  // }


// CHECK IF THE IP ADSRESS BEING REGISTERD IS ALREADY EXISTING IN THE DATABASE
  $select_cart = "SELECT * FROM cart WHERE ip_add='$ip'";

  $run_cart = mysqli_query($con, $select_cart);

  $check_cart = mysqli_num_rows($run_cart);

// IF THE IP/USER DOES NOT EXIST THEN REGISTER THEM
  if ($check_cart==0) {
    // REGISTER CUSTOMER EMAIL AS SESSION
    $_SESSION['customer_email']=$c_email;
    echo "<script>alert('Account Successfully Created!!')</script>";
    echo "<script>window.open('customer/my_account.php','_self')</script>";
  }
  // OTHERWISE IF THE CUSTOMER/IP IS ALREADY REGISTERED THEN REDIRECT THEM TO THE CHECKOUT PAGE 
  else{
    // REGISTER CUSTOMER EMAIL AS SESSION
    $_SESSION['customer_email']=$c_email;
    echo "<script>alert('Account Successfully Created!!')</script>";
    echo "<script>window.open('checkout.php','_self')</script>";
  }
}
 ?> 