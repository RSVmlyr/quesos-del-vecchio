import { getAncestorByClass } from '../utils/querySelectors';
import { mediaQueryHook } from '../utils/mediaQuery';
const CLASSNAMES = {
  MARQUEE: '.occasions-slider__marquee',
  CURRENT_SLIDE: '.occasions-slider__current-count',
  PROGRESS_BAR: '.occasions-slider__progress',

  BLOBS: '.occasions-slider__item-blob',

  BLOB_TITLE: '.occasions-slider__item-blob-title',
  BLOB_BUTTON: '.occasions-slider__item-blob-button',
  SLIDER_ITEM: '.occasions-slider__item',
  BLOB_HOVER: '.occasions-slider__item-blob-hover',
  BLOB_MAIN: '.occasions-slider__item-blob-main',
  BLOB_SECONDARY: '.occasions-slider__item-blob-secondary',
  PRODUCT_CONTAINER: '.occasions-slider__item-product-images',
  PRODUCT_IMAGES: '.occasions-slider__item-product-image',
};

class OccasionsSlider {
  constructor(app, container) {
    this.app = app;
    this.container = container;
    this.animations = app.animations;
    this.isMobile = mediaQueryHook('(max-width: 1024px)');

    // SplitText
    this.blobTitleElements = container.querySelectorAll(CLASSNAMES.BLOB_TITLE);
    for (const blobTitle of this.blobTitleElements) {
      this.animations.splitTextAnimation.set(blobTitle);
    }

    // Marquee
    this.marqueeElements = container.querySelectorAll(CLASSNAMES.MARQUEE);
    for (const marquee of this.marqueeElements) {
      this.marquee(marquee);
    }

    // Blob button
    this.blobButtonElements = container.querySelectorAll(CLASSNAMES.BLOB_BUTTON);
    for (const blobButton of this.blobButtonElements) {
      const parent = getAncestorByClass(blobButton, CLASSNAMES.SLIDER_ITEM.split('.')[1]);
      const blobHover = parent.querySelector(CLASSNAMES.BLOB_HOVER);
      const blobMain = parent.querySelector(CLASSNAMES.BLOB_MAIN);
      const blobSecondary = parent.querySelectorAll(CLASSNAMES.BLOB_SECONDARY);
      const productImages = parent.querySelectorAll(CLASSNAMES.PRODUCT_IMAGES);
      const productContainer = parent.querySelector(CLASSNAMES.PRODUCT_CONTAINER);
      this.animations.scaleAnimation.set(blobButton);

      blobButton.addEventListener('mouseenter', () => {
        if (this.isMobile) return;

        this.hoverStart({
          mainImage: blobMain,
          hoverImage: blobHover,
          secondaryImages: blobSecondary,
          productImages,
          productContainer,
        });
      });

      blobButton.addEventListener('mouseleave', () => {
        if (this.isMobile) return;

        this.hoverEnd({
          mainImage: blobMain,
          hoverImage: blobHover,
          secondaryImages: blobSecondary,
          productImages,
          productContainer,
        });
      });
    }

    // Slider
    this.currentSlideCount = container.querySelector(CLASSNAMES.CURRENT_SLIDE);
    this.progressBar = container.querySelector(CLASSNAMES.PROGRESS_BAR);

    // Get total slides from progress bar data attribute
    this.totalSlides = parseInt(this.progressBar.dataset.progressWidth);

    // Listen for appLoaded event
    window.addEventListener('appLoaded', () => {
      this.initSwiper();
    });
  }

