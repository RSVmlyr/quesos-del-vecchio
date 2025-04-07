import EmblaCarousel from 'embla-carousel';
import { addClickEventListener } from '../utils/listeners';
const CLASSNAMES = {
  SLIDER_CONTAINER: '.recipe-slider__container',
  VIEWPORT: '.recipe-slider__embla_viewport',
  NEXT_BUTTON: '.recipe-slider__button--next',
  PREV_BUTTON: '.recipe-slider__button--prev',
  PROGRESS_BAR: '.recipe-slider__progress',
  SLIDE_COUNT: '.recipe-slider__current-count',
};

class RecipeSlider {
  constructor(app, container) {
    this.app = app;
    this.container = container;
    this.embla = null;

    // Slider container
    this.sliderContainer = container.querySelector(CLASSNAMES.SLIDER_CONTAINER);
    this.viewport = container.querySelector(CLASSNAMES.VIEWPORT);

    // Slider buttons
    this.nextButton = container.querySelector(CLASSNAMES.NEXT_BUTTON);
    this.prevButton = container.querySelector(CLASSNAMES.PREV_BUTTON);

    // Progress bar
    this.progressBar = container.querySelector(CLASSNAMES.PROGRESS_BAR);

    // Slide count
    this.slideCount = container.querySelector(CLASSNAMES.SLIDE_COUNT);

    // Listen for appLoaded event
    this.initCarousel();
  }

  initCarousel() {
    // Initialize Embla Carousel
    this.embla = EmblaCarousel(this.viewport, {
      loop: true,
      align: 'center',
      containScroll: 'trimSnaps',
      slidesToScroll: 1,
    });

    this.calculateHeight();
    this.embla.on('init', this.highlightCenterAndSiblings.bind(this));
    this.embla.on('init', this.updateSlideCount.bind(this));
    this.embla.on('init', this.applyProgress.bind(this));
    this.embla.on('scroll', this.applyProgress.bind(this));
    this.embla.on('select', this.highlightCenterAndSiblings.bind(this));
    this.embla.on('select', this.updateSlideCount.bind(this));

    // Add event listeners to buttons
    addClickEventListener(this.nextButton, this.nextSlide.bind(this));
    addClickEventListener(this.prevButton, this.prevSlide.bind(this));
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

  nextSlide() {
    this.embla.scrollNext();
  }

  prevSlide() {
    this.embla.scrollPrev();
  }

  applyProgress() {
    const currentSlide = this.embla.selectedScrollSnap();
    const totalSlides = this.embla.slideNodes().length;
    const progress = ((currentSlide + 1) / totalSlides) * 100;
    this.progressBar.style.setProperty('--progress-width', `${progress}%`);
  }

  updateSlideCount() {
    const currentSlide = this.embla.selectedScrollSnap() + 1;
    const count = currentSlide < 10 ? `0${currentSlide}` : currentSlide;
    this.slideCount.textContent = count;
  }
}

export default RecipeSlider;
