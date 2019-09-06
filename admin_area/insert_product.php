<!DOCTYPE html>

<?php
include("includes/db.php"); 
?>
<html>
<head>
	<title>Insert Product</title>
	
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
	<link rel="stylesheet" type="text/css" href="../styles/style.css">

	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="../bootstrap/css/bootstrap.min.js"></script>
</head>
<body>

<form action="insert_product.php" method="post" enctype="multipart/form-data" style="margin-top: 0px;">

		<div class="table-responsive">
	<table class="" border="2" bgcolor="skyblue" align="center" width="80%" height="70%">
	
			<!-- <legend style="margin-left: 45%; font-weight: bold; font-size: 24px;">Insert Product</legend> -->
			<thead>
				<tr align="center">
				<th colspan="8"><h2>Insert New Product</h2></th>
			</tr>
			</thead>

			<tbody>
			<tr>
				<td align="right"><b>Product Title</b></td>
				<td align="left"><input type="text" name="product_title" size="50" required></td>
			</tr>
			<br>
			<tr>
				<td align="right"><b>product Category</b></td>
				<td>
					<select name="product_cat" required>
						<option>Select a Category</option>
						<?php
						// TO ACCESS A VARIABLE OUTSIDE A FUNCTION MAKE IT GLOBAL
						global $con;
						// BELOW IS THE CODE TO DISPLAY A DROPDOWN MENU OF CATEGORIES TO SELECT FROM
						$get_cats = "SELECT * FROM categories";

	$run_cats = mysqli_query($con, $get_cats);

	while ($row_cats = mysqli_fetch_array($run_cats)) {
		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];

		echo "<option value='$cat_id'>$cat_title</option>";
	} ?>
					</select>
				</td>
			</tr>
		
			<br>
			<tr>
				<td align="right"><b>product Brand</b></td>
				<td>
					<select name="product_brand" required>
						<option>Select a Brand</option>
						<?php
						// TO ACCESS A VARIABLE OUTSIDE A FUNCTION MAKE IT GLOBAL
						global $con;
						// BELOW IS THE CODE TO DISPLAY A DROPDOWN MENU OF BRANDS TO SELECT FROM
						$get_brands = "SELECT * FROM brands";

	$run_brands = mysqli_query($con, $get_brands);

	while ($row_brands = mysqli_fetch_array($run_brands)) {
		$brand_id = $row_brands['brand_id'];
		$brand_title = $row_brands['brand_title'];

		echo "<option value='$brand_id'>$brand_title</option>";
	} ?>
					</select>
				</td>
			</tr>
			<br>
			<tr>
				<td align="right"><b>Product Image</b></td>
				<td align="left"><input type="file" name="product_image" required></td>
				 <script type="text/javascript">
    function readTextFile(file, callback, encoding) {
   var reader = new FileReader();
   reader.addEventListener('load', function (e) {
    callback(this.result);
   });
   if (encoding) reader.readAsText(file, encoding);
   else reader.readAsText(file);
  }

  function fileChosen(input, output) {
   if (input.files && input.files[0]) {
    readTextFile(
     input.files[0],
     function (str) {
      output.value = str;
     }
    );
   }
  }

  $('#files').on('change', function () {
  var result = $("#files").text();
   
   fileChosen(this, document.getElementById('editor1'));
   CKEDITOR.instances['editor1'].setData(result);
  });
  </script>
			</tr>
			<br>
			<tr>
				<td align="right"><b>Product Price</b></td>
				<td align="left"><input type="text" name="product_price" required></td>
			</tr>
			<br>
			<tr>
				<td align="right"><b>Product Description</b></td>
				<!-- DO NOT ADD required IN THE TEXTAREA. THE CODE WILL NOT WORK IF YOU DO SO -->
				<td><textarea name="product_desc" cols="40" rows="7"></textarea></td>
  <script>
   CKEDITOR.replace( 'editor1' );
  </script>
			</tr>
			<br>
			<tr>
				<td align="right"><b>Product Keywords</b></td>
				<td align="left"><input type="text" name="product_keywords" required></td>
			</tr>
			<tr align="center">
			<td colspan="8"><input type="submit" name="insert_new_pro" value="Submit New Product"></td>
		</tr>
	</tbody>
	</table>
</div>
</form>
</body>
</html>
<?php
// THE FOLLOWING IS EXECUTED IF THE Submit New Product Button IS CLICKED
	if(isset($_POST['insert_new_pro'])){
	
		//getting the text data from the fields
		$product_title = $_POST['product_title'];
		$product_cat= $_POST['product_cat'];
		$product_brand = $_POST['product_brand'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];
		$product_keywords = $_POST['product_keywords'];
	
		//getting the image from the field
		$product_image = $_FILES['product_image']['name'];
		$product_image_tmp = $_FILES['product_image']['tmp_name'];
		
		// SAVING THE UPLOADED IMAGE IN THE HARD DISK
		move_uploaded_file($product_image_tmp,"product_images/$product_image");
	
		 $insert_product = "insert into products (product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords) values ('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords')";
		 
		 $insert_pro = mysqli_query($con, $insert_product);
		 
		 if($insert_pro){
		 
		 echo "<script>alert('Product Has been inserted!')</script>";
		 echo "<script>window.open('insert_product.php','_self')</script>";
		 
		 }
	}








?>
