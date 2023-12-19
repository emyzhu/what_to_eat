<?php
    require("yelp-creds.php");
    require("navigation.html");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="style.css">

    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
      integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
      crossorigin="anonymous"
    ></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
      integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
      crossorigin="anonymous"
    />
    <script type="text/javascript" src="yelp.js"></script>

    <title></title>
  </head>
  <body>



	<div class="container"> 
		<h1 class="text-center">Begin Adding Here!</h1>
    <p class="text-center">Search for a Restaurant to Add to Your List</p>
	</div>

      <!-- Search Form -->
      <form id="search-form" class="form-inline container my-3">
        <div class="form-group mx-2">Looking for</div>
        <div class="form-group mx-2">
          <label for="search-term" class="sr-only">Term</label>
          <input
            id="search-term"
            type="text"
            class="form-control"
            placeholder="Korean Food"
          />
        </div>
        <div class="form-group mx-2">in</div>
        <div class="form-group mx-2">
          <label for="search-location" class="sr-only">Location</label>
          <input
            id="search-location"
            type="text"
            class="form-control"
            placeholder="Los Angeles"
          />
        </div>
        <button type="submit" class="btn btn-info mx-2">Search</button>
      </form>

      <!-- Yelp Grid -->
      <div id="yelp-grid" class="container card-columns my-2"></div>

   <!--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
 -->
  </body>
</html>