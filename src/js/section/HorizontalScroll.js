const CLASSNAMES = {
  WRAPPER_CONTAINER: '.horizontal-scroll__wrapper-container',
  WRAPPER: '.horizontal-scroll__wrapper',
  SECTION: '.horizontal-scroll__section',
};

class HorizontalScroll {
  constructor(app, container) {
    this.app = app;
    this.header = app.header;
    this.container = container;
    this.wrapperContainer = this.container.querySelector(CLASSNAMES.WRAPPER_CONTAINER);
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
        trigger: this.wrapperContainer,
        start: 'top top',
        end: () => '+=' + (this.wrapper.scrollWidth - document.documentElement.clientWidth),
        scrub: true,
        pin: true,
        pinSpacing: true,
        onRefresh: (self) => {
          // Force a recalculation of positions
          self.refresh();
        },
        onEnter: () => {
          this.header.setHeaderLight();
        },
        onLeave: () => {
          this.header.resetHeader();
        },
        onEnterBack: () => {
          this.header.setHeaderLight();
        },
        onLeaveBack: () => {
          this.header.resetHeader();
        },
      },
    });
  }
}

export default HorizontalScroll;
