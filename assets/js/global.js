const showAlert = (icon = "success", text = null, title = null) => {
  Swal.fire({
    title: `${title}`,
    text: `${text}`,
    icon: `${icon}`,
  });
};

const showAlertConfirm = (callback) => {
  Swal.fire({
    title: "LuxChill Thông Báo",
    text: "Bạn có chắc muốn xóa không ?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Xác Nhận",
    cancelButtonText: "Hủy",
  }).then((result) => {
    if (result.isConfirmed) {
      callback();
    }
  });
};

// format price

const formatPrice = (price) => {
  return `${price.toLocaleString("en")}đ`;
};

// config toastr

toastr.options = {
  progressBar: true,
  timeOut: 5000,
  closeButton: true,
  positionClass: "toast-top-center",
  newestOnTop: true,
  preventDuplicates: true,
};

// search

// Lấy ra url hiện tại
const currentUrl = window.location.href;

if (currentUrl.includes("?q=") && !currentUrl.includes('/shop')) {
  const query = window.location.search;
  const newUrl = `http://localhost/b3_du_an1/shop${query}`;
  window.location.href = newUrl;
}
