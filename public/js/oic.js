function preview_image(event) {
    var reader = new FileReader();
        reader.onload = function() {
        var output = document.getElementById('preview-image-before-upload');
        document.getElementById('parent-preview-image').classList.remove('visually-hidden');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
