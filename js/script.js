var opener = document.querySelector('.menu-toggler');
var hider = document.querySelector('.menu-close');
var menuWrapper = document.querySelector('nav');
var body = document.querySelector('body');

opener.addEventListener("click", function(){
    menuWrapper.classList.add('show');
    body.classList.add('show');
});


hider.addEventListener("click", function(){
    menuWrapper.classList.remove('show');
    body.classList.remove('show');
});
