const CLASSNAMES = {
  HOTSPOT: '.hotspot',
  HOTSPOT_BUTTON: '.hotspot__button',
  HOTSPOT_BOX: '.hotspot__box',
};

class Hotspots {
  constructor(app, container) {
    this.app = app;
    this.container = container;
    this.hotspots = this.container.querySelectorAll(CLASSNAMES.HOTSPOT);
    this.activeHotspot = null;

    // Add click outside handler
    document.addEventListener('click', this.handleClickOutside.bind(this));

    for (const hotspot of this.hotspots) {
      this.setupHotspot(hotspot);
    }
  }

  handleClickOutside(event) {
    // Check if click is outside any hotspot
    if (!event.target.closest(CLASSNAMES.HOTSPOT)) {
      this.closeAllHotspots();
    }
  }

  closeAllHotspots() {
    this.hotspots.forEach((hotspot) => {
      hotspot.classList.remove('hotspot--active');
    });
    this.activeHotspot = null;
  }

  setupHotspot(hotspot) {
    const button = hotspot.querySelector(CLASSNAMES.HOTSPOT_BUTTON);
    const box = hotspot.querySelector(CLASSNAMES.HOTSPOT_BOX);

    this.adjustBoxPosition(box, hotspot.getBoundingClientRect());

    button.addEventListener('click', async (event) => {
      event.stopPropagation(); // Prevent click from bubbling to document

      // Close all hotspots first
      this.closeAllHotspots();

      const hotspotRect = hotspot.getBoundingClientRect();

      // Check for viewport collisions and adjust position if needed
      this.adjustBoxPosition(box, hotspotRect);

      // Show the box
      hotspot.classList.add('hotspot--active');
      this.activeHotspot = hotspot;
    });
  }

  adjustBoxPosition(box, hotspotRect) {
    const boxRect = box.getBoundingClientRect();
    const viewportWidth = window.innerWidth;

    // Calculate if box is colliding with viewport edges (only horizontal)
    const rightCollision = boxRect.right > viewportWidth;
    const leftCollision = boxRect.left < 0;

    // Adjust position based on horizontal collisions only
    if (rightCollision) {
      box.style.transform = `translate(calc(-100% + ${viewportWidth - hotspotRect.right}px), -50%)`;
    } else if (leftCollision) {
      box.style.transform = `translate(calc(0% - ${hotspotRect.left}px), -50%)`;
    }
  }
}

export default Hotspots;
