import Isotope from 'isotope-layout';
import IsotopeMasonryHorizontal from 'isotope-masonry-horizontal';

const CLASSNAMES = {
  WRAPPER: '.provoke__wrapper',
  SECTION: '.provoke__section',
};

class Provoke {
  constructor(app, container) {
    this.app = app;
    this.container = container;

    this.wrapper = this.container.querySelector(CLASSNAMES.WRAPPER);
    this.sections = this.wrapper.querySelectorAll(CLASSNAMES.SECTION);
    this.gap = 28; // This should match the gap-28 class value
    this.iso = null; // Store isotope instance
    this.init();
  }

  init() {
    // Store isotope instance for later use
    this.iso = new Isotope(this.wrapper, {
      // options
      itemSelector: '.provoke__section',
      layoutMode: 'masonryHorizontal',
      masonryHorizontal: {
        rowHeight: this.wrapper.offsetHeight / 4,
      },
    });

    // Make sure to use arrow function to keep "this" context
    this.iso.on('layoutComplete', (items) => {
      this.setPositionClasses(items);
    });

    // Set the wrapper width based on actual section widths
    // this.wrapper.style.width = `${this.calculateTotalWidth()}px`;
    window.$APP.gsap.to(this.wrapper, {
      x: () => -(this.wrapper.scrollWidth - document.documentElement.clientWidth) + 'px',
      ease: 'none',
      scrollTrigger: {
        trigger: this.container,
        start: 'top top',
        end: () => '+=' + (this.wrapper.scrollWidth - document.documentElement.clientWidth),
        scrub: true,
        pin: true,
        pinSpacing: true,
        onRefresh: (self) => {
          // Force a recalculation of positions
          self.refresh();
          // Force isotope layout refresh too
          if (this.iso) {
            this.iso.layout();
          }
        },
      },
    });
  }

  setPositionClasses(items) {
    const containerHeight = this.wrapper.offsetHeight;
    const threshold = containerHeight / 2;

    items.forEach((item) => {
      const element = item.element;
      const position = item.position;
      const y = position.y;

      // Remove existing position classes
      element.classList.remove('provoke__section--top', 'provoke__section--bottom');

      // Add appropriate position class
      if (y < threshold) {
        element.classList.add('provoke__section--top');
      } else {
        element.classList.add('provoke__section--bottom');
      }
    });
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
}

export default Provoke;
