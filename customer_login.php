<?php 
include("includes/db.php");
 ?>
<div>
	<form method="POST" action="">
		<table width="500" align="center" bgcolor="cyan">
			<tr align="center">
				<td colspan="4"><h2>Login or Register to Buy</h2></td>
			</tr>
			<tr>
				<td align="right"><b>Email</b></td>
				<td><input type="text" name="email" placeholder="Enter Email" required></td>
			</tr>
			<tr>
				<td align="right"><b>Password</b></td>
				<td><input type="Password" name="pass" placeholder="Enter Password" required></td>
			</tr>
			<tr align="center">
				<td colspan="3"><a href="checkout.php?forgot_pass" style="text-decoration: none;">Forgot Password</a></td>
			</tr>
			<tr align="center">
				<td colspan="3"><input type="submit" name="login" value="Login"></td>
			</tr>

		</table>

		<h2 style="float: right; padding-right: : 25px; "><a href="customer_register.php" style="text-decoration: none;">New? Register Here</a></h2>
	</form>

	<?php
	if (isset($_POST['login'])) {
	 	$c_email = $_POST['email'];
	 	$c_pass = md5($_POST['pass']); 

	 	$select_customer = "SELECT * FROM customers WHERE customer_pass='$c_pass' AND customer_email='$c_email'";

	 	$run_customer = mysqli_query($con, $select_customer);

	 	$check_customer = mysqli_num_rows($run_customer);

	 	if ($check_customer==0) {
	 		echo "<script>alert('Wrong Password or Email')</script>";
	 		exit();
	 	}

	 $ip = getIp();
	 	// CHECK IF THE IP ADSRESS BEING REGISTERD IS ALREADY EXISTING IN THE DATABASE
  $select_cart = "SELECT * FROM cart WHERE ip_add='$ip'";

  $run_cart = mysqli_query($con, $select_cart);

  $check_cart = mysqli_num_rows($run_cart);
  	//IF A CUSTOMER EXIST AND THERE IS ONLY ONE SUCH CUSTOMER, SEND THIS PERSON TO THEIR ACCOUNT
  if ($check_customer>0 AND $check_cart==0) {
  	// REGISTER CUSTOMER EMAIL AS SESSION
    $_SESSION['customer_email']=$c_email;
    echo "<script>alert('You Logged In Successfuly')</script>";
    echo "<script>window.open('customer/my_account.php','_self')</script>";
  }
  else{
  	// REGISTER CUSTOMER EMAIL AS SESSION
    $_SESSION['customer_email']=$c_email;
    echo "<script>alert('You Logged In Successfully !!')</script>";
    echo "<script>window.open('checkout.php','_self')</script>";
  }
	 } 
	 ?>
</div>