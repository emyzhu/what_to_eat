<?php

require 'config.php';
require("navigation.html");

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');

$sql = 
"SELECT * FROM restaurants
WHERE restaurants.id = " . $_GET["id"] . ";" ;


$results = $mysqli->query($sql);
if(!$results) {
	echo $mysqli->error;
	exit();
}
$restaurant = $results->fetch_assoc();

$sql2 = 
"SELECT * FROM restaurants_has_cuisines
WHERE restaurants_has_cuisines.restaurant_id = " . $_GET["id"] . ";" ;


$results2 = $mysqli->query($sql2);
if(!$results2) {
	echo $mysqli->error;
	exit();
}
$restaurant2 = $results2->fetch_assoc();


$sql_price = "SELECT * FROM prices;";
$results_price = $mysqli->query($sql_price);

if($results_price == false) {
	echo $mysqli->error;
	exit();
}

$sql_cuisine = "SELECT * FROM cuisines;";
$results_cuisine = $mysqli->query($sql_cuisine);

if($results_cuisine == false) {
	echo $mysqli->error;
	exit();
}

$mysqli->close();

?>


<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<title></title>
	<link rel="stylesheet" href="style.css">

	<title></title>
</head>
<body>
	<div class="container"> 
		<h1 class="text-center">Edit Rec</h1>
	</div>
<div class="container">
		<form id="edit-form" class="needs-validation" action="edit_confirmation.php" method="POST">
			<div class="form-row">
			    <div class="col-md-6 mb-3">
				    <label for="name">Name<span class="text-danger">*</span></label>
				    <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="<?php echo $restaurant['name'] ?>"required>
				    <div class="invalid-feedback">
				    	Please provide a valid name.
			    	</div>
		    	</div>
			    <div class="col-md-6 mb-3">
			    	<label for="image">Image</label>
			    	<input type="text" class="form-control" id="image" placeholder="Image Path" name="image" value="<?php echo $restaurant['image'] ?>">
				</div>
			</div>
		    <div class="form-row justify-content-center">
		    	<div class="form-group col-md-4">
			    	<label for="price-id">Price</label>
						<select name="price_id" id="price-id" class="form-control">
							<option value="" selected disabled>-- Select One --</option>
							<?php while( $row = $results_price->fetch_assoc() ): ?>

								<?php if( $row["id"] == $restaurant['price_id'] ): ?>
									
									<option selected value="<?php echo $row['id']; ?>">
										<?php echo $row['dollar_signs']; ?>
									</option>

								<?php else: ?>

									<option value="<?php echo $row['id']; ?>">
										<?php echo $row['dollar_signs']; ?>
									</option>

								<?php endif;?>

						<?php endwhile; ?>
					</select>
		    	</div>
		    	<div class="form-group col-md-4">
					<label for="cuisine-id">Cuisine</label>
						<select name="cuisine_id" id="cuisine-id" class="form-control">
							<option value="" selected disabled>-- Select One --</option>
							<?php while( $row = $results_cuisine->fetch_assoc() ): ?>

								<?php if( $row["id"] == $restaurant2['cuisine_id'] ): ?>
									
									<option selected value="<?php echo $row['id']; ?>">
										<?php echo $row['cuisine']; ?>
									</option>

								<?php else: ?>

									<option value="<?php echo $row['id']; ?>">
										<?php echo $row['cuisine']; ?>
									</option>

								<?php endif;?>

						<?php endwhile; ?>
					</select>
				</div> 
			</div>

			<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">

			<div class="form-row justify-content-center">
				<button class="btn btn-primary " type="submit">Submit</button>
			</div>
		</form>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>