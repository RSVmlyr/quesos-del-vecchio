import { addClickEventListener } from '../utils/listeners';
import Tingle from 'tingle.js';
import 'tingle.js/dist/tingle.min.css';

const CLASSNAMES = {
  BUTTON_NEXT_SECTION: '.product-hero__next-button',
  BUTTON_NUTRITIONAL: '.product-hero__nutritional-button',
  NUTRITIONAL_CONTENT: '.product-hero__nutritional-content',
  NUTRITIONAL_CLOSE: '.product-hero__nutritional-close',
};

class ProductHero {
  constructor(app, container) {
    this.app = app;
    this.container = container;
    this.modal = new Tingle.modal({
      footer: true,
      closeMethods: ['overlay', 'escape'],
      closeLabel: 'Cerrar',
      cssClass: ['occasions-hero__modal'],
    });

    this.nutritionalContent = container.querySelector(CLASSNAMES.NUTRITIONAL_CONTENT);
    this.nutritionalButton = container.querySelector(CLASSNAMES.BUTTON_NUTRITIONAL);
    this.nutritionalClose = container.querySelector(CLASSNAMES.NUTRITIONAL_CLOSE);
    addClickEventListener(this.nutritionalButton, this.toggleNutritionalInfo.bind(this));
    this.modal.setContent(this.nutritionalContent.innerHTML);
    this.modal.addFooterBtn(this.nutritionalClose.innerHTML, 'product-hero__nutritional-close', () => {
      this.modal.close();
    });

    this.nextButton = container.querySelector(CLASSNAMES.BUTTON_NEXT_SECTION);
    addClickEventListener(this.nextButton, this.goToNextSection.bind(this));
  }

  goToNextSection() {
    let nextSection = this.container.nextElementSibling;

    if (nextSection.tagName === 'LINK' || !nextSection) {
      nextSection = nextSection.nextElementSibling;
    }

    if (nextSection) {
      window.scrollTo({
        top: nextSection.offsetTop,
        left: 0,
        behavior: 'smooth',
      });
    }
  }

  toggleNutritionalInfo() {
    this.modal.open();
  }
}

export default ProductHero;
