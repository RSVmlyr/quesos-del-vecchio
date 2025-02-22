import { gsap } from 'gsap';

class Loader {
  constructor(params) {
    this.componentsLength = params.componentsLength;
    this.loadedComponents = 0;
    // Define weights: components 90%, page load 10%
    this.componentsWeight = 0.9;
    this.pageWeight = 0.1;
    this.pageLoaded = false;
    this.percentage = 0;
    this.completeDelay = 1.5;

    this.loaderDOM = document.querySelector('[data-loader]');
    this.percentageDOM = document.querySelector('[data-loader-percentage]');
  }

  run() {
    console.log('Loader started');
    // Optionally, start an animation here (e.g., fade in the loader)
  }

  close() {
    console.log('Loader closed');
    // Animate out and hide the loader (using gsap for a smooth transition)
    if (this.loaderDOM) {
      gsap.to(this.loaderDOM, {
        opacity: 0,
        duration: 0.5,
        onComplete: () => {
          this.loaderDOM.style.display = 'none';
        },
      });
    }
  }

  updatePercentage() {
    // Calculate target percentage based on components and page load
    const componentsProgress = (this.loadedComponents / this.componentsLength) * 100 * this.componentsWeight;
    const pageProgress = this.pageLoaded ? this.pageWeight * 100 : 0;
    const targetPercentage = Math.round(componentsProgress + pageProgress);

    // Animate the change from current percentage to targetPercentage gradually
    gsap.to(this, {
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
            this.percentageDOM.innerText = 'Loaded! Enjoy!';
          }

          gsap.delayedCall(this.completeDelay, () => {
            this.close();
          });
        }
      },
    });
  }

  onComponentLoaded() {
    this.loadedComponents++;
    this.updatePercentage();
  }

  onPageLoaded() {
    this.pageLoaded = true;
    this.updatePercentage();
  }
}

export default Loader;
