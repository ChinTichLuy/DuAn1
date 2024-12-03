const previewImage = (event) => {
    const img = document.querySelector("#projectlogo-img");
    img.src = URL.createObjectURL(event.target.files[0]);
    $("#projectlogo-img").addClass("h-screen");
};