function previewImage() {
    var preview = document.querySelector('#image-preview');
    var file = document.querySelector('#image-upload').files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "image/image-default.png";
    }
}

window.onload = previewHTMLFile;

function previewHTMLFile() {
    var file = document.querySelector('#html-upload').files[0];
    var reader = new FileReader();
    var preview = document.querySelector('#html-preview');

    reader.onloadend = function () {
        preview.srcdoc = reader.result;
    }

    if (file) {
        reader.readAsText(file);
    } else {
        preview.srcdoc = `
            <style>
                .container {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 85vh;
                    overflow: hidden;
                }
                img {
                    position: relative;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            </style>
            <div class="container">
                <img src='image/halaman-default.png' alt='Default Image'>
            </div>
        `;
    }
}

