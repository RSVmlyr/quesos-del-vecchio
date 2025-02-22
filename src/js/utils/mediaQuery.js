export const mediaQueryHook = (query) => {
  if (window.matchMedia(query).matches === true) {
    return true;
  } else if (window.matchMedia(query).matches === false) {
    return false;
  }
};
