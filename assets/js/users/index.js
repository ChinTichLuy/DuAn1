const handleDelete = (id) => {
  showAlertConfirm(() => {
    $(`#user-form-delete-${id}`).submit();
  });
};
