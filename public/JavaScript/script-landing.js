
var foto = [
    "image/Intersect.png",
    "image/Intersect.png",
    "image/Intersect.png",
    "image/Intersect.png",
    "image/Intersect.png",
    "image/Intersect.png",
    "image/Intersect.png",
    "image/Intersect.png",
    "image/Intersect.png",
    "image/Intersect.png",
    "image/Intersect.png",
    "image/Intersect.png",
    "image/Intersect.png",
];


createSlideshow(foto, 'slideshow-container2','mySlides2',false,"Iwan Rosadi, M.Pd","197003042005011004","iwan@gmail.com");

var slide1Index2 = 0;
var slide2Index2 = 1;
var slide3Index2 = 2;
showSlides2();
setInterval(function () {
    plusSlides2(1);
}, 30000); // Ubah gambar setiap 60 detik
function plusSlides2(n) {

    if (n == 1) {
        slide1Index2++;
        slide2Index2++;
        slide3Index2++;
    }else{
        slide1Index2--;
        slide2Index2--;
        slide3Index2--;
    }

    showSlides2(n);
}
function currentSlide(n) {
    showSlides2(n);
}
function showSlides2(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides2");
    for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove('prevpage', 'nextpage');
        slides[i].style.display = "none";
    }

    updateSlideIndex(slides);

    if(n == 1){
        slides[slide1Index2].classList.add('nextpage');
        slides[slide2Index2].classList.add('nextpage');
        slides[slide3Index2].classList.add('nextpage');
    }else{
        slides[slide1Index2].classList.add('prevpage');
        slides[slide2Index2].classList.add('prevpage');
        slides[slide3Index2].classList.add('prevpage');
    }
    var lebarLayar = window.innerWidth;
    console.log(lebarLayar);
    slides[slide1Index2].style.display = "block";
    if (lebarLayar > 900) {
        slides[slide2Index2].style.display = "block";
    }
    if (lebarLayar > 1300) {
        slides[slide3Index2].style.display = "block";
    }

}
function updateSlideIndex( slides) {
    if (slide3Index2 > (slides.length - 1)) {
        slide1Index2 = 0;
        slide2Index2 = 1;
        slide3Index2 = 2;
    }

    if (slide1Index2 < 0) {
        slide3Index2 = slides.length - 1;
        slide2Index2 = slides.length - 2;
        slide1Index2 = slides.length - 3;
    }

}






