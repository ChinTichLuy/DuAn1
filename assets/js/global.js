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

const formatPrice = (price) => {
  return `${price.toLocaleString("en")}đ`;
};

toastr.options = {
  progressBar: true,
  timeOut: 5000,
  closeButton: true,
  positionClass: "toast-top-center",
  newestOnTop: true,
  preventDuplicates: true,
};
