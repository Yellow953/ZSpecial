$(document).ready(function () {
  // Add product btn
  $(".add-product-btn").on("click", function (e) {
    e.preventDefault();
    var name = $(this).data("name");
    var id = $(this).data("id");
    var price = parseFloat($(this).data("price")).toLocaleString(undefined, {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    });
    
    $(this).removeClass("btn-success").addClass("btn-default disabled");

    var html = `
      <tr>
        <td>${name}</td>
        <td>
          <input type="number" name="products[${id}][quantity]" data-price="${price}" class="form-control" min="1" value="1">
        </td>
        <td class="product-price">${price}</td>
        <td>
          <button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}">
            <span class="fa fa-trash"></span>
          </button>
        </td>
      </tr>`;

    $(".order-list").append(html);

    // Calculate total price
    calculateTotal();
  });

  // Remove product btn
  $("body").on("click", ".remove-product-btn", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $(this).closest("tr").remove();
    $("#product-" + id).removeClass("btn-default disabled").addClass("btn-success");
    calculateTotal();
  });

  // Update the total price based on quantity
  $("body").on("keyup change", ".form-control[name$='[quantity]']", function () {
    updateProductPrice($(this));
    calculateTotal();
  });
});

function updateProductPrice(input) {
  var unitPrice;
  
  unitPrice = parseFloat(input.closest("tr").find("[name$='[quantity]']").data('price')) || 0;

  var quantity = Number(input.closest("tr").find("[name$='[quantity]']").val()) || 0;
  
  var totalPrice = (quantity * unitPrice ).toLocaleString(undefined, {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
  });

  input.closest("tr").find(".product-price").html(totalPrice);
}

function calculateTotal() {
  var total = 0;

  $(".order-list .product-price").each(function () {
    var priceString = $(this).html().replace(/,/g, ""); // Remove commas
    var price = parseFloat(priceString);
    total += price;
  });

  // Update the total price input field without formatting
  $(".total-price").val(total.toFixed(2)); // Format to 2 decimal places

  // Check if total > 0
  if (total > 0) {
    $("#form-btn").removeClass("disabled");
  } else {
    $("#form-btn").addClass("disabled");
  }
}