  initSwiper() {
    this.swiper = new window.$APP.Swiper(this.container, {
      modules: [window.$APP.Swiper.Navigation, window.$APP.Swiper.Mousewheel],
      direction: 'vertical',
      slidesPerView: 1,
      mousewheel: {
        enable: true,
        thresholdDelta: 15,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      on: {
        init: (swiper) => {
          const activeSlide = swiper.slides[swiper.activeIndex];
          const blobElements = activeSlide.querySelectorAll(CLASSNAMES.BLOBS);
          const marqueeElement = activeSlide.querySelector(CLASSNAMES.MARQUEE);

          const blobTitleElement = activeSlide.querySelector(CLASSNAMES.BLOB_TITLE);
          const blobButtonElement = activeSlide.querySelector(CLASSNAMES.BLOB_BUTTON);

          this.animations.splitTextAnimation.run(blobTitleElement, 0.6);
          this.animations.scaleAnimation.run(blobButtonElement, 0.7);

          this.animateMarquee(marqueeElement);
          this.animateBlobSecondary(blobElements);
          this.updateSlideCount(1);
          this.updateProgressBar(1);
        },
        slideChange: (swiper) => {
          const activeSlide = swiper.slides[swiper.activeIndex];

          const currentBlobElements = activeSlide.querySelectorAll(CLASSNAMES.BLOBS);
          const currentMarqueeElement = activeSlide.querySelector(CLASSNAMES.MARQUEE);

          const blobTitleElement = activeSlide.querySelector(CLASSNAMES.BLOB_TITLE);
          const blobButtonElement = activeSlide.querySelector(CLASSNAMES.BLOB_BUTTON);

          this.animations.splitTextAnimation.run(blobTitleElement, 0.6);
          this.animations.scaleAnimation.run(blobButtonElement, 0.7);

          this.animateMarquee(currentMarqueeElement);
          this.animateBlobSecondary(currentBlobElements);
          this.updateSlideCount(swiper.activeIndex + 1);
          this.updateProgressBar(swiper.activeIndex + 1);
        },
        slideChangeTransitionEnd: (swiper) => {
          const isNextSlide = swiper.previousTranslate > swiper.translate;
          const activeIndex = swiper.activeIndex;
          const previousSlide = swiper.slides[isNextSlide ? activeIndex - 1 : activeIndex + 1];

          const previousBlobSecondaryElements = previousSlide.querySelectorAll(CLASSNAMES.BLOBS);
          const previousMarqueeElement = previousSlide.querySelector(CLASSNAMES.MARQUEE);

          const blobTitleElement = previousSlide.querySelector(CLASSNAMES.BLOB_TITLE);
          const blobButtonElement = previousSlide.querySelector(CLASSNAMES.BLOB_BUTTON);

          this.animations.splitTextAnimation.reset(blobTitleElement);
          this.animations.scaleAnimation.reset(blobButtonElement);

          this.animations.resetAnimations({
            elements: [...previousBlobSecondaryElements, previousMarqueeElement],
            clearProps: 'scale,y,opacity',
          });
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

  animateBlobSecondary(blobs) {
    this.app.gsap.to(blobs, {
      y: 0,
      scale: 1,
      delay: 0.2,
      duration: 0.7,
      ease: 'back.out(.8)',
      stagger: 0.2,
    });
  }

  animateMarquee(marquee) {
    this.app.gsap.to(marquee, {
      delay: 0.4,
      opacity: 1,
      duration: 0.7,
      ease: 'power2.out',
    });
  }

  hoverStart(params) {
    params.productContainer.style.display = 'block';

    this.app.gsap.to(params.mainImage, {
      opacity: 0,
      duration: 0.4,
      ease: 'power2.out',
    });

    this.app.gsap.to(params.hoverImage, {
      opacity: 1,
      duration: 0.4,
      ease: 'power2.out',
    });

    this.app.gsap.to(params.secondaryImages, {
      opacity: 0,
      duration: 0.4,
      ease: 'power2.out',
    });

    this.app.gsap.to(params.productImages, {
      y: 0,
      duration: 0.3,
      ease: 'power2.out',
      stagger: {
        each: 0.03,
        from: 'random',
      },
    });
  }

  hoverEnd(params) {
    this.app.animations.resetAnimations({
      elements: [params.mainImage, params.hoverImage, params.secondaryImages],
      clearProps: 'opacity',
    });

    this.app.gsap.to(params.productImages, {
      y: '100vh',
      duration: 0.2,
      ease: 'power2.out',
      onComplete: () => {
        params.productContainer.style.display = 'none';
        this.app.animations.resetAnimations({
          elements: params.productImages,
          clearProps: 'y',
        });
      },
    });
  }
}

export default OccasionsSlider;
