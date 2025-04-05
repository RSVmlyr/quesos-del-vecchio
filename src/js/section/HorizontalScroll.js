const CLASSNAMES = {
  WRAPPER: '.horizontal-scroll__wrapper',
  SECTION: '.horizontal-scroll__section',
};

class HorizontalScroll {
  constructor(app, container) {
    this.app = app;
    this.container = container;
    this.wrapper = this.container.querySelector(CLASSNAMES.WRAPPER);
    this.sections = this.wrapper.querySelectorAll(CLASSNAMES.SECTION);
    this.gap = 28; // This should match the gap-28 class value

    this.init();
  }

  calculateTotalWidth() {
    let totalWidth = 0;
    this.sections.forEach((section) => {
      const sectionWidth = section.offsetWidth;
      totalWidth += sectionWidth + this.gap;
    });
    // Subtract the last gap since it's not needed after the last section
    totalWidth -= this.gap;
    return totalWidth;
  }

  init() {
    // Set the wrapper width based on actual section widths
    this.wrapper.style.width = `${this.calculateTotalWidth()}px`;

    window.$APP.gsap.to(this.wrapper, {
      x: () => -(this.wrapper.scrollWidth - document.documentElement.clientWidth) + 'px',
      ease: 'none',
      scrollTrigger: {
        trigger: this.container,
        start: 'top top',
        end: () => '+=' + (this.wrapper.scrollWidth - document.documentElement.clientWidth),
        scrub: true,
        pin: true,
      },
    });
  }
}

export default HorizontalScroll;
