(function (global, factory) {

    if (typeof exports === 'object' && typeof module !== 'undefined') {
        module.exports = factory(require('jquery'), require('moment'), require('@eonasdan/tempus-dominus'));
    } else {
        global = typeof globalThis !== 'undefined' ? globalThis : global || self;
        global.tempusDominus = global.tempusDominus || {};
        global.tempusDominus.Textfield = factory(global.jQuery, global.moment, global.tempusDominus);
    }

})(this, function (
    /** @type {jQuery<Element} */ $,
    /** @type {typeof globalThis.moment} */ moment,
    /** @type {typeof globalThis.tempusDominus} */ tempusDominus
) {
    'use strict';

    const EVENT = {
        active: 'active.textfield',
        completed: 'completed.textfield',
        off_active: 'offActive.textfield',
        off_completed: 'offCompleted.textfield',
    }

    /**
     * @param {CallableFunction} callback
     * @param {number} ms
     * @return {Promise<void>}
     */
    const timeOut = (ms, callback) => new Promise(resolve => setTimeout(resolve, ms)).then(callback);

    class Textfield {

        /** 
         * @param {HTMLElement} element
         */
        constructor(element) {
            this.$element = $(element)

            this.#init()
        }

        #init() {
            this.#onListener()
            if (this.$element.val().length > 0) {
                timeOut(500, () => {
                    this.$element.trigger(EVENT.completed)
                })
            }
        }

        #onListener() {
            const event = tempusDominus.Namespace.events
            this.$element
                .on(event.show, (event) => {
                    timeOut(500, () => {
                        $(event.target).trigger(EVENT.active)
                    })
                })
                .on(event.update, (event) => {

                })
                .on(event.change, (event) => {
                    timeOut(500, () => {
                        $(event.target).trigger(EVENT.completed)
                    })
                })
                .on(event.hide, (event) => {
                    timeOut(500, () => {
                        $(event.target).trigger(EVENT.off_active)
                    })
                })
        }
    }

    return Textfield

});