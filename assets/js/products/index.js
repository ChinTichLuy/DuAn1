console.log('from-> assets/js/products/index.js');

const handleDelete = (id)=>{
    showAlertConfirm(()=>{
        $(`#product-form-delete-${id}`).submit();
    })

}