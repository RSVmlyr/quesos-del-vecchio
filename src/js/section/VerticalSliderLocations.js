import { mediaQueryHook } from '../utils/mediaQuery';

const CLASSNAMES = {
  SLIDER_CONTAINER: '.vertical-slider-locations__swiper',
  SLIDER_TRIGGER: '.vertical-slider-locations__trigger',
  BLOB: '.vertical-slider-locations__blob',
  SLIDE_CONTENT: '.vertical-slider-locations__slide-content',
  TITLES_CONTAINER: '.vertical-slider-locations__titles-container',

  SLIDE_TITLE: '.vertical-slider-locations__slide-title',
  SLIDE_DESCRIPTION: '.vertical-slider-locations__slide-description',
  SLIDE_EYEBROW: '.vertical-slider-locations__eyebrow',
};

class VerticalSliderLocations {
  constructor(app, container) {
    this.app = app;
    this.container = container;
    this.isMobile = mediaQueryHook('(max-width: 1024px)');
    this.swiper = null;
    this.animations = this.app.animations;
    this.currentIndex = 0;

    // Slider container
    this.sliderContainer = container.querySelector(CLASSNAMES.SLIDER_CONTAINER);
    this.sliderContents = container.querySelectorAll(CLASSNAMES.SLIDE_CONTENT);
    this.sliderTitlesContainer = container.querySelector(CLASSNAMES.TITLES_CONTAINER);

    for (const content of this.sliderContents) {
      const title = content.querySelector(CLASSNAMES.SLIDE_TITLE);
      const description = content.querySelector(CLASSNAMES.SLIDE_DESCRIPTION);
      const eyebrow = content.querySelector(CLASSNAMES.SLIDE_EYEBROW);

      this.animations.splitTextAnimation.set(title);
      this.animations.fadeInAnimation.set(description);
      this.animations.fadeInAnimation.set(eyebrow);

      if (content === this.sliderContents[0]) {
        this.setTitlesContainerHeight(content.offsetHeight);
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
          this.setTitlesContainerHeight(this.sliderContents[swiper.activeIndex].offsetHeight);
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
    const activeSlideContent = this.sliderContents[activeSlideIndex];

    const activeSlideTitle = activeSlideContent.querySelector(CLASSNAMES.SLIDE_TITLE);
    const activeSlideDescription = activeSlideContent.querySelector(CLASSNAMES.SLIDE_DESCRIPTION);
    const activeSlideEyebrow = activeSlideContent.querySelector(CLASSNAMES.SLIDE_EYEBROW);

    activeSlideContent.classList.add('active');

    window.$APP.gsap.to(activeSlideBlob, {
      scale: 1,
      opacity: 1,
      duration: 0.7,
      ease: 'power2.out',
    });

    this.animations.splitTextAnimation.run(activeSlideTitle);
    this.animations.fadeInAnimation.run(activeSlideDescription);
    this.animations.fadeInAnimation.run(activeSlideEyebrow);
  }

  animationExit(previousSlideIndex) {
    if (this.swiper === null) return;

    const previousSlide = this.swiper.slides[previousSlideIndex];
    const previousSlideBlob = previousSlide.querySelector(CLASSNAMES.BLOB);
    const previousSlideContent = this.sliderContents[previousSlideIndex];

    const previousSlideTitle = previousSlideContent.querySelector(CLASSNAMES.SLIDE_TITLE);
    const previousSlideDescription = previousSlideContent.querySelector(CLASSNAMES.SLIDE_DESCRIPTION);
    const previousSlideEyebrow = previousSlideContent.querySelector(CLASSNAMES.SLIDE_EYEBROW);

    previousSlideContent.classList.remove('active');

    window.$APP.gsap.to(previousSlideBlob, {
      scale: 0.3,
      duration: 0.7,
      opacity: 0,
      ease: 'power2.out',
    });

    this.animations.splitTextAnimation.reset(previousSlideTitle);
    this.animations.fadeInAnimation.reset(previousSlideDescription);
    this.animations.fadeInAnimation.reset(previousSlideEyebrow);
  }

  setTitlesContainerHeight(height) {
    this.sliderTitlesContainer.style.height = `${height}px`;
  }
}

export default VerticalSliderLocations;
