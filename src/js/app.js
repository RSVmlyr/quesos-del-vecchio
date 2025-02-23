// Set The Wordpress Template Path
__webpack_public_path__ = window.__webpack_public_path__;

import Swiper from 'swiper';
import { Pagination, Autoplay, Navigation } from 'swiper/modules';
import { gsap } from 'gsap';
import { Header } from './lib';
import Loader from './elements/Loader';

// import Swiper styles
import 'swiper/css';

// Components
const COMPONENTS = [];

class App {
  constructor() {
    window.$APP = this;

    // Aplication state
    this.isBackdropOpen = false;

    // Set Main Dependencies to Global State
    window.$APP.gsap = gsap;

    window.$APP.Swiper = Swiper;
    window.$APP.Swiper.Pagination = Pagination;
    window.$APP.Swiper.Autoplay = Autoplay;
    window.$APP.Swiper.Navigation = Navigation;

    // Mandatory instances
    this.loader = new Loader({
      libraries: {
        gsap,
      },
      componentsLength: COMPONENTS.length,
    });

    // Init loading
    this._init();
  }

  async _init() {
    this.loader.onComponentLoaded();
    this._runComponents();
  }

  _runComponents() {
    if (!COMPONENTS.length) return null;

    COMPONENTS.forEach((Component) => {
      // Get DOM elements
      const htmlContainers = document.querySelectorAll(`[data-component="${Component}"]`);
      if (!!htmlContainers.length) this._loadComponent(Component, htmlContainers);
    });
  }

  async _loadComponent(ClassComponentName, htmlContainers) {
    // Dynamic component import
    const { default: ClassComponent } = await import(`./components/${ClassComponentName}`);
    this.loader.onComponentLoaded();
    htmlContainers.forEach((container) => {
      new ClassComponent(this, container);
    });
  }
}

////////////////////
// Run app
////////////////////
new App();

// Listen for the complete page load (all assets)
window.addEventListener('load', () => {
  // This call informs the Loader that the entire page is loaded.
  window.$APP.loader.onPageLoaded();
});
