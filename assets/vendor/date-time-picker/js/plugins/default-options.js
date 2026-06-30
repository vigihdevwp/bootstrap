
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
            global.tempusDominus.plugins.defaultOptions = factory()
        );
    }

})(this, function () {
    'use strict';

    /**
     * @typedef {typeof globalThis.tempusDominus} TempusDominusFactory
     * @param {*} options
     * @param {*} tdClasses
     * @param {TempusDominusFactory} tdFactory
     */
    return function (options, tdClasses, tdFactory) {

        tdFactory.DefaultOptions.display.icons = {
            type: 'icons',
            time: 'material-icons-outlined schedule',
            date: 'material-icons-outlined calendar_month',
            up: 'material-icons-outlined expand_less',
            down: 'material-icons-outlined expand_more',
            previous: 'material-icons-outlined chevron_left',
            next: 'material-icons-outlined chevron_right',
            today: 'material-icons-outlined event_available',
            clear: 'material-icons-outlined delete',
            close: 'material-icons-outlined fa-xmark',
        }

    };

});