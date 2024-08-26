$(document).ready(function() {
  // Get the dropdown value
  var category = $('#category').val();

  // Get the current page number
  var page = 1;

  // Send AJAX request to get products
  $.ajax({
    type: 'POST',
    url: 'Product display.php',
    data: {category: category, page: page},
    success: function(data) {
      // Display products
      $('#products').html(data);
    }
  });

  // Update products when dropdown value changes
  $('#category').on('change', function() {
    var category = $(this).val();
    page = 1;
    $.ajax({
      type: 'POST',
      url: 'Product display.php',
      data: {category: category, page: page},
      success: function(data) {
        // Display products
        $('#products').html(data);
      }
    });
  });

  // Add to cart functionality
  $(document).on('click', '.add-to-cart', function() {
    var productId = $(this).data('product-id');
    $.ajax({
      type: 'POST',
      url: 'add-to-cart.php',
      data: {product_id: productId},
      success: function(data) {
        // Update cart count
        $('#cart-count').html(data);
      }
    });
  });

  // Pagination functionality
  $(document).on('click', '.page-link', function() {
    var page = $(this).data('page');
    $.ajax({
      type: 'POST',
      url: 'Product display.php',
      data: {category: category, page: page},
      success: function(data) {
        // Display products
        $('#products').html(data);
      }
    });
  });
});