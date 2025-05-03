import { mediaQueryHook } from '../utils/mediaQuery';

const CLASSNAMES = {
  OCCASION_TRIGGER: '.occasions-hero__trigger',
  OCCASION_IMAGE: '.occasions-hero__image',

  OCCASION_DESCRIPTION: '.occasions-hero__description',
  OCCASION_DESCRIPTION_TITLE: '.occasions-hero__description-title',
  OCCASION_DESCRIPTION_TEXT: '.occasions-hero__description-text',

  OCCASION_MENU: '.occasions-hero__menu',
  OCCASION_MENU_BUTTON: '.occasions-hero__menu-button',
  OCCASION_MENU_ITEM: '.occasions-hero__menu-item',
  OCCASION_MENU_ITEM_TEXT: '.occasions-hero__menu-item-text',
};

class OccasionsHero {
  constructor(app, container) {
    this.app = app;
    this.container = container;
    this.animations = this.app.animations;

    // Animation elements
    this.description = container.querySelector(CLASSNAMES.OCCASION_DESCRIPTION);
    this.descriptionTitle = this.description.querySelector(CLASSNAMES.OCCASION_DESCRIPTION_TITLE);
    this.descriptionText = this.description.querySelector(CLASSNAMES.OCCASION_DESCRIPTION_TEXT);

    this.animations.splitTextAnimation.set(this.descriptionTitle);
    this.animations.fadeInAnimation.set(this.descriptionText);

    this.menu = container.querySelector(CLASSNAMES.OCCASION_MENU);
    this.menuItems = this.menu.querySelectorAll(CLASSNAMES.OCCASION_MENU_ITEM_TEXT);
    this.menuMaxHeight = this.menu.offsetHeight;

    for (const item of this.menuItems) {
      this.animations.splitTextAnimation.set(item);
    }

    // Images
    this.images = container.querySelectorAll(CLASSNAMES.OCCASION_IMAGE);

    window.addEventListener('appLoaded', () => {
      this.setupTriggers();
    });
  }

  setupTriggers() {
    this.triggers = this.container.querySelectorAll(CLASSNAMES.OCCASION_TRIGGER);

    this.animations.splitTextAnimation.run(this.descriptionTitle, 0.5);
    this.animations.fadeInAnimation.run(this.descriptionText, 0.5);

    for (const item of this.menuItems) {
      this.animations.splitTextAnimation.run(item, 0.5);
    }

    for (const trigger of this.triggers) {
      const index = Number(trigger.dataset.index);

      const image = this.images[index];

      const timeline = window.$APP.gsap.timeline({
        scrollTrigger: {
          trigger: trigger,
          start: 'top center',
          end: 'bottom center',
          scrub: 1,
          onEnter: () => {
            if (index === 1) {
              this.animateDescription(true);
            }
            this.animateButton(index);
          },
          onEnterBack: () => {
            this.animateButton(index);
          },
          onLeaveBack: () => {
            if (index === 1) {
              this.animateDescription(false);
              this.animateButton(0);
            }
          },
        },
      });

      timeline.fromTo(
        image,
        { y: '100%' },
        {
          y: '0%',
          duration: 1,
          ease: 'none',
        }
      );
    }
  }

  async animateButton(activeIndex) {
    const isMobile = mediaQueryHook('(max-width: 1024px)');
    const menu = this.container.querySelector(CLASSNAMES.OCCASION_MENU);
    const menuOption = menu.children[activeIndex];

    for (const option of this.menu.children) {
      option.classList.remove('active');
    }
    menuOption.classList.add('active');

    if (isMobile) {
      return;
    }
  }

  animateDescription(isEnter) {
    if (isEnter) {
      this.animations.splitTextAnimation.runOut(this.descriptionTitle);
      this.animations.fadeInAnimation.runOut(this.descriptionText);

      const parentMenu = this.menu.parentElement;

      window.$APP.gsap.to(this.menu, {
        y: `${parentMenu.offsetHeight / -2 + this.menu.scrollHeight / 2}px`,
        maxHeight: this.menu.scrollHeight,
        duration: 0.5,
        ease: 'power3.inout',
      });
    } else {
      this.animations.splitTextAnimation.run(this.descriptionTitle, 0);
      this.animations.fadeInAnimation.run(this.descriptionText, 0);

      window.$APP.gsap.to(this.menu, {
        y: 0,
        maxHeight: this.menuMaxHeight,
        duration: 0.5,
        ease: 'power3.inout',
      });
    }
  }
}

export default OccasionsHero;
