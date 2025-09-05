document.addEventListener("DOMContentLoaded", () => {
  const carousels = document.querySelectorAll('.swiper-container');

  // Check if Swiper is loaded and if any carousels exist
  if (typeof Swiper !== 'undefined' && carousels.length > 0) {
    carousels.forEach((carousel) => {
      const swiper = new Swiper(carousel.querySelector('[data-carousel]'), {
          slidesPerView: "auto",
          spaceBetween: 20,
          loop: true,
          watchOverflow: true,
          autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
          },
      });
    });
  }
});
