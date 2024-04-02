var images = [
    "image/Subtract2.png",
    "image/Subtract.jpg",
    "image/Subtract2.png",
    "image/Subtract2.png",
    "image/Subtract2.png",
    "image/Subtract2.png",
    "image/Subtract2.png",
    "image/Subtract2.png",
    "image/Subtract2.png",
    "image/Subtract2.png",
    "image/Subtract2.png",
    "image/Subtract2.png",
    "image/Subtract2.png",
];
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

function createSlideshow(images, containerId, myslide,cekdot,names, codes, emails) {
    var container = document.getElementById(containerId);
    if(cekdot){
        var dotsContainer = document.createElement('div');
        dotsContainer.style.textAlign = 'center';
    }

    for (var i = 0; i < images.length; i++) {
        var slide = document.createElement('div');
        slide.className = myslide;

        var img = document.createElement('img');
        img.src = images[i];
        slide.appendChild(img);
        if(cekdot){
            var dot = document.createElement('span');
            dot.className = 'dot';
            dotsContainer.appendChild(dot);
        }else{
            slide.style.margin = '20px';
            var nameP = document.createElement('h3');
            nameP.textContent = names;

            var codeP = document.createElement('h4');
            codeP.textContent = codes;

            var emailP = document.createElement('h5');
            emailP.textContent = emails;
            slide.appendChild(nameP);
            slide.appendChild(codeP);
            slide.appendChild(emailP);
        }



        container.appendChild(slide);
    }
    if(cekdot){

        container.appendChild(dotsContainer);
    }
}

createSlideshow(images, 'slideshow-container','mySlides',true,"","","");

var slideIndex = 1;
showSlides();
setInterval(function () {
    plusSlides(1);
}, 30000); // Ubah gambar setiap 60 detik
function plusSlides(n) {
    showSlides((slideIndex += n));
}
function currentSlide(n) {
    showSlides((slideIndex = n));
}
function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = slides.length;
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}


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






