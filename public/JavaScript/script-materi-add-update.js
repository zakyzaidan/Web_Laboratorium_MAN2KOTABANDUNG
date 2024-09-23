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
        preview.src = "image/image-default.png";
    }
}

window.onload = previewHTMLFile;

function previewHTMLFile() {
    var file = document.querySelector("#html-upload").files[0];
    var reader = new FileReader();
    var preview = document.querySelector("#html-preview");
    reader.onloadend = function () {
        preview.srcdoc = reader.result;
    };

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
    var inputLength = document.getElementById("judul").value.length;
    document.getElementById("judulHelp").innerHTML = inputLength + "/80";
}

document.getElementById("judul").addEventListener("input", function (e) {
    var input = e.target,
        text = input.value,
        small = document.getElementById("judulHelp");
    var inputWidth = input.offsetWidth;
    var smallWidth = small.offsetWidth + 0.04 * inputWidth;
    var maxWidth = inputWidth - smallWidth;
    var textWidth = getTextWidth(text, window.getComputedStyle(input).fontSize);
    if (textWidth >= maxWidth) {
        small.style.display = "none";
    } else {
        small.style.display = "block";
    }
});

function getTextWidth(text, fontSize) {
    var canvas = document.createElement("canvas");
    var context = canvas.getContext("2d");
    context.font = fontSize + " Arial";
    return context.measureText(text).width;
}

// Menyimpan data form ke localStorage setiap kali pengguna mengubah nilai input atau textarea
document
    .querySelectorAll("input, textarea:not(#isi-materi, #tujuan-dan-alat, #tambahan)")
    .forEach(function (element) {
        element.addEventListener("input", function () {
            localStorage.setItem(element.name, element.value);
        });
    });

// Khusus untuk Summernote
["isi-materi", "tujuan-dan-alat", "tambahan"].forEach(function (id) {
    $("#" + id).on("summernote.change", function () {
        localStorage.setItem(id, $(this).summernote("code"));
    });
});

// Memuat kembali data form dari localStorage saat halaman dimuat
// window.addEventListener("load", function () {
//     document
//         .querySelectorAll("input, textarea:not(#isi-materi, #tujuan-dan-alat, #tambahan)")
//         .forEach(function (element) {
//             if (element.type !== "file" && localStorage.getItem(element.name)) {
//                 element.value = localStorage.getItem(element.name);
//             }
//         });

//     // Khusus untuk Summernote
//     ["isi-materi", "tujuan-dan-alat", "tambahan"].forEach(function (id) {
//         if (localStorage.getItem(id)) {
//             $("#" + id).summernote("code", localStorage.getItem(id));
//         }
//     });
// });

// Event listener untuk tombol "Batalkan"
document
    .querySelector('button[type="batal"]')
    .addEventListener("click", function () {
        resetForm();
    });

function resetForm() {
    // Hapus data form dari localStorage dan reset nilai input dan textarea
    document
        .querySelectorAll("input, textarea:not(#isi-materi, #tujuan-dan-alat, #tambahan)")
        .forEach(function (element) {
            if (element.type !== "file" && localStorage.getItem(element.name)) {
                element.value = ""; // Reset nilai input dan textarea
            }
        });

    // Khusus untuk Summernote
    ["isi-materi", "tujuan-dan-alat", "tambahan"].forEach(function (id) {
        if (localStorage.getItem(id)) {
            $("#" + id).summernote("code", ""); // Reset nilai Summernote
        }
    });
}

function clearForm() {
    console.log("push data");
    document.getElementById("form").action = "/materi-kelas-page/add";
    document.getElementById("form").method = "POST";
    document.querySelector('input[name="_method"]').value = "POST";
    var btn = document.querySelector("button[value='Submit']");
    btn.innerHTML = "Tambahan";
}

