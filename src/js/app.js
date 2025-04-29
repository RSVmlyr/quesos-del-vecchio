// Set The Wordpress Template Path
__webpack_public_path__ = window.__webpack_public_path__;

import Swiper from 'swiper';
import { Navigation, Mousewheel, EffectCoverflow, Pagination, Autoplay, FreeMode } from 'swiper/modules';

import SplitType from 'split-type';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Loader from './elements/Loader';
import Header from './elements/Header';
import Cursor from './elements/Cursor';
import ShareButton from './elements/ShareButton';
import Animation from './elements/Animation';

// import Swiper styles
import 'swiper/css';

// Sections
const SECTIONS = [
  'HomepageHero',
  'OccasionsSlider',
  'OccasionsHero',
  'VerticalSlider',
  'InstagramReels',
  'RecipeSlider',
  'ProductHero',
  'LocationsSlider',
  'Hotspots',
  'HorizontalScroll',
  'ScrollSections',
  'ArticleHero',
  'AnimateText',
  'ContentSlider',
  'Gallery',
  'VerticalSliderLocations',
  'Locations',
  'Provoke',
];

class App {
  constructor() {
    window.$APP = this;

    // Set Main Dependencies to Global State
    window.$APP.gsap = gsap;
    window.$APP.gsap.ScrollTrigger = ScrollTrigger;
    window.$APP.gsap.registerPlugin(ScrollTrigger);

    window.$APP.Swiper = Swiper;
    window.$APP.Swiper.Navigation = Navigation;
    window.$APP.Swiper.Mousewheel = Mousewheel;
    window.$APP.Swiper.EffectCoverflow = EffectCoverflow;
    window.$APP.Swiper.Pagination = Pagination;
    window.$APP.Swiper.Autoplay = Autoplay;
    window.$APP.Swiper.FreeMode = FreeMode;

    window.$APP.SplitType = SplitType;

    // Mandatory instances
    this.animations = new Animation(this);
    this.loader = new Loader({
      app: this,
      sectionsLength: SECTIONS.length,
    });

    this.header = new Header(this);
    new Cursor(this);
    new ShareButton(this);

    // Init loading
    // this.animations.init();
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
