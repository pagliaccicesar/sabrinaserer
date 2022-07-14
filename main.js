"use strict";
if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = function (callback, thisArg) {
        thisArg = thisArg || window;
        for (var i = 0; i < this.length; i++) {
            callback.call(thisArg, this[i], i, this);
        }
    };
}
const items = document.querySelectorAll('.item');
const config = {
    rootMargin: '-300px 0px -200px',
    threshold: 0.01
};
const onIntersection = (entries) => {
    console.log(entries);
    // Loop through the entries
    entries.forEach(entry => {
        // Are we in viewport?
        if (entry.intersectionRatio > 0) {
            entry.target.classList.add('in-viewport');
        }
        else {
            entry.target.classList.remove('in-viewport');
        }
    });
};
// The observer for the images on the page
const observer = new IntersectionObserver(onIntersection, config);
items.forEach(item => {
    console.log(item);
    observer.observe(item);
});
