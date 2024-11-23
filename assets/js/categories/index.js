const handleDelete = (id) => {
    showAlertConfirm(() => {
        $(`#category-form-delete-${id}`).submit();
    })
}
