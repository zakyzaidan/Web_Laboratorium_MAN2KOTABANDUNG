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
