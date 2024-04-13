// Fungsi untuk mengubah lebar gambar
function adjustImageWidth(img) {
    var screenWidth = window.innerWidth;
    var imgWidth = img.offsetWidth;

    if(screenWidth <= imgWidth) {
        img.style.width = (screenWidth * 0.8) + 'px'; // mengatur lebar gambar menjadi 90% dari lebar layar
    }
    console.log("test");
}

// Membuat observer baru
var observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
        if (mutation.type === 'childList') {
            var images = document.querySelectorAll('img');
            images.forEach(function(img) {
                adjustImageWidth(img);
            });
        }
    });
});

// Mulai mengamati document dengan konfigurasi observer
observer.observe(document, { childList: true, subtree: true });


