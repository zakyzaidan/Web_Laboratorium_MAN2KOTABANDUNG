
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
    console.log(file);
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

// Menyimpan data form ke localStorage setiap kali pengguna mengubah nilai input atau textarea
document.querySelectorAll('input, textarea:not(#edit1, #edit2, #edit3)').forEach(function(element) {
    console.log("data1");
    element.addEventListener('input', function() {
        localStorage.setItem(element.name, element.value);
    });
});

// Khusus untuk Summernote
['edit1', 'edit2', 'edit3'].forEach(function(id) {
    $('#' + id).on('summernote.change', function() {
        localStorage.setItem(id, $(this).summernote('code'));
    });
});

// Memuat kembali data form dari localStorage saat halaman dimuat
window.addEventListener('load', function() {
    console.log("data3");
    document.querySelectorAll('input, textarea:not(#edit1, #edit2, #edit3)').forEach(function(element) {
        if (element.type !== 'file' && localStorage.getItem(element.name)) {
            element.value = localStorage.getItem(element.name);
        }
    });

    // Khusus untuk Summernote
    ['edit1', 'edit2', 'edit3'].forEach(function(id) {
        if (localStorage.getItem(id)) {
            $('#' + id).summernote('code', localStorage.getItem(id));
        }
    });
});


// Event listener untuk tombol "Batalkan"
document.querySelector('button[type="batal"]').addEventListener('click', function() {
    resetForm();
});


function resetForm() {
    // Hapus data form dari localStorage dan reset nilai input dan textarea
    document.querySelectorAll('input, textarea:not(#edit1, #edit2, #edit3)').forEach(function(element) {
        localStorage.removeItem(element.name);
        element.value = ''; // Reset nilai input dan textarea
    });

    // Khusus untuk Summernote
    ['edit1', 'edit2', 'edit3'].forEach(function(id) {
        localStorage.removeItem(id);
        $('#' + id).summernote('code', ''); // Reset nilai Summernote
    });
}



function clearForm() {
    console.log('push data');
    document.getElementById('form').action = '/materi-kelas-page';
    document.getElementById('form').method = 'POST';
    document.querySelector('input[name="_method"]').value = 'POST';
    var btn = document.querySelector("button[value='Submit']");
    btn.innerHTML = "Tambahan";
}

// JavaScript
function editData(id) {
    console.log('/materi-kelas-page/update/' + id);
    // Ubah action dan method form
    document.getElementById('form').action = '/materi-kelas-page/update/' + id;
    document.getElementById('form').method = 'POST'; // Ubah ini menjadi POST
    document.querySelector('input[name="_method"]').value = 'PUT';

    var btn = document.querySelector("button[value='Submit']");
    btn.innerHTML = "Update";




    // Ambil data dari server
    fetch('/mengambil-data/' + id)
    .then(response => response.json())
    .then(data => {
        // Tampilkan data di form
        console.log(data.modul_pembelajaran_materi);
        document.getElementById('image-preview').src =  data.thubnail_materi;
        previewHTMLFileFromServer(data.modul_pembelajaran_materi);
        document.getElementById('judul').value = data.judul_materi;
        $('#edit1').summernote('code', data.isi_materi);
        $('#edit2').summernote('code', data.tujuan_dan_alat_materi);
        $('#edit3').summernote('code', data.tambahan_materi);
    });
}


function previewHTMLFileFromServer(url) {
    fetch(url)
        .then(response => response.text())
        .then(data => {
            var preview = document.querySelector('#html-preview');
            preview.srcdoc = data;
        });
}



$(document).on('show.bs.modal', '.modal', function() {
    const zIndex = 1040 + 10 * $('.modal:visible').length;
    $(this).css('z-index', zIndex);
    setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'));
});

$(document).on('hidden.bs.modal', '.modal', () => $('.modal:visible').length && $(document.body).addClass('modal-open'));


