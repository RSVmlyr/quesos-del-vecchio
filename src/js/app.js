// Set The Wordpress Template Path
__webpack_public_path__ = window.__webpack_public_path__;

import Swiper from 'swiper';
import { Pagination, Autoplay, Navigation } from 'swiper/modules';
import { gsap } from 'gsap';
import Loader from './elements/Loader';
import Header from './elements/Header';

// import Swiper styles
import 'swiper/css';

// Sections
const SECTIONS = ['HomepageHero'];

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
      sectionsLength: SECTIONS.length,
    });
    new Header(this);

    // Init loading
    this._init();
  }

  async _init() {
    this.loader.onSectionLoaded('app-init');
    this._runSections();
  }

  _runSections() {
    if (!SECTIONS.length) return null;

    SECTIONS.forEach((section) => {
      // Get DOM elements
      const htmlContainers = document.querySelectorAll(`[data-section="${section}"]`);
      if (!!htmlContainers.length) this._loadSection(section, htmlContainers);
    });
  }

  async _loadSection(ClassSectionName, htmlContainers) {
    // Dynamic component import
    const { default: ClassSection } = await import(`./section/${ClassSectionName}`);
    this.loader.onSectionLoaded(ClassSectionName);
    htmlContainers.forEach((container) => {
      new ClassSection(this, container);
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
