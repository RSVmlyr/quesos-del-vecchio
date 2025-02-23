import { addClickEventListener } from '../utils/listeners';
import { mediaQueryHook } from '../utils/mediaQuery';

const CLASSNAMES = {
  HEADER: '#main-header',
  NAV_MOBILE: '.header_navigation_mobile',
  NAV_DESKTOP: '.header_navigation_desktop',
  NAV_BUTTON: '.header_button',
};

class Header {
  constructor(app) {
    this.app = app;
    this.isNavigationOpen = false;

    // Elements
    this.header = document.querySelector(CLASSNAMES.HEADER);
    this.navigationMobile = document.querySelector(CLASSNAMES.NAV_MOBILE);
    this.navigationDesktop = document.querySelector(CLASSNAMES.NAV_DESKTOP);
    this.navigationButton = document.querySelector(CLASSNAMES.NAV_BUTTON);

    // Media Query
    this.isDesktop;
    this.minScreenSize = '(min-width: 1024px)';

    // Listen the screen size to modify accesibility values to navigations
    this.screenNavigationsHandler();
    window.addEventListener('resize', this.screenNavigationsHandler.bind(this));

    this.stickyHandler();
    window.addEventListener('scroll', this.stickyHandler.bind(this), { passive: true });

    addClickEventListener(this.navigationButton, this.toggleMenu.bind(this));
  }

  stickyHandler() {
    const currentScroll = document.scrollingElement ? document.scrollingElement.scrollTop : document.documentElement.scrollTop;

    if (currentScroll > 0) {
      this.header.classList.add('header--sticky');
    } else {
      this.header.classList.remove('header--sticky');
    }
  }

  toggleMenu() {
    if (this.isNavigationOpen) {
      document.body.classList.remove('disabled');

      this.navigationButton.classList.remove('header_button--active');
      this.header.classList.remove('header--active');
      this.navigationMobile.classList.remove('header_navigation_mobile--active');
    } else {
      document.body.classList.add('disabled');

      this.navigationButton.classList.add('header_button--active');
      this.header.classList.add('header--active');
      this.navigationMobile.classList.add('header_navigation_mobile--active');
    }

    this.isNavigationOpen = !this.isNavigationOpen;
  }

  screenNavigationsHandler() {
    const isMediaMatch = mediaQueryHook(this.minScreenSize);
    this.isDesktop = isMediaMatch;
  }
}

export default Header;
