import { addClickEventListener } from '../utils/listeners';

const CLASSNAMES = {
  SLIDER_CONTAINER: '.recipe-slider__swiper',
};

class RecipeSlider {
  constructor(app, container) {
    this.app = app;
    this.container = container;
    this.swiper = null;

    // Slider container
    this.sliderContainer = container.querySelector(CLASSNAMES.SLIDER_CONTAINER);

    // Listen for appLoaded event
    window.addEventListener('appLoaded', this.initSwiper.bind(this));
  }

  initSwiper() {
    this.swiper = new window.$APP.Swiper(this.sliderContainer, {
      modules: [window.$APP.Swiper.Navigation],
      slidesPerView: 3.8,
      spaceBetween: 50,
      speed: 500,
      loop: true,
    });
  }
}

export default RecipeSlider;
