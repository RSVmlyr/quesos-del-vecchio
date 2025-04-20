import { mediaQueryHook } from '../utils/mediaQuery';

const CLASSNAMES = {
  OCCASION_TRIGGER: '.occasions-hero__trigger',
  OCCASION_IMAGE: '.occasions-hero__image',

  OCCASION_DESCRIPTION: '.occasions-hero__description',
  OCCASION_MENU: '.occasions-hero__menu',
  OCCASION_MENU_BUTTON: '.occasions-hero__menu-button',
  OCCASION_MENU_ITEM: '.occasions-hero__menu-item',
};

class OccasionsHero {
  constructor(app, container) {
    this.app = app;
    this.container = container;

    // Animation elements
    this.description = container.querySelector(CLASSNAMES.OCCASION_DESCRIPTION);
    this.menu = container.querySelector(CLASSNAMES.OCCASION_MENU);
    this.menuButton = container.querySelector(CLASSNAMES.OCCASION_MENU_BUTTON);

    // Images
    this.images = container.querySelectorAll(CLASSNAMES.OCCASION_IMAGE);

    this.setupTriggers();
  }

  setupTriggers() {
    this.triggers = this.container.querySelectorAll(CLASSNAMES.OCCASION_TRIGGER);

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
    const menuOptionLink = menuOption.querySelector('a').href;
    const menuButtonElement = this.menuButton.querySelector('a');

    for (const option of this.menu.children) {
      option.classList.remove('active');
    }

    menuButtonElement.href = menuOptionLink;
    menuOption.classList.add('active');

    if (isMobile) {
      return;
    }

    const menuButtonWidth = this.menuButton.offsetWidth;
    const menuOptionWidth = menuOption.offsetWidth;
    const menuOptionYPosition = menuOption.offsetTop;
    const threshold = 20;

    window.$APP.gsap.to(this.menuButton, {
      y: `${menuOptionYPosition - threshold}px`,
      x: `${menuOptionWidth - menuButtonWidth / 4}px`,
      duration: 0.5,
      ease: 'power3.inout',
    });
  }

  animateDescription(isEnter) {
    if (isEnter) {
      const parentDescription = this.description.parentElement;
      // Get the padding of the parent element
      const parentDescriptionPadding = window.getComputedStyle(parentDescription).paddingLeft.replace('px', '');
      const parentDescriptionWidth = parentDescription.offsetWidth - Number(parentDescriptionPadding) * 2;
      const descriptionElement = this.description;

      window.$APP.gsap.to(this.description, {
        x: `${(window.innerWidth - parentDescriptionWidth) / -2 - descriptionElement.offsetWidth}px`,
        duration: 0.5,
        ease: 'power3.inout',
        onComplete: () => {
          this.description.classList.add('disabled');
        },
      });

      const parentMenu = this.menu.parentElement;

      window.$APP.gsap.to(this.menu, {
        y: `${parentMenu.offsetHeight / -2 + this.menu.offsetHeight / 2}px`,
        duration: 0.5,
        ease: 'power3.inout',
      });
    } else {
      window.$APP.gsap.to(this.description, {
        x: 0,
        duration: 0.5,
        ease: 'power3.inout',
        onComplete: () => {
          this.description.classList.remove('disabled');
        },
      });

      window.$APP.gsap.to(this.menu, {
        y: 0,
        duration: 0.5,
        ease: 'power3.inout',
      });
    }
  }
}

export default OccasionsHero;
