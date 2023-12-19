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
WHERE 1=1;";


$results = $mysqli->query($sql);
if(!$results) {
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

</head>
<body>
	<div class="container-fluid heading">
		<h1>Added Places</h1>
<?php 
	echo "Showing " . $results->num_rows . " result(s).";
?>
	</div>

	<div class="col-12">
		<table class="table table-responsive mt-4">
			<thead>
				<tr>
					<th></th>
					<th>Image</th>
					<th>Price</th>
					<th>Cuisine</th>
				</tr>
			</thead>

			<tbody>
<?php while($row = $results->fetch_assoc()) : ?>
	<tr>
		<td><a href="details.php?id=<?php echo $row["id"]?>"><?php echo $row["name"];?></a>
		<td><img src="<?php echo $row["image"];?>" alt="" width="100" height="100"></img></td>
		<td><?php echo $row["dollar_signs"];?> </td>
		<td><?php echo $row["cuisine"];?> </td>
	</tr>
<?php endwhile;?>
			</tbody>

		</table>
	</div> <!-- .col -->
</body>
</html>