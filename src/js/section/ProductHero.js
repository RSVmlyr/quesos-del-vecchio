import { addClickEventListener } from '../utils/listeners';

const CLASSNAMES = {
  BUTTON_NEXT_SECTION: '.product-hero__next-button',
};

class ProductHero {
  constructor(app, container) {
    this.app = app;
    this.container = container;

    this.nextButton = container.querySelector(CLASSNAMES.BUTTON_NEXT_SECTION);
    addClickEventListener(this.nextButton, this.goToNextSection.bind(this));
  }

  goToNextSection() {
    // TODO: Fix link tag
    const nextSection = this.container.nextElementSibling;

    if (nextSection) {
      window.scrollTo({
        top: nextSection.offsetTop,
        left: 0,
        behavior: 'smooth',
      });
    }
  }
}

export default ProductHero;
