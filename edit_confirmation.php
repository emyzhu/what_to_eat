<?php
require("navigation.html");

if ( !isset($_POST['name']) || 
	empty($_POST['name'])) {

	$error = "Please fill out all required fields.";
}

else {

	$isUpdated = false;

	require 'config.php';

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');

	$name = $_POST['name'];

	if( isset($_POST['image']) && !empty($_POST['image'])) {
		$image = $_POST['image'];
	}
	else {
		$image = NULL;
	}
	if( isset($_POST['price_id']) && !empty($_POST['price_id'])) {
		$price_id = $_POST['price_id'];
	}
	else {
		$price_id = NULL;
	}
	if( isset($_POST['cuisine_id']) && !empty($_POST['cuisine_id'])) {
		$cuisine_id = $_POST['cuisine_id'];
	}
	else {
		$cuisine_id = NULL;
	}

	$statement = $mysqli->prepare("UPDATE restaurants SET name = ?, image = ?, price_id = ? WHERE id = ?;");
	$statement->bind_param("ssii", $name, $image, $price_id, $_POST['id']);
	$executed = $statement->execute();

	if(!$executed) {
		echo $mysqli->error;
		exit();
	}

	if( isset($_POST['cuisine_id']) && !empty($_POST['cuisine_id'])) {
		$statement2 = $mysqli->prepare("UPDATE restaurants_has_cuisines SET cuisine_id = ? WHERE restaurant_id = ?;");
		$statement2->bind_param("ii", $cuisine_id, $_POST['id']);
		$executed2 = $statement2->execute();

		if(!$executed2) {
			echo $mysqli->error;
			exit();
		}

		$statement2->close();
	}


	if($mysqli->affected_rows == 1 || $mysqli->affected_rows == -1) {
		$isUpdated = true;
	}


	$statement->close();
	
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

	<title></title>
</head>
<body>
	
	<div class="container"> 
		<h1 class="text-center">Edit Confirmation</h1>
	</div>

	<div class="container">
		<?php if ( isset($error) && !empty($error) ) : ?>
			<div class="text-danger">
				<?php echo $error; ?>
			</div>
		<?php endif; ?>

		<?php if ($isUpdated) : ?>
			<div class="text-success">
				<span class="font-italic"><?php echo $_POST['name']; ?></span> was successfully edited.
			</div>
		<?php endif; ?>

		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="details.php?id=<?php echo $_POST['id']; ?>" role="button" class="btn btn-primary">Back to Details</a>
			</div> <!-- .col -->
		</div> 

	</div>



	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>