(function (global, factory) {

    if (typeof exports === 'object' && typeof module !== 'undefined') {
        module.exports = factory(require('jquery'), require('moment'), require('@eonasdan/tempus-dominus'));
    } else {
        global = typeof globalThis !== 'undefined' ? globalThis : global || self;
        global.tempusDominus = global.tempusDominus || {};
        global.tempusDominus.OptionsParser = factory(global.jQuery, global.moment, global.tempusDominus);
    }

})(this, function (
    /** @type {jQuery<Element} */ $,
    /** @type {typeof globalThis.moment} */ moment,
    /** @type {typeof globalThis.tempusDominus} */ tempusDominus
) {
    'use strict';

    class OptionsParser {

        /** 
         * @param {HTMLElement} element
         */
        constructor(element) {
            this.$element = $(element)
        }

        buildFromData() {

            let results = {}
            const data = this.$element.data()
            const defaultDate = data?.defaultDate
            const minDate = data?.minDate
            const maxDate = data?.maxDate

            if (typeof minDate === 'string' && moment(minDate).isValid()) {
                const date = tempusDominus.DateTime.convert(moment(minDate).toDate(), 'id');
                $.extend(true, results, {
                    restrictions: { minDate: date }
                })
            }

            if (typeof maxDate === 'string' && moment(maxDate).isValid()) {
                const date = tempusDominus.DateTime.convert(moment(maxDate).toDate(), 'id');
                $.extend(true, results, { restrictions: { maxDate: date } })
            }

            if (typeof defaultDate === 'string' && moment(defaultDate).isValid()) {
                const converted = moment(defaultDate);
                const date = tempusDominus.DateTime.convert(converted.toDate(), 'id');
                $.extend(true, results, { defaultDate: date })
            }

            return results;
        }
    }

    return OptionsParser

});