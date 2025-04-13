const CLASSNAMES = {
  SLIDER_CONTAINER: '.gallery-swiper',
};

class Gallery {
  constructor(app, container) {
    this.app = app;
    this.container = container;

    // Slider container
    this.sliderContainer = container.querySelector(CLASSNAMES.SLIDER_CONTAINER);

    // Listen for appLoaded event
    window.addEventListener('appLoaded', this.initCarousel.bind(this));
  }

  initCarousel() {
    // Initialize Embla Carousel
    const swiper = new window.$APP.Swiper(this.sliderContainer, {
      modules: [window.$APP.Swiper.FreeMode, window.$APP.Swiper.Autoplay],
      slidesPerView: 'auto',
      loop: true,
      speed: 5000,
      freeMode: true,
      autoplay: {
        delay: 0.5,
        disableOnInteraction: false,
      },
      spaceBetween: 20,
    });
  }
}

export default Gallery;
