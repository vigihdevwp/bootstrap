// backdrop
(function (global, factory) {

    if (typeof exports === 'object' && typeof module !== 'undefined') {
        module.exports = factory();
    } else {

        global = typeof globalThis !== 'undefined'
            ? globalThis
            : global || self;

        (
            global.tempusDominus = global.tempusDominus || {},
            global.tempusDominus.plugins = global.tempusDominus.plugins || {},
            global.tempusDominus.plugins.backdrop = factory()
        );
    }

})(this, function () {
    'use strict';
    return function (options, tdClasses, tdFactory) {

    };
});