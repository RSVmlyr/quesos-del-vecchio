const CLASSNAMES = {
  SLIDER_CONTAINER: '.four-images-slider__swiper',
  CURRENT_SLIDE: '.four-images-slider__current-count',
  PROGRESS_BAR: '.four-images-slider__progress',
  BUTTON_NEXT: '.four-images-slider__button--next',
  BUTTON_PREV: '.four-images-slider__button--prev',
};

class FourImagesSlider {
  constructor(app, container) {
    this.app = app;
    this.container = container;
    this.swiper = null;

    // Slider container
    this.sliderContainer = container.querySelector(CLASSNAMES.SLIDER_CONTAINER);
    this.sliderItemsCount = this.sliderContainer.querySelectorAll('.swiper-slide').length;

    this.progressBar = container.querySelector(CLASSNAMES.PROGRESS_BAR);

    if (this.sliderItemsCount > 1) {
      this.currentSlideCount = container.querySelector(CLASSNAMES.CURRENT_SLIDE);
      this.buttonNext = container.querySelector(CLASSNAMES.BUTTON_NEXT);
      this.buttonPrev = container.querySelector(CLASSNAMES.BUTTON_PREV);
      // Get total slides from progress bar data attribute
      this.totalSlides = parseInt(this.progressBar.dataset.progressWidth);
    }

    // Listen for appLoaded event
    window.addEventListener('appLoaded', this.initSwiper.bind(this));
  }

  initSwiper() {
    this.swiper = new window.$APP.Swiper(this.sliderContainer, {
      modules: [window.$APP.Swiper.Navigation],
      slidesPerView: 1,
      speed: 500,
      navigation: {
        nextEl: this.buttonNext,
        prevEl: this.buttonPrev,
      },
      on: {
        init: () => {
          if (this.sliderItemsCount > 1) {
            this.updateSlideCount(1);
            this.updateProgressBar(1);
          }
        },
        slideChange: (swiper) => {
          if (this.sliderItemsCount > 1) {
            this.updateSlideCount(swiper.activeIndex + 1);
            this.updateProgressBar(swiper.activeIndex + 1);
          }
        },
      },
    });
  }

  updateSlideCount(currentSlide) {
    // Format number with leading zero if less than 10
    const formattedNumber = currentSlide < 10 ? `0${currentSlide}` : currentSlide;
    this.currentSlideCount.textContent = formattedNumber;
  }

  updateProgressBar(currentSlide) {
    const progress = (currentSlide / this.totalSlides) * 100;
    this.progressBar.style.setProperty('--progress-width', `${progress}%`);
  }
}

export default FourImagesSlider;
