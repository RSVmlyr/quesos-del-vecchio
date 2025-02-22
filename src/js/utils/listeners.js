// Adding Event Listeners to Touch and Click Events
export const addClickEventListener = (element, functionCall) => {
    if (typeof window.ontouchstart === 'undefined') {
        element.addEventListener('click', functionCall)
    } else {
        element.addEventListener('touchstart', functionCall, { passive: true })
    }
}
