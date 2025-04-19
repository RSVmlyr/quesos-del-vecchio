import { mediaQueryHook } from '../utils/mediaQuery';
import { addClickEventListener } from '../utils/listeners';

const CLASSNAMES = {
  SLIDER_CONTAINER: '.vertical-slider__swiper',
  SLIDER_TRIGGER: '.vertical-slider__trigger',
  BLOB: '.vertical-slider__blob',
  TITLES_CONTAINER: '.vertical-slider__titles-container',
  SLIDE_TITLE: '.vertical-slider__slide-title',
  NEXT_BUTTON: '.vertical-slider__next-button',
};

class VerticalSlider {
  constructor(app, container) {
    this.app = app;
    this.container = container;
    this.animations = this.app.animations;
    this.isMobile = mediaQueryHook('(max-width: 1024px)');
    this.swiper = null;
    this.currentIndex = 0;

    // Next button
    this.nextButton = container.querySelector(CLASSNAMES.NEXT_BUTTON);
    addClickEventListener(this.nextButton, this.goToNextSection.bind(this));

    // Slider container
    this.sliderContainer = container.querySelector(CLASSNAMES.SLIDER_CONTAINER);
    this.sliderTitlesContainer = container.querySelector(CLASSNAMES.TITLES_CONTAINER);
    this.sliderTitles = container.querySelectorAll(CLASSNAMES.SLIDE_TITLE);
    this.blobs = container.querySelectorAll(CLASSNAMES.BLOB);

    for (const title of this.sliderTitles) {
      this.animations.splitTextAnimation.set(title);

      // Set the height of the first title
      if (title === this.sliderTitles[0]) {
        this.setTitlesContainerHeight(title.offsetHeight);
      }
    }

    // Listen for appLoaded event
    window.addEventListener('appLoaded', this.initSwiper.bind(this));

    // Add resize handler
    window.addEventListener('resize', this.handleResize.bind(this));
  }

  handleResize() {
    const newIsMobile = mediaQueryHook('(max-width: 1024px)');

    // Only reinitialize if the mobile state has changed
    if (newIsMobile !== this.isMobile) {
      this.isMobile = newIsMobile;

      // Store current slide index
      if (this.swiper) {
        this.currentIndex = this.swiper.activeIndex;
      }

      // Destroy existing swiper
      if (this.swiper) {
        this.swiper.destroy(true, true);
        this.swiper = null;
      }

      // Reinitialize swiper
      this.initSwiper();
    }
  }

  initSwiper() {
    this.swiper = new window.$APP.Swiper(this.sliderContainer, {
      slidesPerView: 1,
      speed: 500,
      direction: this.isMobile ? 'horizontal' : 'vertical',
      allowTouchMove: false,
      on: {
        slideChange: (swiper) => {
          this.setTitlesContainerHeight(this.sliderTitles[swiper.activeIndex].offsetHeight);
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

    this.initObserver(this.swiper.activeIndex);
    this.setupTriggers();
  }

  initObserver(activeSlideIndex) {
    const start = this.isMobile ? 'bottom bottom' : 'center bottom';

    window.$APP.gsap.timeline({
      scrollTrigger: {
        trigger: this.sliderContainer,
        start,
        onEnter: () => {
          this.animationEnter(activeSlideIndex);
        },
        onLeaveBack: (self) => self.disable(),
      },
    });
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
      opacity: 1,
      duration: 0.7,
      ease: 'power2.out',
    });

    // title animation
    this.animations.splitTextAnimation.run(activeSlideTitle);
  }

  animationExit(previousSlideIndex) {
    if (this.swiper === null) return;

    const previousSlide = this.swiper.slides[previousSlideIndex];
    const previousSlideBlob = previousSlide.querySelector(CLASSNAMES.BLOB);
    const previousSlideTitle = this.sliderTitles[previousSlideIndex];

    previousSlideTitle.classList.remove('active');

    window.$APP.gsap.to(previousSlideBlob, {
      scale: 0.3,
      opacity: 0,
      duration: 0.7,
      ease: 'power2.out',
    });

    // title animation
    this.animations.splitTextAnimation.reset(previousSlideTitle);
  }

  goToNextSection() {
    let nextSection = this.container.nextElementSibling;

    if (nextSection.tagName === 'LINK' || !nextSection) {
      nextSection = nextSection.nextElementSibling;
    }

    if (nextSection) {
      window.scrollTo({
        top: nextSection.offsetTop,
        left: 0,
        behavior: 'smooth',
      });
    }
  }

  setTitlesContainerHeight(height) {
    this.sliderTitlesContainer.style.height = `${height}px`;
  }
}

export default VerticalSlider;
