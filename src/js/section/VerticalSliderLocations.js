import { mediaQueryHook } from '../utils/mediaQuery';

const CLASSNAMES = {
  SLIDER_CONTAINER: '.vertical-slider-locations__swiper',
  SLIDER_TRIGGER: '.vertical-slider-locations__trigger',
  BLOB: '.vertical-slider-locations__blob',
  SLIDE_CONTENT: '.vertical-slider-locations__slide-content',
};

class VerticalSliderLocations {
  constructor(app, container) {
    this.app = app;
    this.container = container;
    this.isMobile = mediaQueryHook('(max-width: 1024px)');
    this.swiper = null;

    // Slider container
    this.sliderContainer = container.querySelector(CLASSNAMES.SLIDER_CONTAINER);
    this.sliderContents = container.querySelectorAll(CLASSNAMES.SLIDE_CONTENT);

    // Listen for appLoaded event
    window.addEventListener('appLoaded', this.initSwiper.bind(this));
  }

  initSwiper() {
    this.swiper = new window.$APP.Swiper(this.sliderContainer, {
      slidesPerView: 1,
      speed: 500,
      direction: this.isMobile ? 'horizontal' : 'vertical',
      allowTouchMove: false,
      on: {
        slideChange: (swiper) => {
          this.animationEnter(swiper.activeIndex);
        },
        slideChangeTransitionStart: (swiper) => {
          const isNextSlide = swiper.previousTranslate > swiper.translate;
          const activeIndex = swiper.activeIndex;
          const previousSlideIndex = isNextSlide ? activeIndex - 1 : activeIndex + 1;

          this.animationExit(previousSlideIndex);
        },
      },
    });

    this.animationEnter(0);
    this.setupTriggers();
  }

  setupTriggers() {
    this.triggers = this.container.querySelectorAll(CLASSNAMES.SLIDER_TRIGGER);

    for (const trigger of this.triggers) {
      window.$APP.gsap.timeline({
        scrollTrigger: {
          trigger: trigger,
          start: 'top bottom',
          end: 'bottom bottom',
          onEnter: (self) => {
            this.swiper.slideTo(parseInt(self.trigger.dataset.index));
          },
          onEnterBack: (self) => {
            this.swiper.slideTo(parseInt(self.trigger.dataset.index));
          },
        },
      });
    }
  }

  animationEnter(activeSlideIndex) {
    if (this.swiper === null) return;

    const activeSlide = this.swiper.slides[activeSlideIndex];
    const activeSlideBlob = activeSlide.querySelector(CLASSNAMES.BLOB);
    const activeSlideContent = this.sliderContents[activeSlideIndex];

    activeSlideContent.classList.add('active');

    window.$APP.gsap.to(activeSlideBlob, {
      scale: 1,
      duration: 0.7,
      ease: 'power2.out',
    });

    window.$APP.gsap.to(activeSlideContent, {
      opacity: 1,
      duration: 0.5,
      ease: 'linear',
    });
  }

  animationExit(previousSlideIndex) {
    if (this.swiper === null) return;

    const previousSlide = this.swiper.slides[previousSlideIndex];
    const previousSlideBlob = previousSlide.querySelector(CLASSNAMES.BLOB);
    const previousSlideContent = this.sliderContents[previousSlideIndex];

    previousSlideContent.classList.remove('active');

    window.$APP.gsap.to(previousSlideBlob, {
      scale: 0.3,
      duration: 0.7,
      ease: 'power2.out',
    });

    window.$APP.gsap.to(previousSlideContent, {
      opacity: 0,
      duration: 0.5,
      ease: 'linear',
    });
  }
}

export default VerticalSliderLocations;
