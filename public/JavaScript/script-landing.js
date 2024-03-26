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

var slideIndex2 = 1;
showSlides2();
setInterval(function () {
    plusSlides2(3);
}, 30000); // Ubah gambar setiap 60 detik
function plusSlides2(n) {
    showSlides2((slideIndex2 += (n - 3)));
}
function currentSlide(n) {
    showSlides2((slideIndex2 = (n - 3)));
}
function showSlides2(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides2");
    if ((n - 3) > slides.length) {
        slideIndex2 = 1;
    }
    if ((n - 3) < 1) {
        slideIndex2 = (slides.length - 3);
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    console.log(slideIndex2 - 1);
    console.log(slideIndex2);
    console.log(slideIndex2 + 1);
    slides[slideIndex2 - 1].style.display = "block";
    slides[slideIndex2].style.display = "block";
    slides[slideIndex2 + 1].style.display = "block";

}




window.addEventListener('scroll', function() {
    var header = document.querySelector('header.navbar-container .nav-list');

    var windowPosition = window.scrollY > 0;

    header.classList.toggle('scrolling-active', windowPosition);

})

