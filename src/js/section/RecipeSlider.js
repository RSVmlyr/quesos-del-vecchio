import EmblaCarousel from 'embla-carousel';

const CLASSNAMES = {
  SLIDER_CONTAINER: '.recipe-slider__swiper',
};

class RecipeSlider {
  constructor(app, container) {
    this.app = app;
    this.container = container;
    this.embla = null;

    // Slider container
    this.sliderContainer = container.querySelector(CLASSNAMES.SLIDER_CONTAINER);

    // Listen for appLoaded event
    this.initCarousel();
  }

  initCarousel() {
    // Initialize Embla Carousel
    this.embla = EmblaCarousel(this.sliderContainer, {
      loop: true,
      align: 'center',
      containScroll: 'trimSnaps',
      slidesToScroll: 1,
    });

    this.calculateHeight();
    this.embla.on('select', this.highlightCenterAndSiblings.bind(this));
    this.highlightCenterAndSiblings();
  }

  highlightCenterAndSiblings() {
    const index = this.embla.selectedScrollSnap(); // center slide index
    const slides = this.embla.slideNodes(); // all slides

    // Reset all classes
    slides.forEach((slide) => {
      slide.classList.remove('is-active', 'is-prev', 'is-next');
    });

    // Add active class to center slide
    const active = slides[index];
    const prevSlide = slides[index - 1] || slides[slides.length - 1];
    const nextSlide = slides[index + 1] || slides[0];

    active.classList.add('is-active');
    prevSlide.classList.add('is-prev');
    nextSlide.classList.add('is-next');
  }

  calculateHeight() {
    const slides = this.embla.slideNodes(); // all slides
    let maxHeight = 0;

    slides.forEach((slide) => {
      const height = slide.offsetHeight;
      slide.style.setProperty('--height', height + 'px');

      if (height > maxHeight) {
        maxHeight = height;
      }
    });

    this.sliderContainer.style.setProperty('--max-height', maxHeight + 190 + 'px');
  }
}

export default RecipeSlider;
