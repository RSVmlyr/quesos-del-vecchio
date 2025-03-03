class Loader {
  constructor(params) {
    this.gsapLibrary = params.libraries.gsap;
    this.sectionsLength = Math.max(params.sectionsLength, 1);
    this.loadedSections = 0;
    this.loadedSectionInstances = new Set();
    // Define weights: components 90%, page load 10%
    this.sectionsWeight = 0.9;
    this.pageWeight = 0.1;
    this.pageLoaded = false;
    this.percentage = 0;
    this.completeDelay = 1.5;

    this.loaderDOM = document.querySelector('[data-loader]');
    this.percentageDOM = document.querySelector('[data-loader-percentage]');
    this.phraseDOM = document.querySelector('[data-loader-phrase]');
  }

  close() {
    if (this.loaderDOM) {
      const tl = this.gsapLibrary.timeline();

      tl.to(this.loaderDOM, {
        duration: 1,
        ease: 'power4.inOut',
        clipPath: 'polygon(0% 0%, 100% 0%, 100% 0%, 0% 0%)',

        onComplete: () => {
          this.loaderDOM.style.display = 'none';
          document.body.classList.remove('disabled');
        },
      });
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
