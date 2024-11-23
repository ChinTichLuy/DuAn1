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
    cancelButtonText: "Hủy"
  }).then((result) => {
    if (result.isConfirmed) {
      callback();
    }
  });
};
