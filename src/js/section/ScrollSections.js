import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const CLASSNAMES = {
  TITLE: '.title-animation',
  TITLE_CONTAINER: '.title-container',
  SECTIONS_CONTAINER: '.sections-container',
  SECTIONS: '.scroll-section',
};

export default class ScrollSections {
  constructor(app, container) {
    this.app = app;
    this.container = container;

    this.title = container.querySelector(CLASSNAMES.TITLE);
    this.titleContainer = container.querySelector(CLASSNAMES.TITLE_CONTAINER);
    this.sectionsContainer = container.querySelector(CLASSNAMES.SECTIONS_CONTAINER);
    this.sections = container.querySelectorAll(CLASSNAMES.SECTIONS);

    this.init();
  }

  init() {
    // Create main timeline for the entire section
    this.createMainTimeline();
  }

  createMainTimeline() {
    // Create master timeline
    const masterTl = gsap.timeline({
      scrollTrigger: {
        trigger: this.container,
        start: 'top top',
        end: `+=${this.sections.length * 100 + 50}vh`, // Add extra space for smoother scrolling
        scrub: 0.3, // Smooth scrubbing for more natural movement
        pin: true,
        anticipatePin: 1,
      },
    });

    // Set initial states
    this.setInitialStates();

    // Add title animation
    const titleTl = this.createTitleAnimation();
    masterTl.add(titleTl);

    // Add first section animation
    const firstSectionTl = this.createFirstSectionAnimation();
    masterTl.add(firstSectionTl);

    // Add remaining sections animations
    for (let i = 1; i < this.sections.length; i++) {
      const sectionTl = this.createSectionAnimation(this.sections[i], i);
      masterTl.add(sectionTl);
    }
  }

  setInitialStates() {
    // Initial state for the entire sections container
    gsap.set(this.sectionsContainer, { autoAlpha: 0 });

    // Set initial states for all sections
    this.sections.forEach((section, index) => {
      const img = section.querySelector('figure');
      const text = section.querySelector('.text-blue');
      const sectionNumber = section.querySelector('.section-number');

      // All sections start hidden
      gsap.set(section, {
        autoAlpha: 0,
        zIndex: 10 + (this.sections.length - index), // Ensure proper stacking order from the start
      });

      // All images start below the viewport
      gsap.set(img, {
        y: '100vh',
        transformOrigin: 'center center',
        zIndex: 10 + (this.sections.length - index),
        scale: 1,
      });

      // Hide text initially
      gsap.set(text, { autoAlpha: 0 });

      if (sectionNumber) {
        gsap.set(sectionNumber, { autoAlpha: 0 });
      }
    });
  }

  createTitleAnimation() {
    const tl = gsap.timeline();

    // Start with title centered
    tl.set(this.title, { scale: 1, opacity: 1 });

    // Animate title to top while increasing size and reducing opacity
    tl.to(this.title, {
      scale: 1.8,
      opacity: 0.3,
      y: '-40vh',
      duration: 1,
      ease: 'power2.inOut',
    });

    // Fade in sections container after title animation
    tl.to(this.sectionsContainer, { autoAlpha: 1, duration: 0.5 }, '-=0.3');

    return tl;
  }

  createFirstSectionAnimation() {
    const tl = gsap.timeline();
    const section = this.sections[0];
    const img = section.querySelector('figure');
    const text = section.querySelector('.text-blue');
    const sectionNumber = section.querySelector('.section-number');

    // Show first section
    tl.to(section, {
      autoAlpha: 1,
      duration: 0.5,
      ease: 'power1.inOut',
    });

    // Bring in the image with a smooth animation
    tl.to(
      img,
      {
        y: 0,
        duration: 1.2,
        ease: 'power3.out',
      },
      '-=0.3'
    );

    // Fade in text and number with slight delay for natural flow
    tl.to(
      text,
      {
        autoAlpha: 1,
        duration: 0.8,
        ease: 'power2.inOut',
      },
      '-=0.7'
    );

    if (sectionNumber) {
      tl.to(
        sectionNumber,
        {
          autoAlpha: 1,
          duration: 0.8,
          ease: 'power2.inOut',
        },
        '-=0.8'
      );
    }

    // Add a slight pause
    tl.to({}, { duration: 0.5 });

    return tl;
  }

  createSectionAnimation(section, index) {
    const tl = gsap.timeline();
    const img = section.querySelector('figure');
    const text = section.querySelector('.text-blue');
    const sectionNumber = section.querySelector('.section-number');

    // Prepare previous sections for stacking
    for (let i = 0; i < index; i++) {
      const prevSection = this.sections[i];
      const prevImg = prevSection.querySelector('figure');
      const prevText = prevSection.querySelector('.text-blue');
      const prevNumber = prevSection.querySelector('.section-number');

      // Calculate how far back this should be (higher index = further back)
      const stackPosition = index - i;

      // Make sure older sections are moved back in z-space
      // Important: Move the image first, then fade text - more natural transition
      tl.to(
        prevImg,
        {
          y: -15 * stackPosition,
          x: -10 * stackPosition,
          z: -40 * stackPosition,
          scale: 0.97 - stackPosition * 0.02,
          zIndex: 10 + (this.sections.length - i),
          boxShadow: '0 5px 15px rgba(0,0,0,0.1)',
          duration: 0.9,
          ease: 'power2.inOut',
        },
        0
      ); // Use absolute position to start all these animations together

      // Fade out text of previous sections
      tl.to(
        prevText,
        {
          autoAlpha: 0,
          duration: 0.6,
          ease: 'power2.inOut',
        },
        0
      );

      if (prevNumber) {
        tl.to(
          prevNumber,
          {
            autoAlpha: 0,
            duration: 0.6,
            ease: 'power2.inOut',
          },
          0
        );
      }
    }

    // Show current section
    tl.to(
      section,
      {
        autoAlpha: 1,
        zIndex: 100, // Make sure current section is always on top
        duration: 0.7,
        ease: 'power1.inOut',
      },
      0.3
    ); // Slight delay for more natural sequence

    // Bring in the image with a smooth animation
    tl.to(
      img,
      {
        y: 0,
        x: 0,
        z: 0,
        scale: 1,
        duration: 1.2,
        zIndex: 100,
        ease: 'power3.out',
      },
      0.4
    );

    // Fade in text and number with slight delay
    tl.to(
      text,
      {
        autoAlpha: 1,
        duration: 0.8,
        ease: 'power2.inOut',
      },
      0.8
    );

    if (sectionNumber) {
      tl.to(
        sectionNumber,
        {
          autoAlpha: 1,
          duration: 0.8,
          ease: 'power2.inOut',
        },
        0.8
      );
    }

    // Add a pause between sections
    tl.to({}, { duration: 0.8 });

    return tl;
  }
}
