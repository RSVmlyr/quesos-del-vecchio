// Set The Wordpress Template Path
__webpack_public_path__ = window.__webpack_public_path__;

import Swiper from 'swiper';
import { Navigation, Mousewheel, EffectCoverflow, Pagination } from 'swiper/modules';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Loader from './elements/Loader';
import Header from './elements/Header';
import Cursor from './elements/Cursor';
import ShareButton from './elements/ShareButton';
// import Swiper styles
import 'swiper/css';

// Sections
const SECTIONS = [
  'HomepageHero',
  'OccasionsSlider',
  'OccasionsHero',
  'VerticalSlider',
  'FourImagesSlider',
  'InstagramReels',
  'RecipeSlider',
  'ProductHero',
  'LocationsSlider',
  'Hotspots',
  'HorizontalScroll',
  'ScrollSections',
  'ArticleHero',
];

class App {
  constructor() {
    window.$APP = this;

    // Set Main Dependencies to Global State
    window.$APP.gsap = gsap;
    window.$APP.gsap.registerPlugin(ScrollTrigger);

    window.$APP.Swiper = Swiper;
    window.$APP.Swiper.Navigation = Navigation;
    window.$APP.Swiper.Mousewheel = Mousewheel;
    window.$APP.Swiper.EffectCoverflow = EffectCoverflow;
    window.$APP.Swiper.Pagination = Pagination;

    // Mandatory instances
    this.loader = new Loader({
      app: this,
      sectionsLength: SECTIONS.length,
    });
    new Header(this);
    new Cursor(this);
    new ShareButton(this);

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
      if (!!htmlContainers.length) {
        this._loadSection(section, htmlContainers);
      } else {
        // If no containers found, mark the section as loaded anyway
        this.loader.onSectionLoaded(section);
      }
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
