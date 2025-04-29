const CLASSNAMES = {
  SLIDER_CONTAINER: '.content-slider__swiper',
  CURRENT_SLIDE: '.content-slider__current-count',
  PROGRESS_BAR: '.content-slider__progress',
  BUTTON_NEXT: '.content-slider__button--next',
  BUTTON_PREV: '.content-slider__button--prev',

  TITLE: '.content-slider__title',
  PRE_TITLE: '.content-slider__pre-title',
  DESCRIPTION: '.content-slider__description',
  LINK: '.content-slider__link',
  IMAGE: '.content-slider__images-item',
};

class ContentSlider {
  constructor(app, container) {
    this.app = app;
    this.container = container;
    this.swiper = null;
    this.animations = app.animations;

    // Slider container
    this.sliderContainer = container.querySelector(CLASSNAMES.SLIDER_CONTAINER);
    this.sliderItemsCount = this.sliderContainer.querySelectorAll('.swiper-slide').length;

    this.sliderTitles = Array.from(this.sliderContainer.querySelectorAll(CLASSNAMES.TITLE));
    this.sliderPreTitles = Array.from(this.sliderContainer.querySelectorAll(CLASSNAMES.PRE_TITLE));
    this.sliderDescriptions = Array.from(this.sliderContainer.querySelectorAll(CLASSNAMES.DESCRIPTION));
    this.sliderLinks = Array.from(this.sliderContainer.querySelectorAll(CLASSNAMES.LINK));

    this.progressBar = container.querySelector(CLASSNAMES.PROGRESS_BAR);

    if (this.sliderItemsCount > 1) {
      this.currentSlideCount = container.querySelector(CLASSNAMES.CURRENT_SLIDE);
      this.buttonNext = container.querySelector(CLASSNAMES.BUTTON_NEXT);
      this.buttonPrev = container.querySelector(CLASSNAMES.BUTTON_PREV);
      // Get total slides from progress bar data attribute
      this.totalSlides = parseInt(this.progressBar.dataset.progressWidth);
    }

    this.initEventListeners();
    this.initAnimations();
  }

  async initAnimations() {
    await Promise.all([
      ...this.sliderTitles.map((title) => this.animations.splitTextAnimation.set(title)),
      ...this.sliderPreTitles.map((preTitle) => this.animations.fadeInAnimation.set(preTitle)),
      ...this.sliderDescriptions.map((description) => this.animations.fadeInAnimation.set(description)),
      ...this.sliderLinks.map((link) => this.animations.scaleAnimation.set(link)),
    ]);
  }

  initEventListeners() {
    // Listen for appLoaded event
    window.addEventListener('appLoaded', this.initSwiper.bind(this));
  }

  initSwiper() {
    this.swiper = new window.$APP.Swiper(this.sliderContainer, {
      modules: [window.$APP.Swiper.Navigation],
      slidesPerView: 1,
      speed: 400,
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
          this.animationEnter(swiper.activeIndex);

          if (this.sliderItemsCount > 1) {
            this.updateSlideCount(swiper.activeIndex + 1);
            this.updateProgressBar(swiper.activeIndex + 1);
          }
        },
        slideChangeTransitionEnd: (swiper) => {
          const isNextSlide = swiper.previousTranslate > swiper.translate;
          const activeIndex = swiper.activeIndex;
          const previousSlideIndex = isNextSlide ? activeIndex - 1 : activeIndex + 1;

          this.animationExit(previousSlideIndex);
        },
      },
    });

    this.initObserver(this.swiper.activeIndex);
  }

  initObserver(activeSlideIndex) {
    window.$APP.gsap.timeline({
      scrollTrigger: {
        trigger: this.sliderContainer,
        start: 'center bottom',
        onEnter: () => {
          this.animationEnter(activeSlideIndex, true);
        },
        onLeaveBack: (self) => self.disable(),
      },
    });
  }

  animationEnter(activeSlideIndex, onEnter = false) {
    if (this.swiper === null) return;

    const activeSlideTitle = this.sliderTitles[activeSlideIndex];
    const activeSlidePreTitle = this.sliderPreTitles[activeSlideIndex];
    const activeSlideDescription = this.sliderDescriptions[activeSlideIndex];
    const activeSlideLink = this.sliderLinks[activeSlideIndex];

    // title animation
    this.animations.fadeInAnimation.run(activeSlidePreTitle, onEnter ? 0 : 0.5);
    this.animations.splitTextAnimation.run(activeSlideTitle, onEnter ? 0 : 0.5);
    this.animations.fadeInAnimation.run(activeSlideDescription, onEnter ? 0.3 : 0.6);
    this.animations.scaleAnimation.run(activeSlideLink, onEnter ? 0.4 : 0.6);
  }

  animationExit(previousSlideIndex) {
    if (this.swiper === null) return;

    const previousSlideTitle = this.sliderTitles[previousSlideIndex];
    const previousSlidePreTitle = this.sliderPreTitles[previousSlideIndex];
    const previousSlideDescription = this.sliderDescriptions[previousSlideIndex];
    const previousSlideLink = this.sliderLinks[previousSlideIndex];

    // title animation
    this.animations.splitTextAnimation.reset(previousSlideTitle);
    this.animations.fadeInAnimation.reset(previousSlidePreTitle);
    this.animations.fadeInAnimation.reset(previousSlideDescription);
    this.animations.scaleAnimation.reset(previousSlideLink);
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

export default ContentSlider;
