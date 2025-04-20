const CLASSNAMES = {
  TEXT: '.animate-text__paragraph',
};

class AnimateText {
  constructor(app, container) {
    this.app = app;
    this.container = container;

    this.text = this.container.querySelector(CLASSNAMES.TEXT);

    this.splitText = window.$APP.SplitType.create(this.text, {
      types: 'lines, words',
      lineClass: 'animate-text__line',
      wordClass: 'animate-text__word',
    });

    if (this.splitText.lines.length > 0) {
      for (const line of this.splitText.lines) {
        const words = line.querySelectorAll('.animate-text__word');
        if (words.length > 0) {
          this.initAnimation(line, words);
        }
      }
    }
  }

  initAnimation(line, words) {
    window.$APP.gsap.to(words, {
      ease: 'power1.out',
      opacity: 1,
      duration: 0.7,
      stagger: 0.2,
      scrollTrigger: {
        trigger: line,
        start: `top 70%`,
        onRefresh: (self) => {
          // Force a recalculation of positions
          self.refresh();
        },
      },
    });
  }
}

export default AnimateText;
