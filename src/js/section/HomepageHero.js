import { addClickEventListener } from '../utils/listeners';
import { mediaQueryHook } from '../utils/mediaQuery';

const CLASSNAMES = {
  MAIN_BACKGROUND: '.homepage-hero__background',
};

class HomepageHero {
  constructor(app, container) {
    this.app = app;
    this.container = container;

    this.mainBackground = this.container.querySelector(CLASSNAMES.MAIN_BACKGROUND);

    addClickEventListener(this.mainBackground, this.handleMainBackgroundClick.bind(this));
  }

  handleMainBackgroundClick() {
    const tl = this.app.gsap.timeline();

    tl.to(this.mainBackground, {
      duration: 1,
      ease: 'power4.inOut',
      clipPath: 'polygon(0% 0%, 100% 0%, 100% 0%, 0% 0%)',
    }).to(this.mainBackground, {
      duration: 0,
      display: 'none',
    });
  }
}

export default HomepageHero;
