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

window.addEventListener('scroll', function() {
    var header = document.querySelector('header.navbar-container .nav-list');
    var sitebar = document.querySelector('header.navbar-container .nav-list #sidebar');

    var windowPosition = window.scrollY > 0;
    header.classList.toggle('scrolling-active', windowPosition);
    sitebar.classList.toggle('scrolling-active', windowPosition);
})



var menuButton = document.querySelector('.menu-button');
var sidebar = document.getElementById('sidebar');

var body = document.body;

menuButton.addEventListener('click', function() {
  if (sidebar.style.transform === 'translateX(0px)') {
    sidebar.style.transform = 'translateX(-100%)';
    body.classList.remove('sidebar-open');
  } else {
    sidebar.style.transform = 'translateX(0)';
    body.classList.add('sidebar-open');
  }
});

document.addEventListener('click', function(event) {
    if (!sidebar.contains(event.target) && !menuButton.contains(event.target)) {
      sidebar.style.transform = 'translateX(-100%)';
      body.classList.remove('sidebar-open');
    }
});
