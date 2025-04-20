const CLASSNAMES = {
  TITLE: '.scroll-sections__title',
  TITLE_CONTAINER: '.scroll-sections__title-container',
  CONTENT_CONTAINER: '.scroll-sections__content',
  CONTENT_IMAGE: '.scroll-sections__content-image',
  CONTENT_TEXT: '.scroll-sections__content-text',
  TRIGGER: '.scroll-sections__trigger',
};

class ScrollSections {
  constructor(app, container) {
    this.app = app;
    this.container = container;

    this.title = this.container.querySelector(CLASSNAMES.TITLE);
    this.titleContainer = this.container.querySelector(CLASSNAMES.TITLE_CONTAINER);
    this.contentContainer = this.container.querySelector(CLASSNAMES.CONTENT_CONTAINER);
    this.triggers = this.container.querySelectorAll(CLASSNAMES.TRIGGER);

    // Cache all elements that will be animated
    this.textElements = this.container.querySelectorAll(CLASSNAMES.CONTENT_TEXT);
    this.imageElements = this.container.querySelectorAll(CLASSNAMES.CONTENT_IMAGE);

    // Set initial state and optimize for animations
    this.imageElements.forEach((image) => {
      window.$APP.gsap.set(image, {
        willChange: 'transform, opacity',
        backfaceVisibility: 'hidden',
        perspective: 1000,
        force3D: true,
      });
    });

    window.addEventListener('appLoaded', this.init.bind(this));
  }

  init() {
    this.titlePin();
    this.contentPin();

    for (const trigger of this.triggers) {
      this.triggerListener(trigger);
    }
  }

  titlePin() {
    const titleOffsetFromTop = this.title.getBoundingClientRect().top - this.container.getBoundingClientRect().top;

    window.$APP.gsap.ScrollTrigger.create({
      trigger: this.title,
      start: `top top+=40px`,
      end: `+=${this.container.offsetHeight - titleOffsetFromTop}px bottom`,
      scrub: true,
      pin: this.title,

      onRefresh: (self) => {
        // Force a recalculation of positions
        self.refresh();
      },
    });

    window.$APP.gsap.to(this.title, {
      ease: 'none',
      opacity: 0.3,
      scale: 1.5,
      scrollTrigger: {
        trigger: this.titleContainer,
        start: `top top`,
        end: `center top`,
        scrub: true,
        onRefresh: (self) => {
          // Force a recalculation of positions
          self.refresh();
        },
      },
    });
  }

  contentPin() {
    window.$APP.gsap.ScrollTrigger.create({
      trigger: this.container,
      start: 'top top',
      end: 'bottom bottom',
      pin: this.contentContainer,
      pinSpacing: false,
    });
  }

  triggerListener(trigger) {
    const triggerIndex = Array.from(this.triggers).indexOf(trigger);
    const currentText = this.textElements[triggerIndex];
    const currentImage = this.imageElements[triggerIndex];
    const prevText = triggerIndex > 0 ? this.textElements[triggerIndex - 1] : null;
    const prevImage = triggerIndex > 0 ? this.imageElements[triggerIndex - 1] : null;

    window.$APP.gsap.ScrollTrigger.create({
      trigger: trigger,
      start: 'top center',
      end: 'bottom center',
      onEnter: () => {
        // Hide previous text with fade up
        if (prevText) {
          window.$APP.gsap.to(prevText, {
            y: -50,
            opacity: 0,
            duration: 0.5,
            ease: 'power2.out',
            force3D: true,
          });

          // Move previous image back
          window.$APP.gsap.to(prevImage, {
            z: -100 * triggerIndex,
            y: -10 * triggerIndex,
            duration: 0.3,
            ease: 'power2.inOut',
            force3D: true,
          });
        }

        // Show current text with fade up
        window.$APP.gsap.fromTo(
          currentText,
          {
            y: 50,
            opacity: 0,
          },
          {
            y: 0,
            opacity: 1,
            duration: 0.5,
            ease: 'power2.out',
            force3D: true,
          }
        );

        // Bring current image forward
        window.$APP.gsap.to(currentImage, {
          opacity: 1,
          z: 0,
          y: 0,
          duration: 0.3,
          ease: 'power2.inOut',
          force3D: true,
        });
      },
      onLeaveBack: () => {
        // Hide current text with fade up
        window.$APP.gsap.to(currentText, {
          y: -50,
          opacity: 0,
          duration: 0.5,
          ease: 'power2.out',
          force3D: true,
        });

        // Move current image back
        window.$APP.gsap.to(currentImage, {
          opacity: 0,
          z: -100 * (triggerIndex + 1),
          y: -10 * (triggerIndex + 1),
          duration: 0.3,
          ease: 'power2.inOut',
          force3D: true,
        });

        // Show previous text with fade up
        if (prevText) {
          window.$APP.gsap.fromTo(
            prevText,
            {
              y: 50,
              opacity: 0,
            },
            {
              y: 0,
              opacity: 1,
              duration: 0.5,
              ease: 'power2.out',
              force3D: true,
            }
          );

          // Bring previous image forward
          window.$APP.gsap.to(prevImage, {
            opacity: 1,
            z: 0,
            y: 0,
            duration: 0.3,
            ease: 'power2.inOut',
            force3D: true,
          });
        }
      },
    });
  }
}

export default ScrollSections;
