console.log('JS create (assets/js/products/create.js)');
const previewImage = (event) => {
    const img = document.querySelector("#projectlogo-img")
    // const img = $("#projectlogo-img");
    img.src = URL.createObjectURL(event.target.files[0]);
    $("#projectlogo-img").addClass('h-screen');
};

// khoi tao ham chon nhieu (color and tag)
const initSelect2 = () => {
    $('#select-color-product-multiple').select2(
        {
        allowClear: true
        }
    );
    $('#select-tag-product-multiple').select2(
        {
        allowClear: true
        }
    );

};

const renderTbodyVariants = (colors)=>{
    let rows = '';
    colors.map((color)=>{
        // console.log(colors);

        rows += 
        `
        <tr class="text-center">
        <td>${color.text}</td>
        <td> <input type="tel" name="product_variants[${color.id}][quantity]"/></td>
        <td> <input type="tel" name="product_variants[${color.id}][prrice_regular]"/></td>
        <td> <input type="tel" name="product_variants[${color.id}][price_sale]"/></td>
        </tr>
        `;
    });
    return rows;
}

const addImageGallery = ()=>{
    const id = `image-gallery-${Math.random().toString(36).substring(2,15).toLocaleLowerCase()}`;
    let html = `
    <div class="col-md-4" id="${id}_item">
        <label for="gallery_default" class="form-label">Image</label>
            <div class="d-flex">
                <input type="file" class="form-control" name="product_galleries[]" id="${id}">
                <button type="button" class="btn btn-danger" onclick="removeImages('${id}_item')">Delete</button>                           
            </div>
    </div>`;

    $("#gallery_list").append(html);

}


const removeImages = (id)=>{
    // $(`#${id}`).remove();
    showAlertConfirm(()=>{
    $(`#${id}`).remove();

    });
}

$(document).ready(function () {
    // goi ham chon nhieu
    initSelect2(); 
    // $('#select-tag-product-multiple').initSelect2();
    $('#table-product-variant-preview').hide();
    $('#select-color-product-multiple').on("change",() =>{
        const selectColors = $('#select-color-product-multiple').select2('data');

        if(selectColors.length > 0) {
            $('#table-product-variant-preview').show();
            const renderTbody = renderTbodyVariants(selectColors);
            $('#render-tbody-product').html(renderTbody);
        }
        else {
            $('#table-product-variant-preview').hide();
            $('#render-tbody-product').empty();
        }

    });

    $('#btn-submit-form-create').click(()=>{

        // submit form
        $('#form-create-product').submit();
    })



});

