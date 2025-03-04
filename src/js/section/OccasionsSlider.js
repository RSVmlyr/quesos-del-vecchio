import { addClickEventListener } from '../utils/listeners';
import { mediaQueryHook } from '../utils/mediaQuery';

const CLASSNAMES = {
  MARQUEE: '.occasions-slider__marquee',
  CURRENT_SLIDE: '.occasions-slider__current-count',
  PROGRESS_BAR: '.occasions-slider__progress',
};

class OccasionsSlider {
  constructor(app, container) {
    this.app = app;
    this.container = container;

    this.marqueeElements = container.querySelectorAll(CLASSNAMES.MARQUEE);
    for (const marquee of this.marqueeElements) {
      this.marquee(marquee);
    }

    this.currentSlideCount = container.querySelector(CLASSNAMES.CURRENT_SLIDE);
    this.progressBar = container.querySelector(CLASSNAMES.PROGRESS_BAR);

    // Get total slides from progress bar data attribute
    this.totalSlides = parseInt(this.progressBar.dataset.progressWidth);

    this.swiper = new window.$APP.Swiper(container, {
      modules: [window.$APP.Swiper.Navigation, window.$APP.Swiper.Mousewheel],
      direction: 'vertical',
      slidesPerView: 1,
      mousewheel: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      on: {
        init: (swiper) => {
          this.updateSlideCount(1);
          this.updateProgressBar(1);
        },
        slideChange: (swiper) => {
          this.updateSlideCount(swiper.activeIndex + 1);
          this.updateProgressBar(swiper.activeIndex + 1);
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

  marquee(marquee) {
    const parentSelector = marquee;
    const firstElement = parentSelector.children[0];
    let i = 0;
    let marqueeInterval;

    // Calculate how many copies we need based on viewport width
    const viewportWidth = window.innerWidth;
    const contentWidth = firstElement.clientWidth;
    const copiesNeeded = Math.ceil((viewportWidth * 3) / contentWidth);

    // Create enough copies to fill the screen
    for (let j = 0; j < copiesNeeded; j++) {
      parentSelector.insertAdjacentHTML('beforeend', firstElement.outerHTML);
    }

    marqueeInterval = setInterval(function () {
      firstElement.style.marginLeft = `-${i}px`;
      if (i > firstElement.clientWidth) {
        i = 0;
      }
      i = i + 0.4;
    }, 0);

    // Cleanup interval on page change/unmount
    window.addEventListener('beforeunload', () => {
      clearInterval(marqueeInterval);
    });
  }
}

export default OccasionsSlider;
