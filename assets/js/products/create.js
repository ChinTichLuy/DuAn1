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
        }
           
        

    });



});

