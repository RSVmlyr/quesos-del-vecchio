export const getAncestorByTag = (el, tagName) => {
    tagName = tagName.toLowerCase();

    while (el && el.parentNode) {
        el = el.parentNode;
        if (el.tagName && el.tagName.toLowerCase() == tagName) {
            return el;
        }
    }

    return null;
};

export const getAncestorByClass = (el, className) => {
    while (el && el.parentNode) {
        el = el.parentNode;
        if (el.classList.contains(className)) {
            return el;
        }
    }

    return null;
};