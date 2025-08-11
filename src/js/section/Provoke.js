import Isotope from 'isotope-layout';
import IsotopeMasonryHorizontal from 'isotope-masonry-horizontal';

const CLASSNAMES = {
  WRAPPER: '.provoke__wrapper',
  SECTION: '.provoke__section',
  BUTTON: '.provoke__filter-button',
};

class Provoke {
  constructor(app, container) {
    this.app = app;
    this.container = container;

    this.wrapper = this.container.querySelector(CLASSNAMES.WRAPPER);
    this.sections = this.wrapper.querySelectorAll(CLASSNAMES.SECTION);
    this.buttons = this.container.querySelectorAll(CLASSNAMES.BUTTON);

    this.gap = 48; // This should match the gap-28 class value
    this.iso = null; // Store isotope instance
    this.scrollTrigger = null;
    this.init();
  }

  initScrollTrigger() {
    const wrapperWidth = this.container.querySelector(CLASSNAMES.WRAPPER).scrollWidth - document.documentElement.clientWidth + 'px';

    this.scrollTrigger = window.$APP.gsap.to(this.wrapper, {
      x: () => `-${wrapperWidth}`,
      ease: 'none',
      scrollTrigger: {
        trigger: this.container,
        start: 'top top',
        end: () => '+=' + wrapperWidth,
        scrub: true,
        pin: true,
        pinSpacing: true,
        onRefresh: (self) => {
          // Force a recalculation of positions
          // self.refresh();
          // Force isotope layout refresh too
          // if (this.iso) {
          //   this.iso.layout();
          // }
        },
      },
    });
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
      // Use Isotope's built-in random sorting
      sortBy: 'random',
    });

    this.buttons.forEach((button) => {
      button.addEventListener('click', (e) => {
        e.preventDefault();

        // Cambiar el atributo data-filter del section a "true"
        this.container.setAttribute('data-filter', 'true');

        // Marcar el botón activo y desactivar los demás
        this.buttons.forEach(btn => {
          btn.setAttribute('data-active', 'false');
        });
        button.setAttribute('data-active', 'true');

        this.filterSections(e.target.dataset.filter);
      });
    });

    this.initScrollTrigger();

    this.setPositionClasses(this.iso.filteredItems);

    this.iso.on('arrangeComplete', (items) => {
      this.scrollTrigger.scrollTrigger.kill();
      this.initScrollTrigger();
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

  filterSections(filter) {
    let filterBy = '';

    switch (filter) {
      case 'recetas':
        filterBy = '.provoke__section--recipe, .provoke__section--placeholder';
        break;
      case 'blogs':
        filterBy = '.provoke__section--article, .provoke__section--placeholder';
        break;
      case 'productos':
        filterBy = '.provoke__section--product, .provoke__section--placeholder';
        break;
      case 'media':
        filterBy = '.provoke__section--video, .provoke__section--social-media, .provoke__section--placeholder';
        break;
    }

    this.iso.arrange({
      filter: filterBy,
    });

    this.setPositionClasses(this.iso.filteredItems);

    // Asignar clases de rotación a las cards de recetas filtradas
    if (filter === 'recetas') {
      const recipeCards = this.iso.filteredItems.filter(item => item.element.classList.contains('provoke__section--recipe'));
      recipeCards.forEach((item, idx) => {
        // Eliminar clases previas
        for (let i = 1; i <= 4; i++) {
          item.element.classList.remove(`provoke__section--recipe-rotate-${i}`);
        }
        // Asignar nueva clase
        const rotateClass = `provoke__section--recipe-rotate-${(idx % 4) + 1}`;
        item.element.classList.add(rotateClass);
      });
      // Eliminar clases de productos
      this.sections.forEach(section => {
        for (let i = 1; i <= 4; i++) {
          section.classList.remove(`provoke__section--product-rotate-${i}`);
        }
      });
    } else if (filter === 'productos') {
      const productCards = this.iso.filteredItems.filter(item => item.element.classList.contains('provoke__section--product'));
      productCards.forEach((item, idx) => {
        // Eliminar clases previas
        for (let i = 1; i <= 4; i++) {
          item.element.classList.remove(`provoke__section--product-rotate-${i}`);
        }
        // Asignar nueva clase
        const rotateClass = `provoke__section--product-rotate-${(idx % 4) + 1}`;
        item.element.classList.add(rotateClass);
      });
      // Eliminar clases de recetas
      this.sections.forEach(section => {
        for (let i = 1; i <= 4; i++) {
          section.classList.remove(`provoke__section--recipe-rotate-${i}`);
        }
      });
    } else {
      // Si no es recetas ni productos, eliminar las clases de rotación de ambos
      this.sections.forEach(section => {
        for (let i = 1; i <= 4; i++) {
          section.classList.remove(`provoke__section--recipe-rotate-${i}`);
          section.classList.remove(`provoke__section--product-rotate-${i}`);
        }
      });
    }
  }
}

export default Provoke;
