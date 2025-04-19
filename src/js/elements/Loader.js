import { mediaQueryHook } from '../utils/mediaQuery';

class Loader {
  constructor(params) {
    this.app = params.app;
    this.gsapLibrary = this.app.gsap;
    this.sectionsLength = Math.max(params.sectionsLength, 1);
    this.loadedSections = 0;
    this.loadedSectionInstances = new Set();
    // Define weights: components 90%, page load 10%
    this.sectionsWeight = 0.9;
    this.pageWeight = 0.1;
    this.pageLoaded = false;
    this.percentage = 0;
    this.completeDelay = 1.5;

    this.isMobile = mediaQueryHook('(max-width: 1024px)');

    this.loaderDOM = document.querySelector('[data-loader]');
    this.loaderContentDOM = document.querySelector('[data-loader-content]');
    this.percentageDOM = document.querySelector('[data-loader-percentage]');
    this.phraseDOM = document.querySelector('[data-loader-phrase]');
    this.loaderWrapTopDOM = document.querySelector('[data-loader-wrap-top]');
    this.loaderWrapBottomDOM = document.querySelector('[data-loader-wrap-bottom]');

    // Initial fade-in animation
    this.gsapLibrary.to(this.loaderContentDOM, {
      opacity: 1,
      duration: 0.5,
      ease: 'power2.out',
    });

    // Get all internal links that don't have target="_blank" and don't have a hash
    const internalLinks = document.querySelectorAll('a:not([target="_blank"]):not([href*="#"])');

    // Add click event listeners to each link
    internalLinks.forEach((link) => {
      link.addEventListener('click', (e) => {
        if (link.hostname !== window.location.hostname) {
          return;
        }

        e.preventDefault();
        this.showForTransition(link.href);
      });
    });
  }

  showForTransition(nextPageUrl) {
    const tl = this.gsapLibrary.timeline();

    const height = this.isMobile ? '5vh' : '20vh';

    tl.fromTo(
      this.loaderDOM,
      {
        duration: 0.5,
        ease: 'power4.inOut',
        y: '100%',
      },
      {
        y: '0%',
        onComplete: () => {
          window.location.href = nextPageUrl;
        },
      },
      0
    );

    tl.to(
      this.loaderWrapTopDOM,
      {
        duration: 0.5,
        ease: 'power4.inOut',
        height,
      },
      0
    );
  }

  close() {
    if (this.loaderDOM) {
      // Dispatch custom event when isLoaded becomes true
      window.dispatchEvent(new Event('appLoaded'));

      const tl = this.gsapLibrary.timeline();

      tl.to(
        this.loaderDOM,
        {
          duration: 0.75,
          ease: 'power4.inOut',
          y: '-100%',
          onComplete: () => {
            document.body.classList.remove('disabled');
            document.body.classList.remove('app-loading');

            this.gsapLibrary.killTweensOf(this.loaderDOM);
            this.loaderDOM.classList.add('loader_component--bottom-to-top');
          },
        },
        0
      );

      tl.to(
        this.loaderContentDOM,
        {
          duration: 0.5,
          ease: 'power4.inOut',
          opacity: 0,
        },
        0
      );

      tl.to(
        this.loaderWrapBottomDOM,
        {
          delay: 0.2,
          duration: 0.75,
          ease: 'power4.inOut',
          height: '0',
        },
        0
      );
    }
  }

  updatePercentage() {
    // Calculate target percentage based on components and page load
    const sectionsProgress = (this.loadedSections / this.sectionsLength) * 100 * this.sectionsWeight;
    const pageProgress = this.pageLoaded ? this.pageWeight * 100 : 0;
    const targetPercentage = Math.round(sectionsProgress + pageProgress);

    // Animate the change from current percentage to targetPercentage gradually
    this.gsapLibrary.to(this, {
      duration: 0.5, // Adjust duration as needed
      percentage: targetPercentage,
      ease: 'power1.out',
      onUpdate: () => {
        // Update the DOM on every animation tick
        if (this.percentageDOM) {
          this.percentageDOM.innerText = `${Math.round(this.percentage)}%`;
        }
      },
      onComplete: () => {
        // Once we reach 100%, close the loader
        if (Math.round(this.percentage) >= 100) {
          // Update text with final phrase
          if (this.percentageDOM) {
            this.percentageDOM.style.opacity = '0';
          }

          if (this.phraseDOM) {
            this.gsapLibrary.to(this.phraseDOM, {
              opacity: 1,
              y: 0,
              duration: 0.8,
            });
          }

          this.gsapLibrary.delayedCall(this.completeDelay, () => {
            this.close();
          });
        }
      },
    });
  }

  onSectionLoaded(sectionId) {
    // Only increment if we haven't seen this section instance before
    if (!this.loadedSectionInstances.has(sectionId)) {
      this.loadedSectionInstances.add(sectionId);
      this.loadedSections = Math.min(this.loadedSections + 1, this.sectionsLength);
      this.updatePercentage();
    }
  }

  onPageLoaded() {
    this.pageLoaded = true;
    this.updatePercentage();
  }
}

export default Loader;
