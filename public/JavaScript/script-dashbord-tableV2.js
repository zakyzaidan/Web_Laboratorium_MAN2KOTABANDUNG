$(document).ready(function() {

    $('#myTable').DataTable({
        pageLength: 10, // Menampilkan 50 entri per halaman secara default
        lengthMenu: false // Menyembunyikan menu entri per halaman
    });
});


function previewImage() {
    var preview = document.querySelector("#image-preview");
    var file = document.querySelector("#image-upload").files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "{{ asset('image/image-default.png') }}";
    }
}
