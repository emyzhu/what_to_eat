<?php

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
	if( isset($_POST['price']) && !empty($_POST['price'])) {
		$price = $_POST['price'];

		if ($price == '$') {
			$price_id = 1;
		}
		if ($price == '$$') {
			$price_id = 2;
		}
		if ($price == '$$$') {
			$price_id = 3;
		}
	}
	else {
		$price_id = NULL;
	}

	if( isset($_POST['categories']) && !empty($_POST['categories'])) {

		$categories = $_POST['categories'];
		$cuisine = $categories[0];
	}
	else {
		$cuisine_id = NULL;
	}


	$statement = $mysqli->prepare("INSERT INTO restaurants(name, image, price_id ) VALUES (?, ?, ?);");

	echo $mysqli->error;

	$statement->bind_param("ssi", $name, $image, $price_id);
	echo $statement->error;
	$executed = $statement->execute();
	echo $mysqli->error;

	if(!$executed) {
		echo $mysqli->error;
		exit();
	}

	$restaurant_id = $mysqli->insert_id;

	if( isset($categories) && !empty($categories)) {

			//look for record of cuisine to see if already in database
			$sql = "SELECT * FROM cuisines WHERE cuisine LIKE '%" . $cuisine . "%';";
			$results = $mysqli->query($sql);

			//if cuisine doesn't already exist, add it and get associated cuisine_id
			if ($results->num_rows == 0) {
				$stmt = $mysqli->prepare("INSERT INTO cuisines(cuisine) VALUES (?);");
				$stmt->bind_param("s",  $cuisine);
				$exe = $stmt->execute();

				if(!$exe) {

				echo $mysqli->error;
				exit();
				}

				$cuisine_id = $mysqli->insert_id;

				$stmt->close();
			}

			//if cuisine already exists, get its associaated cuisine_id
			else {
				$cuisine_id = $results->fetch_assoc()['id'];
				echo "<hr>";
				echo $cuisine_id; 
				echo "</hr>";
				
			}

			$statement2 = $mysqli->prepare("INSERT INTO restaurants_has_cuisines(restaurant_id, cuisine_id) VALUES (?, ?);");
			echo $mysqli->error;
			$statement2->bind_param("ii",  $restaurant_id, $cuisine_id);
			echo $statement2->error;
			$executed2 = $statement2->execute();

			if(!$executed2) {

				echo $mysqli->error;
				exit();
			}
			
			$statement2->close();

	}

	echo "Added: " . $mysqli->affected_rows;

	if($statement->affected_rows == 1 ) {
		$isUpdated = true;
	}

	$statement->close();
	
	$mysqli->close();

}

?>





