import { addClickEventListener } from '../utils/listeners';
import { mediaQueryHook } from '../utils/mediaQuery';

const CLASSNAMES = {
  HEADER: '#main-header',
  HAMBURGER: '.header_hamburger',
  NAV_MOBILE: '.header_mobile',
  SUB_MENUS: '.menu-item-has-children',
  SUB_MENU_OPEN: 'menu-item-has-children__open',
};

class Header {
  constructor(app) {
    this.app = app;
    this.isNavigationOpen = false;

    // Elements
    this.header = document.querySelector(CLASSNAMES.HEADER);
    this.hamburger = document.querySelector(CLASSNAMES.HAMBURGER);
    this.navMobile = document.querySelector(CLASSNAMES.NAV_MOBILE);
    this.subMenus = document.querySelectorAll(CLASSNAMES.SUB_MENUS);

    // Media Query
    this.isDesktop;
    this.minScreenSize = '(min-width: 1024px)';

    // Listen the screen size to modify accesibility values to navigations
    this.screenNavigationsHandler();
    window.addEventListener('resize', this.screenNavigationsHandler.bind(this));

    this.stickyHandler();
    window.addEventListener('scroll', this.stickyHandler.bind(this), { passive: true });

    addClickEventListener(this.hamburger, this.toggleMenu.bind(this));

    if (this.subMenus.length > 0) {
      for (const subMenu of this.subMenus) {
        addClickEventListener(subMenu, this.onClickSubmenHandler.bind(this));
        subMenu.addEventListener('mouseenter', this.onMouseEnterHandler);
        subMenu.addEventListener('mouseleave', this.onMouseLeaveHandler);
      }
    }
  }

  stickyHandler() {
    const currentScroll = document.scrollingElement ? document.scrollingElement.scrollTop : document.documentElement.scrollTop;

    if (currentScroll > 0) {
      this.header.classList.add('header__sticky');
    } else {
      this.header.classList.remove('header__sticky');
    }
  }

  toggleMenu() {
    if (this.isNavigationOpen) {
      document.body.classList.remove('disabled');
      this.header.classList.remove('header__nav_active');
      this.navMobile.classList.remove('header_mobile__active');
      this.navMobile.ariaDisabled = true;
    } else {
      document.body.classList.add('disabled');
      this.header.classList.add('header__nav_active');
      this.navMobile.classList.add('header_mobile__active');
      this.navMobile.ariaDisabled = false;
    }

    this.isNavigationOpen = !this.isNavigationOpen;
  }

  onClickSubmenHandler(e) {
    if (this.isDesktop) return null;

    const target = e.currentTarget;
    const subMenu = target.querySelector('.sub-menu');

    if (target.classList.contains(CLASSNAMES.SUB_MENU_OPEN)) {
      target.classList.remove(CLASSNAMES.SUB_MENU_OPEN);
      subMenu.style.maxHeight = null;
    } else {
      target.classList.add(CLASSNAMES.SUB_MENU_OPEN);
      subMenu.style.maxHeight = subMenu.scrollHeight + 'px';
    }
  }

  onMouseEnterHandler = (e) => {
    if (!this.isDesktop) return null;

    const target = e.currentTarget;
    const subMenu = target.querySelector('.sub-menu');

    target.classList.add(CLASSNAMES.SUB_MENU_OPEN);
    subMenu.style.maxHeight = subMenu.scrollHeight + 'px';
  };

  onMouseLeaveHandler = (e) => {
    if (!this.isDesktop) return null;

    const target = e.currentTarget;
    const subMenu = target.querySelector('.sub-menu');

    target.classList.remove(CLASSNAMES.SUB_MENU_OPEN);
    subMenu.style.maxHeight = null;
  };

  screenNavigationsHandler() {
    const isMediaMatch = mediaQueryHook(this.minScreenSize);
    this.isDesktop = isMediaMatch;
  }
}

export default Header;
