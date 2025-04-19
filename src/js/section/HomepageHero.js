import { addClickEventListener } from '../utils/listeners';
import { mediaQueryHook } from '../utils/mediaQuery';
const CLASSNAMES = {
  MAIN_BACKGROUND: '.homepage-hero__background',
  MAIN_BACKGROUND_CURSOR: '.homepage-hero__background-cursor',
  TITLES: '.homepage-hero__title',
  SECTIONS: '.homepage-hero__link',
};

class HomepageHero {
  constructor(app, container) {
    this.app = app;
    this.animations = app.animations;
    this.container = container;

    this.isMobile = mediaQueryHook('(max-width: 1024px)');
    this.mainBackground = this.container.querySelector(CLASSNAMES.MAIN_BACKGROUND);
    this.mainBackgroundCursor = this.container.querySelector(CLASSNAMES.MAIN_BACKGROUND_CURSOR);
    this.titles = this.container.querySelectorAll(CLASSNAMES.TITLES);
    this.sections = this.container.querySelectorAll(CLASSNAMES.SECTIONS);

    for (const title of this.titles) {
      this.animations.splitTextAnimation.set(title);
    }

    for (const section of this.sections) {
      const text = section.querySelector(CLASSNAMES.TITLES);

      // Hover animation
      section.addEventListener('mouseenter', () => {
        if (this.isMobile) return;
        this.handleSectionHover(text);
      });

      section.addEventListener('mouseleave', () => {
        if (this.isMobile) return;
        this.handleSectionLeave(text);
      });
    }

    addClickEventListener(this.mainBackground, this.handleMainBackgroundClick.bind(this));
  }

  handleMainBackgroundClick() {
    const tl = this.app.gsap.timeline();

    if (this.isMobile) {
      for (const title of this.titles) {
        this.animations.splitTextAnimation.run(title, 0.5);
      }
    }

    tl.to(this.mainBackground, {
      duration: 1,
      ease: 'power4.inOut',
      clipPath: 'polygon(0% 0%, 100% 0%, 100% 0%, 0% 0%)',
    }).to(this.mainBackground, {
      duration: 0,
      display: 'none',
    });
  }

  handleSectionHover(text) {
    if (this.isMobile) return;
    this.animations.splitTextAnimation.run(text, 0);
  }

  handleSectionLeave(text) {
    if (this.isMobile) return;
    this.animations.splitTextAnimation.reset(text);
  }
}

export default HomepageHero;