// JavaScript
function editData(id) {
    console.log("/materi-kelas-page/update/" + id);
    // Ubah action dan method form
    document.getElementById("form").action = "/materi-kelas-page/update/" + id;
    document.getElementById("form").method = "POST"; // Ubah ini menjadi POST
    document.querySelector('input[name="_method"]').value = "PUT";

    var btn = document.querySelector("button[value='Submit']");
    btn.innerHTML = "Update";

    // Ambil data dari server
    fetch("/mengambil-data/" + id)
        .then((response) => response.json())
        .then((data) => {
            // Tampilkan data di form
            console.log(data.modul_pembelajaran_materi);
            console.log(data.file_materi);
            document.getElementById("image-preview").src = data.thubnail_materi;
            document.getElementById("image-upload").required = false;
            document.getElementById("file-materi").required = false;
            previewHTMLFileFromServer(data.modul_pembelajaran_materi);
            document.getElementById("judul").value = data.judul_materi;
            $("#isi-materi").summernote("code", data.isi_materi);
            $("#tujuan-dan-alat").summernote("code", data.tujuan_dan_alat_materi);
            $("#tambahan").summernote("code", data.tambahan_materi);
            // Reset all checkboxes
            document.querySelectorAll('.alat-checkbox').forEach((checkbox) => {
                checkbox.checked = false;
            });

            // Centang checkbox alat yang dipilih
            data.alat.forEach((alatId) => {
                // const checkbox = document.querySelector(`.alat-checkbox[data-id="${alatId}"]`);
                // console.log(document.querySelector(`.alat-checkbox`));
                console.log("check-"+alatId.toString());
                document.getElementById("check-"+alatId.toString()).checked = true;
                // if (checkbox) {
                //     checkbox.checked = true;
                // }
            });

            // Reset all checkboxes
            document.querySelectorAll('.bahan-checkbox').forEach((checkbox) => {
                checkbox.checked = false;
            });

            // Centang checkbox alat yang dipilih
            data.alat.forEach((bahanId) => {
                // const checkbox = document.querySelector(`.alat-checkbox[data-id="${alatId}"]`);
                // console.log(document.querySelector(`.alat-checkbox`));
                console.log("check-"+bahanId.toString());
                document.getElementById("check-"+bahanId.toString()).checked = true;
                // if (checkbox) {
                //     checkbox.checked = true;
                // }
            });

            
        });
}

function previewHTMLFileFromServer(url) {
    fetch(url)
        .then((response) => response.text())
        .then((data) => {
            var preview = document.querySelector("#html-preview");
            preview.srcdoc = data;
        });
}

$(document).on("show.bs.modal", ".modal", function () {
    const zIndex = 1040 + 10 * $(".modal:visible").length;
    $(this).css("z-index", zIndex);
    setTimeout(() =>
        $(".modal-backdrop")
            .not(".modal-stack")
            .css("z-index", zIndex - 1)
            .addClass("modal-stack")
    );
});

$(document).on(
    "hidden.bs.modal",
    ".modal",
    () => $(".modal:visible").length && $(document.body).addClass("modal-open")
);

// Dapatkan tinggi layar
var tinggiLayar = window.innerHeight;

// Dapatkan tinggi elemen
var elemenMain = document.querySelector("main");
var elemenFooter = document.querySelector("footer");
var elemenKeterangan = document.querySelector(".keterangan");

var tinggiMain = elemenMain.offsetHeight;
var tinggiFooter = elemenFooter.offsetHeight;
var tinggiKeterangan = elemenKeterangan.offsetHeight;

// Hitung tinggi total elemen
var tinggiTotal = tinggiMain + tinggiFooter + tinggiKeterangan;

// Jika tinggi layar lebih besar dari tinggi total elemen
if (tinggiLayar > tinggiTotal) {
    // Hitung tinggi yang diperlukan untuk elemen pengisi
    var tinggiPengisi = tinggiLayar - tinggiTotal;

    // Buat elemen pengisi
    var elemenPengisi = document.createElement("div");
    elemenPengisi.style.height = tinggiPengisi + "px";

    // Tambahkan elemen pengisi sebelum elemen footer
    elemenFooter.parentNode.insertBefore(elemenPengisi, elemenFooter);
}
