// ParentDateOption
(function (global, factory) {

    if (typeof exports === 'object' && typeof module !== 'undefined') {
        module.exports = factory(require('jquery'), require('moment'), require('@eonasdan/tempus-dominus'));
    } else {
        global = typeof globalThis !== 'undefined' ? globalThis : global || self;
        global.tempusDominus = global.tempusDominus || {};
        global.tempusDominus.ParentDateOption = factory(global.jQuery, global.moment, global.tempusDominus);
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

    class ParentDateOption {


        /** 
         * @param {HTMLElement} element
         */
        constructor(element) {

            this.$element = $(element)
            this.$parentElement = $(`${this.$element.data('parentDate')}`)

            this.#init();
            this.#onListener();

        }

        #init() {
            const tempus = this.$element.data('tempusDominus')
        }

        #onListener() {
            const event = tempusDominus.Namespace.events
            this.$parentElement
                .on(event.show, (event) => {
                })
                .on(event.hide, (event) => {
                })
                .on(event.update, (event) => {
                })
                .on(event.change, (event) => {
                    const date = event?.date
                    if (date instanceof Date) {
                        this.#update(date)
                    }
                })
        }

        #update(date) {
            const tempus = this.$element.data('tempusDominus')
            const currentView = tempus?.optionsStore.currentView
            const viewDate = tempus?.viewDate
            const mViewDate = moment(viewDate)
            const formatDate = this.$element.data('formatDate')

            if (viewDate instanceof tempusDominus.DateTime && date instanceof tempusDominus.DateTime && formatDate) {
                if (viewDate.isBefore(date)) {
                    tempus.updateOptions({
                        restrictions: { minDate: date }
                    }, true)

                    this.$element.val(moment(date).format(formatDate))
                    this.$element.trigger(EVENT.completed)
                }
            }
        }
    }

    return ParentDateOption

});