import { addClickEventListener } from '../utils/listeners';

const CLASSNAMES = {
  SHARE_ARTICLE_BUTTON: '.article-hero__share-button',
};

class ArticleHero {
  constructor(app, container) {
    this.app = app;
    this.container = container;
    this.isClicked = false;
    this.init();
  }

  init() {
    this.shareArticleButton = this.container.querySelector(CLASSNAMES.SHARE_ARTICLE_BUTTON);

    addClickEventListener(this.shareArticleButton, this.handleShareArticleButtonClick.bind(this));
  }

  handleShareArticleButtonClick() {
    if (navigator.share && !this.isClicked) {
      navigator
        .share({
          url: window.location.href,
        })
        .catch((error) => console.log('Error sharing:', error));
    } else {
      navigator.clipboard.writeText(window.location.href);
    }

    this.shareArticleButton.classList.add('article-hero__share-button--clicked');

    setTimeout(() => {
      this.isClicked = false;
      this.shareArticleButton.classList.remove('article-hero__share-button--clicked');
    }, 2000);
  }
}

export default ArticleHero;
