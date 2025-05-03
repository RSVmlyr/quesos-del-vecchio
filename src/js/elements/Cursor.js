class Cursor {
  constructor() {
    this.cursor = document.querySelector('[data-custom-cursor]');

    // Cursor Label
    this.cursorLabel = this.cursor.querySelector('.custom-cursor-label');

    // Action Areas
    this.sections = document.querySelectorAll('[data-custom-cursor-area]');

    // Classes and Types
    this.cursorTypes = {
      CIRCLE: 'custom-cursor--circle',
      CTA: 'custom-cursor--cta',
      DEFAULT: 'custom-cursor--default',
    };

    this.showCursor = this.showCursor.bind(this);

    document.addEventListener('mousemove', this.setCursorMovement.bind(this));

    if (!!this.sections.length) {
      this.sections.forEach((section) => {
        section.addEventListener('mouseover', this.showCursor);
        section.addEventListener('mouseleave', this.hideCursor.bind(this));
      });
    }
  }

  setCursorMovement(e) {
    this.cursor.style.transform = `translate3d(calc(${e.clientX}px - 50%), calc(${e.clientY}px - 50%), 0) rotate(-12deg)`;
  }

  showCursor(event) {
    const elementOvered = event.currentTarget;
    const hasLabel = elementOvered.dataset?.customCursorLabel;
    const overType = elementOvered.dataset?.customCursorType;

    if (!elementOvered) return null;

    // Change the Cursor Label Text
    if (hasLabel || this.cursorLabel.innerText !== hasLabel) this.cursorLabel.innerText = hasLabel;

    if (overType === 'CIRCLE') {
      this.cursor.classList.add(this.cursorTypes[overType]);
    } else if (overType === 'CTA') {
      this.cursor.classList.add(this.cursorTypes[overType]);
    } else {
      this.cursor.classList.add(this.cursorTypes['DEFAULT']);
    }

    this.cursor.classList.add('custom-cursor--visible');
  }

  hideCursor() {
    this.cursor.classList.remove('custom-cursor--visible');
    this.cursor.classList.remove(this.cursorTypes['CIRCLE']);
    this.cursor.classList.remove(this.cursorTypes['DEFAULT']);
  }
}

export default Cursor;
