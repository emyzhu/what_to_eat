<?php

require 'config.php';
require("navigation.html");


$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');

$sql_price = "SELECT * FROM prices;";
$price = $mysqli->query($sql_price);

if($price == false) {
	echo $mysqli->error;
	exit();
}

$sql_cuisine = "SELECT * FROM cuisines;";
$cuisine = $mysqli->query($sql_cuisine);

if($cuisine == false) {
	echo $mysqli->error;
	exit();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container"> 
		<h1 class="text-center">Add a Rec</h1>
	</div>

	<div class="container">
		<form id="add-form" class="needs-validation" action="add_confirmation.php" method="POST">
			<div class="form-row">
			    <div class="col-md-6 mb-3">
				    <label for="name">Name<span class="text-danger">*</span></label>
				    <input type="text" class="form-control" id="name" placeholder="Name" name="name"required>
				    <div class="invalid-feedback">
				    	Please provide a valid name.
			    	</div>
		    	</div>
			    <div class="col-md-6 mb-3">
			    	<label for="image">Image</label>
			    	<input type="text" class="form-control" id="image" placeholder="Image Path" name="image">
				</div>
			</div>
		    <div class="form-row justify-content-center">
		    	<div class="form-group col-md-4">
			    	<label for="price-id">Price</label>
			    	<select name="price_id" id="price-id" class="form-control">
				        <option selected disabled>Choose...</option>
				        <?php while( $row = $price->fetch_assoc() ) : ?>
							<option value="<?php echo $row["id"]; ?>">
								<?php echo $row["dollar_signs"]; ?>
							</option>
						<?php endwhile; ?>
			    	</select>
		    	</div>
		    	<div class="form-group col-md-4">
			    	<label for="cuisine-id">Cuisine</label>
			    	<select name="cuisine_id" id="cuisine-id" class="form-control">
				        <option selected disabled>Choose...</option>
				        <?php while( $row = $cuisine->fetch_assoc() ) : ?>
							<option value="<?php echo $row["id"]; ?>">
								<?php echo $row["cuisine"]; ?>
							</option>
						<?php endwhile; ?>
			    	</select>
		    	</div>
			</div>
			<div class="form-row justify-content-center">
				<button class="btn btn-primary " type="submit">Submit</button>
			</div>
		</form>
	</div>

</body>

<script type="text/javascript">



</script>
</html>