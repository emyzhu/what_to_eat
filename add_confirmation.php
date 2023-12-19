<?php

require("navigation.html");

if ( !isset($_POST['name']) || 
	empty($_POST['name'])) {

	$error = "Please fill out all required fields.";
}

else {

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

	$statement = $mysqli->prepare("INSERT INTO restaurants(name, image, price_id ) VALUES (?, ?, ?);");
	$statement->bind_param("ssi", $name, $image, $price_id);
	$executed = $statement->execute();

	$restaurant_id = $mysqli->insert_id;

	if( isset($_POST['cuisine_id']) && !empty($_POST['cuisine_id'])) {

		$statement2 = $mysqli->prepare("INSERT INTO restaurants_has_cuisines(restaurant_id, cuisine_id) VALUES (?, ?);");
		$statement2->bind_param("ii",  $restaurant_id, $cuisine_id);
		$executed2 = $statement2->execute();


		if(!$executed2) {

			echo $mysqli->error;
			exit();
		}
		
		$statement2->close();
	}

	if(!$executed) {

		echo $mysqli->error;
		exit();
	}

	echo "Added: " . $mysqli->affected_rows;

	if($statement->affected_rows == 1 ) {
		$isUpdated = true;

	}

	$statement->close();
	
	$mysqli->close();

}

?>

<!DOCTYPE html>
<html>
<head>

	<title></title>
</head>
<body>

	<div class="container"> 
		<h1 class="text-center">Add Confirmation</h1>
	</div>

	<div class="container">
		<?php if ( isset($error) && !empty($error) ) : ?>
			<div class="text-danger">
				<?php echo $error; ?>
			</div>
		<?php endif; ?>

		<?php if ($isUpdated) : ?>
			<div class="text-success">
				<span class="font-italic"><?php echo $_POST['name']; ?></span> was successfully added.
			</div>
		<?php endif; ?>
	</div>
</body>
</html>