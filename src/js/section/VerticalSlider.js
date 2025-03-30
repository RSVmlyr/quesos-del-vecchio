import { mediaQueryHook } from '../utils/mediaQuery';
import { addClickEventListener } from '../utils/listeners';

const CLASSNAMES = {
  SLIDER_CONTAINER: '.vertical-slider__swiper',
  SLIDER_TRIGGER: '.vertical-slider__trigger',
  BLOB: '.vertical-slider__blob',
  SLIDE_TITLE: '.vertical-slider__slide-title',
  NEXT_BUTTON: '.vertical-slider__next-button',
};

class VerticalSlider {
  constructor(app, container) {
    this.app = app;
    this.container = container;
    this.isMobile = mediaQueryHook('(max-width: 1024px)');
    this.swiper = null;

    // Next button
    this.nextButton = container.querySelector(CLASSNAMES.NEXT_BUTTON);
    addClickEventListener(this.nextButton, this.goToNextSection.bind(this));

    // Slider container
    this.sliderContainer = container.querySelector(CLASSNAMES.SLIDER_CONTAINER);
    this.sliderTitles = container.querySelectorAll(CLASSNAMES.SLIDE_TITLE);

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
    const activeSlideTitle = this.sliderTitles[activeSlideIndex];

    activeSlideTitle.classList.add('active');

    window.$APP.gsap.to(activeSlideBlob, {
      scale: 1,
      duration: 0.7,
      ease: 'power2.out',
    });

    window.$APP.gsap.to(activeSlideTitle, {
      opacity: 1,
      duration: 0.5,
      ease: 'linear',
    });
  }

  animationExit(previousSlideIndex) {
    if (this.swiper === null) return;

    const previousSlide = this.swiper.slides[previousSlideIndex];
    const previousSlideBlob = previousSlide.querySelector(CLASSNAMES.BLOB);
    const previousSlideTitle = this.sliderTitles[previousSlideIndex];

    previousSlideTitle.classList.remove('active');

    window.$APP.gsap.to(previousSlideBlob, {
      scale: 0.3,
      duration: 0.7,
      ease: 'power2.out',
    });

    window.$APP.gsap.to(previousSlideTitle, {
      opacity: 0,
      duration: 0.5,
      ease: 'linear',
    });
  }

  goToNextSection() {
    // TODO: Fix link tag
    const nextSection = this.container.nextElementSibling;

    if (nextSection) {
      window.scrollTo({
        top: nextSection.offsetTop,
        left: 0,
        behavior: 'smooth',
      });
    }
  }
}

export default VerticalSlider;
