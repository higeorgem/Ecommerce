<!DOCTYPE html>
<html>
<head>
	<title></title>

	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
	<link rel="stylesheet" type="text/css" href="../styles/style.css">

	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="../bootstrap/css/bootstrap.min.js"></script>
</head>
<body>
<?php
// After uploading to online server, change this connection accordingly
$con = mysqli_connect("localhost","root","","ecommerce");

if (mysqli_connect_errno())
  {
  echo "The Connection was not established: " . mysqli_connect_error();
  }

   // getting the user IP address
  function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

  // PHP cart() FUNCTION CODE FOR ADDING A PRODUCT TO THE CART
  function cart(){
  	// CODE BELOW WILL EXECUITE IF A PERSON CLICKS THE ADD TO CART BUTTON
  	if (isset($_GET['pro_id'])) {
  		global $con;
// CREATE A VARIABLE TO HOLD/STORE THE IP ADDRESS OBTAINED BY THE FUNCTION getIp()
  		$ip = getIp();

  		$pro_id = $_GET['pro_id'];
// CODE TO CHECK IF THE CUSTOMER HAS ALREADY ADDED THE PARTICULAR PRODUCT TO THE CART
  		$check_pro = "SELECT * FROM cart WHERE ip_add='$ip' AND p_id='$pro_id'";

  		$run_check = mysqli_query($con, $check_pro);
// IF THE PRODUCT ALREADY EXISTS IN THE CART, JUST REFRESH THE PAGE BUT DO NOTHING
  		if (mysqli_num_rows($run_check)>0) {
  			echo ""; 
  			echo("<script>document.innerHTML('You have already added this product to cart');</script>");
  		}else{
  			// OTHERWISE IF THE PRODUCT DOES NOT ALREADY EXIST IN THE CART, ADD IT/INSERT IT TO THE CART
  			$insert_pro = "INSERT INTO cart (p_id,ip_add) VALUES ('$pro_id','$ip')";

  			$run_pro = mysqli_query($con, $insert_pro);

  			// REFRESH THE PAGE AND GO TO INDEX PAGE
  			echo "<script>window.open('index.php','_self')</script>";

  		}
  	}
  }
 // PHP FUNCTION TO GET THE TOTAL ITEMS ADDED TO THE  CART
  function total_items(){
  	if (isset($_GET['pro_id'])) {
  		global $con;
  		$ip = getIp();
  		$get_items = "SELECT * FROM cart WHERE ip_add='$ip'";
  		$run_items = mysqli_query($con, $get_items);
  		$count_items = mysqli_num_rows($run_items);
  	}else{
  		global $con;
  		$ip = getIp();
  		$get_items = "SELECT * FROM cart WHERE ip_add='$ip'";
  		$run_items = mysqli_query($con, $get_items);
  		$count_items = mysqli_num_rows($run_items);
  	}
  	echo $count_items;
  }
  // GETTING THE TOTAL PRICE OF THE ITEMS IN THE CART
  function total_price(){
  	// LET US SET THE DEFAULT TOTAL PRICE TO ZERO. i.e IF THERE ARE NO PRODUCTS IN THE CART, THE TOTAL PRICE WILL BE ZERO
  	$total = 0;
  	global $con;
  	// CAPTURE THE IP ADDRESS OF ANYBODY VISITING THIS WEBSITE 
  	$ip = getIp();
  	// GET THE PRODUCTS WHICH ARE ASSOCIATED WITH THE CAPTURED IP ADDRESS IN THE DATABASE
  	$sel_price = "SELECT * FROM cart WHERE ip_add='$ip'";
 		// query the database
  	$run_price = mysqli_query($con, $sel_price);

  	while ($p_price=mysqli_fetch_array($run_price)) {
  		$pro_id = $p_price['p_id'];
  		// WE USE THE p_id FROM THE cart TABLE TO OBTAIN MORE DATA FROM THE products TABLE BY RELATING p-id WITH product_id . THIS IS CREATING A RELATION. THIS IS POSSIBLE BECAUSE WE HAVE product id column in both the cart table and the products table. i.e p_id IN THE cart table AND product_id IN THE products table.
  		// WE ARE TAKING DATA FROM PRODUCTS TABLE USING THE PRODUCT_ID AND USING THE PRODUCT_ID AS A REFERNCE TO GO TO THE CART TABLE TO OBTAIN MORE DATA
  		$pro_price ="SELECT * FROM products WHERE product_id='$pro_id'";

  		$run_pro_price = mysqli_query($con,$pro_price);

  		while ($pp_price = mysqli_fetch_array($run_pro_price)) {
  			$product_price = $pp_price['product_price'];

  			$product_price  = array($pp_price['product_price'] );

  			$values = array_sum($product_price);
  			// INCREMENT THE TOTAL PRICE AS MORE PRODUCTS GET ADDED
  			$total += $values;
  		}
  	}
  	echo "  Ksh ". $total;
  }

