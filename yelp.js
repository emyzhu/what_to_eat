
$(document).ready(function () {
  // Executes once the page has completely loaded

  // Note: By convention, document elements selected with jQuery have variables that start with $

  // Form Related
  const $searchForm = $("#search-form");
  const $searchTerm = $("#search-term");
  const $searchLocation = $("#search-location");

  // Yelp Grid (results load here)
  const $yelpGrid = $("#yelp-grid");

  // Load From Yelp Function
  function loadFromYelp(searchTerm, searchLocation) {
    $.ajax({
      method: "GET",
      url: "yelp-backend.php",
      data: { searchTerm: searchTerm, searchLocation: searchLocation },
    }).done(function (response) {
      // Clears $yelpGrid
      $yelpGrid.html("");

      for (let business of response) {


// <form method="post" action="add_yelp.php">
//                 <input type="hidden" name="name" value="${business.name}">
//                 <input type="hidden" name="price" value="${business.price}">
//                 <input type="submit" class="btn btn-info" value="Add">
//               </form>

        const businessHTML = `
          <div class="card">
            <a href="${business.image_url}" data-lightbox="${business.name}">
            <img
              src="${business.image_url}"
              class="card-img-top"
              alt="${business.name}"
            /></a>
            <div class="card-body">
              <h5 class="card-title">${business.name}</h5>
              <p class="card-text">${business.categories}</p>
              <p  class="card-text"> ${business.price} </p>
              <a
                href="${business.url}"
                class="btn btn-danger"
                target="_blank"
                >
                <i class="fab fa-yelp"></i> Yelp
                </a
              >
              <button class="btn add-button ${business.alreadyAdded ? "btn-warning disabled" : "btn-info" }" data-name="${business.name}"  data-price="${business.price}" data-image_url= "${business.image_url}" data-categories="${business.categories}">${business.alreadyAdded ? "Already Added" : "Add" }</button>
            </div>
          </div>`;

        // Append business to $yelpGrid
        $yelpGrid.append(businessHTML);
      }
    });
  }

  $yelpGrid.on( "click", ".add-button", function() {

    $(this).addClass('disabled')
    $(this).text('ADDED!!!')

    const name = $(this).data("name")
    const price = $(this).data("price")
    const image = $(this).data("image_url")
    const categories = $(this).data("categories").split(', ')

  $.ajax({
      method: "POST",
      url: "add_yelp.php",
      data: { name: name, price: price, image: image, categories: categories},
    }).done(function (response) {
      console.log(response)
    });

});

  // Form Handler
  $searchForm.on("submit", function (e) {
    e.preventDefault();

    // Get input values
    const searchTerm = $searchTerm.val();
    const searchLocation = $searchLocation.val();

    // console.log(searchTerm);
    // console.log(searchLocation);

    loadFromYelp(searchTerm, searchLocation);
  });

  // On page load
  loadFromYelp("Korean Food", "Los Angeles");
});