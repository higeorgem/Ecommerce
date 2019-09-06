    <?php
            // LET US SET THE DEFAULT TOTAL PRICE TO ZERO. i.e IF THERE ARE NO PRODUCTS IN THE CART, THE TOTAL PRICE WILL BE ZERO
    $total = 0;
    // CAPTURE THE IP ADDRESS OF ANYBODY VISITING THIS WEBSITE 
    $ip = getIp();

     global $con;

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
        // $product_price = $pp_price['product_price'];

        $product_price  = array($pp_price['product_price'] );

        // $values = array_sum($product_price);

        $product_title = $pp_price['product_title'];

        $product_image = $pp_price['product_image'];

        $single_price = $pp_price['product_price'];

        $values = array_sum($product_price);

        $total += $values;
  
    ?>

    <tr>
      <!-- DISPLAY THE PRODUCT CHECKBOXES BELOW THE REMOVE HEADING-->
      <td> <input type="checkbox" name="remove[]" value="<?php echo $pro_id ?>"></td>
      <!-- PRINT THE PRODUCT TITLE BELOW THE PRODUCT(S) HEADING -->
      <td><?php echo $product_title; ?><br>
        <!-- DISPLAY THE PRODUCT IMAGE NEXT BELOW THE PRODUCT TITLE -->
        <img src="admin_area/product_images/<?php echo $product_image;?>" width="50" height="45" />
      </td>
      <!-- INDICATE THE TEXTFIELD FOR INPUTTING THE QUANTITY OF THE PRODUCTS -->
      <td> <input type="text" size="6" name="qty" value="<?php echo $_SESSION['qty'];//we have stored the value Quantity in a session?>"/></td>
      <?php 
      // CODE FOR COMPUTING THE PRICE OF MANY QUANTITIES OF A SINGLE PRODUCT
      if (isset($_POST['update_cart'])) { //WHEN THE BUTTON NAMED update_cart IS CLICKED, STORE THE THE VALUES OF THE INPUT TEXT NAME qty IN THE VARIABLE CALLED $qty

              $qty = $_POST['qty'];
              
              $update_qty = "UPDATE cart SET qty='$qty'";
              
              $run_qty = mysqli_query($con, $update_qty); 

              // NOW WE USE SESSIONS TO STORE/KEEP THE QUANTITY VALUE ENTRED BY THE CUSTOMER WE USE SESSSIONS
              $_SESSION['qty']=$qty;
              
              $total = $total*$qty;
            }
       ?>
      <!-- PRINT THE PRICE OF THE PRODUCTS -->
      <td> <?php echo "KSh ".$single_price; ?></td>
    </tr>

    <?php } } ?>
    <!-- PRINT THE SUBTOTAL PRICE -->
    <tr align="right">
      <td colspan="5"><b>Sub Total</b></td>
      <td colspan="4"><?php echo "KSh ".$total; ?></td>
    </tr>

    <tr>
      <td colspan="2"><input type="submit" name="update_cart" value="Update Cart"></td>
      <td><input type="submit" name="continue" value="Continue Shopping"></td>
      <td><button><a href="checkout.php" style="text-decoration: none; color: black">Checkout</a></button></td>
    </tr>
          </table>
        </form>

        <?php 
        // IF THE WHOLE ISSET IS NOT HECTILE IT GENERATES AN ERROR WHICH IS REMOVED BY CREATING A FUNCTION
        function updatecart(){

        global $con;

        $ip = getIp();

        // DELETE FROM THE SHOPPING CART THE PRODUCTS WHICH ARE SELECTED FOR REMOVE UPON CLICKING OF THE UPDATE_CART BUTTON
        if (isset($_POST['update_cart'])) {

          foreach ($_POST['remove'] as $remove_id) {

            $delete_product = "DELETE FROM cart WHERE p_id='$remove_id' AND ip_add='$ip'";

            $run_delete = mysqli_query($con, $delete_product);

            if ($run_delete) {
              echo "<script>window.open('cart.php', '_self')</script>";
            }
          }
        }
        if (isset($_POST['continue'])) {
          echo "<script>Window.open('index.php','_self')</script ";
        }

        echo @$up_cart = updatecart();
        // TO ADD @ PRESS SHIFT + A. IT SIMPLY MEANS IF THE WHOLE FUNCTION IS NOT WORKING, IT WILL NOT GENERATE AN ERROR
      }
         ?>