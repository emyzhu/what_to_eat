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
"SELECT restaurants.id, restaurants.name, restaurants.image, prices.dollar_signs, cuisines.cuisine
FROM restaurants
LEFT JOIN prices
	ON restaurants.price_id = prices.id
LEFT JOIN restaurants_has_cuisines
	ON restaurants.id = restaurants_has_cuisines.restaurant_id
LEFT JOIN cuisines
	ON restaurants_has_cuisines.cuisine_id = cuisines.id

WHERE restaurants.id  = " . $_GET["id"] . ";" ;


$results = $mysqli->query($sql);
if(!$results) {
	echo $mysqli->error;
	exit();
}

$row = $results->fetch_assoc();

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

</head>
<body>

	<div class="container-fluid heading">
		<h1>Details</h1>

	</div>

	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
				<?php if(isset($error) && !empty($error)): ?>
					<div class="text-danger">
						<?php echo $error;?>
					</div>

					<?php else: ?>

									<table class="table table-responsive">
										<tr>
											<th class="text-right">Name:</th>
											<td><?php echo $row["name"]?></td>
										</tr>

										<tr>
											<th class="text-right">Image:</th>
											<td><img src="<?php echo $row["image"]?>" width="100" height="100" alt="<?php echo $row["name"]?>" /></td>
										</tr>

										<tr>
											<th class="text-right">Price:</th>
											<td><?php echo $row["dollar_signs"]?></td>
										</tr>

										<tr>
											<th class="text-right">Cuisine:</th>
											<td><?php echo $row["cuisine"]?></td>
										</tr>
									</table>
					<?php endif;?>

			</div> 
		</div>
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="results.php" role="button" class="btn btn-primary">Back to Search Results</a>

				<a href="edit_form.php?id=<?php echo $_GET['id']; ?>" class="btn btn-warning">Edit Restaurant Details </a>
				<a id="btn-delete" href="delete.php?id=<?php echo $row['id']; ?>&name=<?php echo $row['name']?>" class="btn btn-outline-danger delete-btn">Delete</a>
			</div> 
		</div>

	<script type="text/javascript">


		document.querySelector("#btn-delete").onclick = function() {
			return confirm('Are you sure you want to delete this restaurant?');
		}



	</script>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>