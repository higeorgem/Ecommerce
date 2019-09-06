<?php
session_start();
include('../functions/functions.php');
?>
<?php   
        include("../includes/db.php"); 
        
        // $user = $_SESSION['customer_email'];
        $user = (isset($_SESSION['customer_email']) ? $_SESSION['customer_email'] : "Guest");
        
        $get_customer = "select * from customers where customer_email='$user'";
        
        $run_customer = mysqli_query($con, $get_customer); 
        
        $row_customer = mysqli_fetch_array($run_customer); 
        
        $c_id = $row_customer['customer_id'];
        $name = $row_customer['customer_name'];
        $email = $row_customer['customer_email'];
        $pass = md5($row_customer['customer_pass']);
        $country = $row_customer['customer_country'];
        $city = $row_customer['customer_city'];
        $contact = $row_customer['customer_contact'];
        $address= $row_customer['customer_address'];
        $image = $row_customer['customer_image'];
        
        
    ?>

<!-- LET'S CALL AND ECHO THE IP ADDRESS OF THE USER IN THE WEBSITE -->
<?php echo"Your IP Address is".$ip=getIp(); ?>

      <!-- ACTION DETERMINES TO WHICH PAGE THE PERSON SHOULD GO AFTER CLICKING SUBMIT BUTTON  METHOD DETERMINES TO WHICH METHOD THAT WE ARE RECEIVING THE DATA. GET method shows data in the browser while POST method hides the data -->
        
    <form action="" method="post" enctype="multipart/form-data" >
          
          <table align="center" width="750" bgcolor="cyan">
            
            <tr align="center">
              <td colspan="6"><h2>Update your Account</h2></td>
            </tr>
            
            <tr>
              <td align="right">Customer Name:</td>
              <td><input type="text" name="c_name" value="<?php echo $name;?>" required/></td>
            </tr>
            
            <tr>
              <td align="right">Customer Email:</td>
              <td><input type="text" name="c_email" value="<?php echo $email;?>" required/></td>
            </tr>
            
            <tr>
              <td align="right">Customer Password:</td>
              <td><input type="password" name="c_pass" value="<?php echo $pass;?>" required/></td>
            </tr>
            
            <tr>
              <td align="right">Customer Image:</td>
              <td><input type="file" name="c_image"/><img src="customer_images/<?php echo $image; ?>" width="50" height="50"/></td>
            </tr>
            
            
            
            <tr>
              <td align="right">Customer Country:</td>
              <td>
              <select name="c_country" disabled>
                <option><?php echo $country; ?></option>
                          <option>Select Country</option>
                          <option>Kenya</option>
                          <option>Uganda</option>
                          <option>Tanzania</option>
                          <option>Ethiopia</option>
                          <option>Burundi</option>
                          <option>Rwanda</option>
                          <option>Sudan</option>
                          <option>Egypt</option>
              </select>
              
              </td>
            </tr>
            
            <tr>
              <td align="right">Customer City:</td>
              <td><input type="text" name="c_city" value="<?php echo $city;?>"/></td>
            </tr>
            
            <tr>
              <td align="right">Customer Contact:</td>
              <td><input type="text" name="c_contact" value="<?php echo $contact;?>"/></td>
            </tr>
            
            <tr>
              <td align="right">Customer Address</td>
              <td><input type="text" name="c_address" value="<?php echo $address;?>"/></td>
            </tr>
            
            
          <tr align="center">
            <td colspan="6"><input type="submit" name="update" value="Update Account" /></td>
          </tr>
          
          
          
          </table>
        
        </form>

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