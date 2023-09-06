/*-------------------------------------------------*
Menu toggle mobile
*--------------------------------------------------*/

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

/*-------------------------------------------------*
Header Search bar 
*--------------------------------------------------*/

var search_opener = document.querySelector('.search-item');
var search_hider = document.querySelector('.search-close');
var searchWrapper = document.querySelector('header');

search_opener.addEventListener("click", function(){
    searchWrapper.classList.add('active');
});


search_hider.addEventListener("click", function(){
    searchWrapper.classList.remove('active');
});
