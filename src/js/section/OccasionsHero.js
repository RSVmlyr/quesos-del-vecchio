import { mediaQueryHook } from '../utils/mediaQuery';

const CLASSNAMES = {
  SLIDER_CONTAINER: '.occasions-hero__swiper',
  SLIDER_TRIGGER: '.occasions-hero__trigger',

  OCCASION_DESCRIPTION: '.occasions-hero__description',
  OCCASION_MENU: '.occasions-hero__menu',
  OCCASION_MENU_BUTTON: '.occasions-hero__menu-button',
};

class OccasionsHero {
  constructor(app, container) {
    this.app = app;
    this.container = container;

    // Animation elements
    this.description = container.querySelector(CLASSNAMES.OCCASION_DESCRIPTION);
    this.menu = container.querySelector(CLASSNAMES.OCCASION_MENU);
    this.menuButton = container.querySelector(CLASSNAMES.OCCASION_MENU_BUTTON);

    // Slider container
    this.sliderContainer = container.querySelector(CLASSNAMES.SLIDER_CONTAINER);

    // Listen for appLoaded event
    window.addEventListener('appLoaded', () => {
      this.initSwiper();
    });
  }

  initSwiper() {
    this.swiper = new window.$APP.Swiper(this.sliderContainer, {
      direction: 'vertical',
      slidesPerView: 1,
      speed: 500,
      allowTouchMove: false,
      on: {
        init: (swiper) => {
          this.animateButton(swiper.activeIndex);
        },
        slideChange: (swiper) => {
          this.animateButton(swiper.activeIndex);

          if (swiper.activeIndex === 0) {
            this.animationEnter();
          } else {
            this.animationExit();
          }
        },
      },
    });

    this.setupTriggers();
  }

  setupTriggers() {
    this.triggers = this.container.querySelectorAll(CLASSNAMES.SLIDER_TRIGGER);

    for (const trigger of this.triggers) {
      window.$APP.gsap.timeline({
        scrollTrigger: {
          trigger: trigger,
          start: 'top bottom',
          end: 'bottom bottom',
          onEnter: (self) => {
            this.swiper.slideTo(parseInt(self.trigger.dataset.index));
          },
          onEnterBack: (self) => {
            this.swiper.slideTo(parseInt(self.trigger.dataset.index));
          },
        },
      });
    }
  }

  animationEnter() {
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

  animationExit() {
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
  }

  animateButton(activeIndex) {
    const isMobile = mediaQueryHook('(max-width: 1024px)');
    const menuOption = this.menu.children[activeIndex];

    for (const option of this.menu.children) {
      option.classList.remove('active');
    }

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
}

export default OccasionsHero;
