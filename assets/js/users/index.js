const handleDelete = (id) => {
  showAlertConfirm(() => {
    document.querySelector(`#form-delete-${id}`).submit();
  });
};
