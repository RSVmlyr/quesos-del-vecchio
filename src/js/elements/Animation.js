import { setScrollObserver } from '../utils/intersectionObserver';

class Animation {
  constructor(app) {
    this.app = app;
    this.gsap = this.app.gsap;

    this.textSplitDOM = Array.from(document.querySelectorAll('[data-animation-split-text]'));
    this.scaleDOM = Array.from(document.querySelectorAll('[data-animation-scale]'));
    this.fadeInDOM = Array.from(document.querySelectorAll('[data-animation-fade-in]'));
    this.fadeInStaggerDOM = Array.from(document.querySelectorAll('[data-animation-fade-in-stagger]'));

    // Shared functions
    this.splitTextAnimation = {
      set: (element) => {
        element.classList.add('animation--split-text');
        const splitText = window.$APP.SplitType.create(element, {
          types: 'lines,words',
          lineClass: 'animate-text__line',
          wordClass: 'animate-text__word',
        });
      },
      run: (element, delay = 0.3) => {
        const words = element.querySelectorAll('.animate-text__word');

        window.$APP.gsap.to(words, {
          delay,
          ease: 'expo.out',
          duration: 1.2,
          rotation: 0,
          opacity: 1,
          y: '0%',
          stagger: {
            amount: 0.3,
          },
        });
      },
      reset: (element) => {
        const words = element.querySelectorAll('.animate-text__word');

        this.resetAnimations({
          elements: words,
          clearProps: 'opacity,y,rotate',
        });
      },
    };

    this.scaleAnimation = {
      set: (element) => {
        element.classList.add('animation--scale');
      },
      run: (element, delay = 0.3) => {
        window.$APP.gsap.to(element, {
          delay,
          ease: 'expo.out',
          duration: 1.2,
          scale: 1,
          opacity: 1,
        });
      },
      reset: (elements) => {
        this.resetAnimations({
          elements: elements,
          clearProps: 'opacity,scale',
        });
      },
    };

    this.fadeInAnimation = {
      set: (element) => {
        element.classList.add('animation--fade-in');
      },
      run: (element, delay = 0.3) => {
        window.$APP.gsap.to(element, {
          delay,
          opacity: 1,
          y: 0,
          ease: 'expo.out',
          duration: 1.2,
          stagger: 0.1,
        });
      },
      reset: (element) => {
        this.resetAnimations({
          elements: element,
          clearProps: 'opacity,y',
        });
      },
    };

    window.addEventListener('appLoaded', () => {
      this.init();
    });
  }

  async init() {
    if (this.textSplitDOM.length > 0) {
      for (const element of this.textSplitDOM) {
        this.splitTextAnimation.set(element);
      }
    }

    this.initObservers();
  }

  async initObservers() {
    await new Promise((resolve) => setTimeout(resolve, 200));

    await Promise.all([
      ...this.textSplitDOM.map((element) => {
        setScrollObserver(element, this.splitTextAnimationObserver.bind(this, element), {
          rootMargin: '0px',
          threshold: 0.5,
        });
      }),
      ...this.scaleDOM.map((element) => {
        const threshold = element.dataset.animationThreshold || 0.5;
        setScrollObserver(element, this.scaleAnimationObserver.bind(this, element), {
          rootMargin: '0px',
          threshold: Number(threshold),
        });
      }),
      ...this.fadeInDOM.map((element) => {
        const threshold = element.dataset.animationThreshold || 0.5;

        setScrollObserver(element, this.fadeInAnimationObserver.bind(this, element), {
          rootMargin: '0px',
          threshold: Number(threshold),
        });
      }),
      ...this.fadeInStaggerDOM.map((element) => {
        let items = element.querySelectorAll('[data-animation-fade-in-stagger-item]');
        const threshold = element.dataset.animationThreshold || 0;

        if (items.length === 0) {
          items = element.children;
        }

        setScrollObserver(element, this.fadeInStaggerAnimationObserver.bind(this, element, items), {
          rootMargin: '0px',
          threshold: Number(threshold),
        });
      }),
    ]);
  }

  splitTextAnimationObserver(element, observer) {
    if (observer.isIntersecting && !element.dataset.animated) {
      element.dataset.animated = 'true';
      this.splitTextAnimation.run(element);
    }
  }

  scaleAnimationObserver(element, observer) {
    if (observer.isIntersecting && !element.dataset.animated) {
      element.dataset.animated = 'true';
      this.scaleAnimation.run(element);
    }
  }

  fadeInAnimationObserver(element, observer) {
    if (observer.isIntersecting && !element.dataset.animated) {
      element.dataset.animated = 'true';
      this.fadeInAnimation.run(element);
    }
  }

  fadeInStaggerAnimationObserver(element, items, observer) {
    if (observer.isIntersecting && !element.dataset.animated) {
      element.dataset.animated = 'true';
      this.fadeInAnimation.run(items);
    }
  }

  resetAnimations(params) {
    window.$APP.gsap.killTweensOf(params.elements);
    window.$APP.gsap.set(params.elements, {
      duration: 0,
      clearProps: params.clearProps,
    });
  }
}

export default Animation;
