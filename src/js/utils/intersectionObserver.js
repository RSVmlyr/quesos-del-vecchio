export const setScrollObserver = (container, cb, config = {}) => {
    let observer;

    const handleScrollevent = (entries) => {
        entries.forEach((entry) => {
            cb(entry, observer);
        });
    };

    observer = new IntersectionObserver(handleScrollevent, config);
    observer.observe(container);
};