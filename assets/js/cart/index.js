$(document).ready(function () {
  $(".btn-add-qty").click(function () {
    const id = $(this).data("id");

    let quantity = parseInt($(`.data-qty-${id}`).val());
    quantity++;

    let subTotal = +$(`.sub-price-${id}`).data("price");

    $(`.data-qty-${id}`).val(quantity);

    const cartId = +$(`.data-qty-${id}`).attr("data-cart-id");

    handleUpdateCart(id, quantity, subTotal, cartId);
  });

  $(".btn-remove-qty").click(function () {
    const id = $(this).data("id");

    let quantity = parseInt($(`.data-qty-${id}`).val());

    if (quantity <= 1) {
      toastr.warning("Không thể trừ nữa");
      return;
    }

    quantity--;

    let subTotal = +$(`.sub-price-${id}`).data("price");

    const cartId = +$(`.data-qty-${id}`).attr("data-cart-id");

    $(`.data-qty-${id}`).val(quantity);

    handleUpdateCart(id, quantity, subTotal, cartId);
  });
});

const handleUpdateCart = (id, quantity, subTotal, cartId) => {
  $.ajax({
    url: `${BASE_URL}/ajax/handleUpdateCart`,
    method: "POST",
    data: {
      cartItemId: id,
      quantity: quantity,
      subTotal: subTotal,
      cartId: cartId,
    },
    success: (res) => {
      if (res.userId) {
        toastr.success("Thao tác thành công");
        $(`.sub-price-${id}`).html(formatPrice(res.subTotal));
        $("#total-price").html(formatPrice(res.priceTotal));
        console.log(res);
      } else {
        toastr.success("Thao tác thành công");
        $(`.sub-price-${id}`).html(formatPrice(res.subTotal));
        $("#total-price").html(formatPrice(res.priceTotal));
        console.log(res);
      }
    },
    error: (err) => {
      console.error(err);
    },
  });
};
