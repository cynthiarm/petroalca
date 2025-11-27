// ============================
// Swiper 1 — Terminals
// ============================
var swiper1 = new Swiper(".infraSwiper", {
    loop: true,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    speed: 900,
    slidesPerView: 1,
    spaceBetween: 0,
    observer: true,
    observeParents: true,
    pagination: {
        el: ".infraSwiper .swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".infraSwiper .swiper-button-next",
        prevEl: ".infraSwiper .swiper-button-prev",
    }
});


// ============================
// Swiper 2 — Barges
// ============================
var swiper2 = new Swiper(".infraSwiper2", {
    loop: true,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    speed: 900,
    slidesPerView: 1,
    spaceBetween: 0,
    observer: true,
    observeParents: true,
    pagination: {
        el: ".infraSwiper2 .swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".infraSwiper2 .swiper-button-next",
        prevEl: ".infraSwiper2 .swiper-button-prev",
    }
});


// ============================
// Lightbox (separate galleries)
// ============================
const lightbox = GLightbox({
    selector: ".glightbox",
    touchNavigation: true,
    loop: true,
    zoomable: true,
    draggable: true,
    openEffect: "zoom",
    closeEffect: "fade",
});