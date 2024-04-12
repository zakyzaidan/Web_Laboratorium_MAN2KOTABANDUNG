
// Dapatkan tinggi layar
var tinggiLayar = window.innerHeight;

// Dapatkan tinggi elemen
var elemenMain = document.querySelector('main');
var elemenFooter = document.querySelector('footer');
var elemenKeterangan = document.querySelector('.keterangan');

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
    var elemenPengisi = document.createElement('div');
    elemenPengisi.style.height = tinggiPengisi + 'px';

    // Tambahkan elemen pengisi sebelum elemen footer
    elemenFooter.parentNode.insertBefore(elemenPengisi, elemenFooter);
}
