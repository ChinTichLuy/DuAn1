// const handleDelete = (id) => {
//   showAlertConfirm(() => {
//     document.querySelector(`#form-delete-${id}`).submit();
//   });
// };

const handleDelete = (id) => {
  showAlertConfirm(() => {
    $(`#user-form-delete-${id}`).submit();
  });
};
