// Người dùng có tài khoản => Lưu thằng bảng cart
// Người dùng khách        => Lưu vào session

let selectColor = null;

$(document).ready(function () {
  $(".filter-color").click(function () {
    selectColor = $(this).attr("data-color-id");
  });

  $("#btn-add-cart").click(function () {
    const productId = $(this).attr("data-product-id");
    let productQty = $("#product-quantity").val();

    fetchVariantId(productId, selectColor).done(function (res) {
      //   console.log(res.product_variant_id.id);
      handleAddToCart(productId, res.product_variant_id.id, productQty);
    });
  });
});

const handleAddToCart = (productId, variantId, quantity) => {
  $.ajax({
    type: "POST",
    url: `${BASE_URL}ajax/handleAddToCart`,
    data: {
      product_id: productId,
      product_variant_id: variantId,
      quantity: quantity,
    },
    success: function (res) {
      if (!res.status) {
        toastr.error(res.message);
        console.log(res);
      } else {
        toastr.success("Thêm vào giỏ hàng thành công");
        console.log(res);
      }
    },
    error: function (err) {
      console.error(err);
    },
  });
};

const fetchVariantId = (productId, colorId) => {
  return $.get(
    `${BASE_URL}ajax/${productId}/${colorId}/findProductVariantByColorId`
  );
};
