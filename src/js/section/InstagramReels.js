import { addClickEventListener } from '../utils/listeners';

const CLASSNAMES = {
  SLIDER_CONTAINER: '.instagram-reels__swiper',
  BUTTON_NEXT: '.instagram-reels__button--next',
  BUTTON_PREV: '.instagram-reels__button--prev',
  SLIDER_DESCRIPTION: '.instagram-reels__description',
};

class InstagramReels {
  constructor(app, container) {
    this.app = app;
    this.container = container;
    this.swiper = null;
    this.isExpanded = false;

    // Slider container
    this.sliderContainer = container.querySelector(CLASSNAMES.SLIDER_CONTAINER);
    this.sliderDescription = container.querySelector(CLASSNAMES.SLIDER_DESCRIPTION);
    this.buttonNext = container.querySelector(CLASSNAMES.BUTTON_NEXT);
    this.buttonPrev = container.querySelector(CLASSNAMES.BUTTON_PREV);

    addClickEventListener(this.buttonNext, this.goToNextReel.bind(this));
    addClickEventListener(this.buttonPrev, this.goToPrevReel.bind(this));

    // Listen for appLoaded event
    window.addEventListener('appLoaded', this.initSwiper.bind(this));
  }

  initSwiper() {
    this.swiper = new window.$APP.Swiper(this.sliderContainer, {
      modules: [window.$APP.Swiper.Navigation],
      slidesPerView: 4,
      spaceBetween: 24,
      speed: 500,
    });
  }

  goToNextReel() {
    if (this.swiper.activeIndex === 0 && this.isExpanded === false) {
      this.isExpanded = true;
      this.expandSlider();
    } else {
      this.swiper.slideNext();
    }

    if (this.swiper.isEnd) {
      this.buttonNext.classList.remove('active');
    }
  }

  goToPrevReel() {
    if (this.swiper.activeIndex === 0 && this.isExpanded === true) {
      this.isExpanded = false;
      this.compressSlider();
    } else {
      this.swiper.slidePrev();
    }

    if (!this.swiper.isEnd) {
      this.buttonNext.classList.add('active');
    }
  }

  compressSlider() {
    const scrollWidth = this.sliderDescription.dataset.currentWidth;
    this.buttonPrev.classList.remove('active');

    window.$APP.gsap.to(this.sliderDescription, {
      minWidth: scrollWidth,
      duration: 0.3,
      ease: 'power3.inout',
    });
  }

  expandSlider() {
    const currentWidth = this.sliderDescription.offsetWidth;
    this.sliderDescription.dataset.currentWidth = currentWidth;
    this.buttonPrev.classList.add('active');

    window.$APP.gsap.to(this.sliderDescription, {
      minWidth: 0,
      duration: 0.3,
      ease: 'power3.inout',
    });
  }
}

export default InstagramReels;