// THIS FUNCTION IS FOR GETTING THE CATEGORIES FROM THE DATABASE AND DISPLAYING THEM IN THE WEBSITE
function getCats(){
	// TO ACCESS A VARIABLE OUTSIDE A FUNCTION WE MAKE IT global
	global $con;

	$get_cats = "SELECT * FROM categories";

	$run_cats = mysqli_query($con, $get_cats);

	while ($row_cats = mysqli_fetch_array($run_cats)) {
		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];

		echo "<a href='index.php?cat=$cat_id'class='list-group-item'>$cat_title</a>";
	}
}
// THIS FUNCTION IS FOR GETTING THE BRANDS FROM THE DATABASE AND DISPLAYING THEM IN THE WEBSITE
function getBrands(){
	// TO ACCESS A VARIABLE OUTSIDE A FUNCTION WE MAKE IT global
	global $con;

	$get_brands = "SELECT * FROM brands";

	$run_brands = mysqli_query($con, $get_brands);
// Do not make a mistake of initiallising the $row_brands=mysqli_fetch_array($run_brands); the calling it in the while($row_brands). This will create an unending loop of brands
	while ($row_brands = mysqli_fetch_array($run_brands)) {
		$brand_id = $row_brands['brand_id'];
		$brand_title = $row_brands['brand_title'];

		echo "<a href='index.php?brand=$brand_id'class='list-group-item'>$brand_title</a>";
	}
}
//BELOW IS A PHP FUNCTION TO OBTAIN PRODUCTS FROM THE DATABSE AND DISPLAY THEM IN THE WEBSITE
function getPro(){
	if (!isset($_GET['cat'])) {
		if (!isset($_GET['brand'])) {
		// TO USE A FUNCTION THAT IS OUTSIDE A FUNCTION WE HAVE TO MAKE IT GLOBAL FIRST.
	global $con;
// CODE TO GET 8 RANDOM PRODUCTS FROM THE DATABASE
$get_pro = "SELECT * FROM products ORDER BY RAND() LIMIT 0,8";
$run_pro = mysqli_query($con, $get_pro);
while ($row_pro=mysqli_fetch_array($run_pro)) {
	    $pro_id = $row_pro['product_id'];
		$pro_cat = $row_pro['product_cat'];
		$pro_brand = $row_pro['product_brand'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_image'];
	
	// DISPLAYING PRODUCTS IN THE MAIN CONTENT AREA
		echo "
				<div id='single_product' style=''>
				
					<h3>$pro_title</h3>
					
					<img src='admin_area/product_images/$pro_image' width='250' height='180' />

					<p><b style='margin:0%;padding:0%;'>Price Ksh. $pro_price</b></p>

					<a href='details.php?pro_id=$pro_id' style='float:left; margin:0%;padding:0%;'>Details</a>
					<a href='index.php?pro_id=$pro_id'><button style='float:right;margin:0%; padding:0%;'>Add To Cart</button></a>
					</div>
					";
}
}
	}
	
}
// THIS FUNCTION DISPLAYS PRODUCTS OF A PARTICULAR SELECTED CATEGORY ONLY
function getCatPro(){
	if (isset($_GET['cat'])) {
		$cat_id = $_GET['cat'];
		// TO USE A FUNCTION THAT IS OUTSIDE A FUNCTION WE HAVE TO MAKE IT GLOBAL FIRST.
	global $con;
// CODE TO GET 8 RANDOM PRODUCTS FROM THE DATABASE
$get_cat_pro = "SELECT * FROM products WHERE product_cat=$cat_id";
$run_cat_pro = mysqli_query($con, $get_cat_pro);

$count_cats = mysqli_num_rows($run_cat_pro);

if ($count_cats==0) {
	// IF THERE ARE NO PRODUCTS IN IN THEB BRAND OR CATEGORY YOU HAVE SELECTED, DISPLAY THE MESSAGE BELOW
	echo "<h2>There are no products for this Category</h2>";
	exit();
}else{
while ($row_cat_pro=mysqli_fetch_array($run_cat_pro)) {
	    $pro_id = $row_cat_pro['product_id'];
		$pro_cat = $row_cat_pro['product_cat'];
		$pro_brand = $row_cat_pro['product_brand'];
		$pro_title = $row_cat_pro['product_title'];
		$pro_price = $row_cat_pro['product_price'];
		$pro_image = $row_cat_pro['product_image'];
	
	// DISPLAYING PRODUCTS IN THE MAIN CONTENT AREA
		echo "
				<div id='single_product' style=''>
				
					<h3>$pro_title</h3>
					
					<img src='admin_area/product_images/$pro_image' width='250' height='180' />

					<p><b style='margin:0%;padding:0%;'>Price Ksh. $pro_price</b></p>

					<a href='details.php?pro_id=$pro_id' style='float:left; margin:0%;padding:0%;'>Details</a>
					<a href='index.php?pro_id=$pro_id'><button style='float:right;margin:0%; padding:0%;'>Add To Cart</button></a>
					</div>
					";
				}
}
}	
}

// HIS FUNCTION DISPLAYS PRODUCTS OF A PARTICULAR SELECTED BRAND ONLY
function getBrandPro(){
	if (isset($_GET['brand'])) {
		$brand_id = $_GET['brand'];
		// TO USE A FUNCTION THAT IS OUTSIDE A FUNCTION WE HAVE TO MAKE IT GLOBAL FIRST.
	global $con;
// CODE TO GET 8 RANDOM PRODUCTS FROM THE DATABASE
$get_brand_pro = "SELECT * FROM products WHERE product_brand=$brand_id";
$run_brand_pro = mysqli_query($con, $get_brand_pro);

$count_brands = mysqli_num_rows($run_brand_pro);

if ($count_brands==0) {
	echo "<h2>There are no products for this Brand</h2>";
	exit();
}else{
while ($row_brand_pro=mysqli_fetch_array($run_brand_pro)) { 
	    $pro_id = $row_brand_pro['product_id'];
		$pro_cat = $row_brand_pro['product_cat'];
		$pro_brand = $row_brand_pro['product_brand'];
		$pro_title = $row_brand_pro['product_title'];
		$pro_price = $row_brand_pro['product_price'];
		$pro_image = $row_brand_pro['product_image'];
	
	// DISPLAYING PRODUCTS IN THE MAIN CONTENT AREA
		echo "
				<div id='single_product' style=''>
				
					<h3>$pro_title</h3>
					
					<img src='admin_area/product_images/$pro_image' width='250' height='180' />

					<p><b style='margin:0%;padding:0%;'>Price Ksh. $pro_price</b></p>

					<a href='details.php?pro_id=$pro_id' style='float:left; margin:0%;padding:0%;'>Details</a>
					<a href='index.php?pro_id=$pro_id'><button style='float:right;margin:0%; padding:0%;'>Add To Cart</button></a>
					</div>
					";
				}
}
}	
}
?>
</body>
</html>