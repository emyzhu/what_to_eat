<?php

require 'config.php';
require("navigation.html");

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');

$sql = "SELECT * FROM restaurants;";

$results = $mysqli->query($sql);

if(!$results) {
	echo $mysqli->error;
	exit();
}

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
		<h1 class="text-center">Get A Rec!</h1>
	</div>

	<div class="container">
		<form class="needs-validation" action="search_results.php" method="GET">
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



	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>