const handleDelete = (id) => {
  showAlertConfirm(() => {
    $(`#product-form-delete-${id}`).submit();
  });
};
