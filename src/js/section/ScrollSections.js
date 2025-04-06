const CLASSNAMES = {
  TITLE: '.title-animation',
  TITLE_CONTAINER: '.title-container',
  SECTIONS_CONTAINER: '.sections-container',
  SECTIONS: '.scroll-section',
  PIN: '.scroll-sections__pin',
};

class ScrollSections {
  constructor(app, container) {
    this.app = app;
    this.container = container;

    this.pin = container.querySelector(CLASSNAMES.PIN);
    this.title = container.querySelector(CLASSNAMES.TITLE);
    this.titleContainer = container.querySelector(CLASSNAMES.TITLE_CONTAINER);
    this.sectionsContainer = container.querySelector(CLASSNAMES.SECTIONS_CONTAINER);
    this.sections = container.querySelectorAll(CLASSNAMES.SECTIONS);

    this.init();
  }

  init() {
    // Create main timeline for the entire section
    this.createMainTimeline();
  }

  createMainTimeline() {
    // Create master timeline
    const masterTl = window.$APP.gsap.timeline({
      ease: 'none',
      scrollTrigger: {
        trigger: this.pin,
        start: 'top top',
        end: `+=${this.sections.length * 100}vh`, // Add extra space for smoother scrolling
        scrub: true,
        // pin: true,
      },
    });
  }
}

export default ScrollSections;
