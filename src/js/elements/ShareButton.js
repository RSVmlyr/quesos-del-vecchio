import { addClickEventListener } from '../utils/listeners';

const CLASSNAMES = {
  SHARE_ARTICLE_BUTTON: '.share-button',
};

class ShareButton {
  constructor(app) {
    this.app = app;
    this.isClicked = false;
    this.init();
  }

  init() {
    this.shareArticleButton = document.querySelectorAll(CLASSNAMES.SHARE_ARTICLE_BUTTON);

    if (this.shareArticleButton.length > 0) {
      this.shareArticleButton.forEach((button) => {
        addClickEventListener(button, this.handleShareArticleButtonClick.bind(this));
      });
    }
  }

  handleShareArticleButtonClick(button) {
    const target = button.currentTarget;
    if (navigator.share && !this.isClicked) {
      navigator
        .share({
          url: window.location.href,
        })
        .catch((error) => console.log('Error sharing:', error));
    } else {
      navigator.clipboard.writeText(window.location.href);
    }

    target.classList.add('share-button--clicked');

    setTimeout(() => {
      this.isClicked = false;
      target.classList.remove('share-button--clicked');
    }, 2000);
  }
}

export default ShareButton;
