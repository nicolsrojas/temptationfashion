document.addEventListener("DOMContentLoaded", () => {
  const carousels = document.querySelectorAll('.swiper-container');

  // Check if Swiper is loaded and if any carousels exist
  if (typeof Swiper !== 'undefined' && carousels.length > 0) {
    carousels.forEach((carousel) => {
      const swiper = new Swiper(carousel.querySelector('[data-carousel]'), {
        slidesPerView: 1,
        spaceBetween: 20,
        breakpoints: {
              480: {
                  slidesPerView: 2,
                  spaceBetween: 20
              },
              768: {
                  slidesPerView: 3,
                  spaceBetween: 30
              },
          },
        loop: true,
        navigation: {
          nextEl: carousel.querySelector('.button-next'),
          prevEl: carousel.querySelector('.button-prev'),
        },
      });
    });
  }
});
