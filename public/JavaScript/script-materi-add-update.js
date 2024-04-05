
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

function updateCount() {
    var inputLength = document.getElementById('judul').value.length;
    document.getElementById('judulHelp').innerHTML = inputLength + "/80";
}

document.getElementById('judul').addEventListener('input', function (e) {
    var input = e.target,
        text = input.value,
        small = document.getElementById('judulHelp');


    // Dapatkan lebar elemen input dalam pixel
    var inputWidth = input.offsetWidth;

    var smallWidth = small.offsetWidth + (0.04 * inputWidth);
    // console.log(inputWidth);
    // console.log(smallWidth);
    var maxWidth = inputWidth - smallWidth;
    var textWidth = getTextWidth(text, window.getComputedStyle(input).fontSize);
    // console.log(textWidth);
    // console.log(maxWidth);
    // console.log(smallWidth);
    // Jika panjang teks sama dengan atau lebih dari 80, sembunyikan small
    if (textWidth >= maxWidth) {
        small.style.display = 'none';
    } else {
        small.style.display = 'block';
    }
});

function getTextWidth(text, fontSize) {
    var canvas = document.createElement('canvas');
    var context = canvas.getContext('2d');
    context.font = fontSize + ' Arial';
    return context.measureText(text).width;
}






