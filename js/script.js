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

if (search_opener) {
    search_opener.addEventListener("click", function () {
        searchWrapper.classList.add("active");
        body.classList.add("search-show");
        menuWrapper.classList.remove("show");
    });

    search_hider.addEventListener("click", function () {
        searchWrapper.classList.remove("active");
        body.classList.remove("search-show");
        body.classList.remove("show");
    });
}

/*-------------------------------------------------*
Filter hide show
*--------------------------------------------------*/
var filter_opener = document.querySelector(".filter-text");
var filterWrapper = document.querySelector(".wpf_form_filter");

if (filter_opener) {
    filterWrapper.classList.add("filter-off");

    filter_opener.addEventListener("click", function () {
        filterWrapper.classList.toggle("filter-off");
    });
}


/*-------------------------------------------------*
Ajax loadmore in related products in knitters page
*--------------------------------------------------*/
document.addEventListener("DOMContentLoaded", function () {
    const contentContainer = document.querySelector(".product_container_js");
    if (contentContainer === null) return;
    const loadMoreButton = document.querySelector(".loadmore_product_js");
    if (loadMoreButton === null) return;
    const items = contentContainer.querySelectorAll("li.hidden");
    let currentIndex = 0; // Start with the first hidden item.

    loadMoreButton.addEventListener("click", function () {
        const itemsToShow = 3;
        for (let i = currentIndex; i < currentIndex + itemsToShow; i++) {
            if (items[i]) {
                items[i].style.display = "block";
            }
        }

        currentIndex += itemsToShow;

        if (currentIndex >= items.length) {
            loadMoreButton.style.display = "none"; // Hide the button when all hidden items are visible.
        }
    });

    // Initially hide all items except the first 3.
    for (let i = 0; i < items.length; i++) {
        if (i >= 3) {
            items[i].style.display = "none";
        }
    }

    // Check if there are no hidden items initially, hide the "Load More" button.
    if (items.length <= 3) {
        loadMoreButton.style.display = "none";
    }
});
