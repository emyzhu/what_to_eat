<?php

require 'config.php';
require("navigation.html");

$isDeleted = false;

if ( !isset($_GET['id']) || empty($_GET['id']) 
		|| !isset($_GET['name']) || empty($_GET['name']) ) {
	$error = "Invalid restaurant.";
}

else {
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');


$sql = "DELETE FROM restaurants_has_cuisines
	WHERE restaurant_id = " . $_GET["id"] . ";";


	$results = $mysqli->query($sql);

	if(!$results){
		echo $mysqli->error;
		exit();
	}	

$sql2 = "DELETE FROM restaurants
	WHERE restaurants.id = " . $_GET["id"] . ";";


	$results2 = $mysqli->query($sql2);

	if(!$results2){
		echo $mysqli->error;
		exit();
	}

	if($mysqli->affected_rows == 1) {
		$isDeleted = true;
	}

	$mysqli->close();
}


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

</head>
<body>

	<div class="container-fluid heading">
		<h1>Delete</h1>
	</div>
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>
				<?php endif; ?>

				<?php if ( $isDeleted ) :?>
					<div class="text-success"><span class="font-italic"><?php echo $_GET['name'];?></span> was successfully deleted.</div>
				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="results.php" role="button" class="btn btn-primary">Back to Results</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> 
</body>
</html>