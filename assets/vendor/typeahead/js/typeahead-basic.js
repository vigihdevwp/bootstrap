(function ($) {
    "use strict";

    /**
     * @param {CallableFunction} callback
     * @param {number} ms
     * @return {Promise<void>}
     */
    const timeOut = (ms, callback) => new Promise(resolve => setTimeout(resolve, ms)).then(callback);

    const TAG = 'Typeahead Basic Test Native Assets';
    const SELECTOR = '.form-control.typeahead-basic';

    class TypeaheadBasic {

        options = {};

        dataset = {};

        dataOptions = {};

        /** @type {JQuery<Element>} */
        $element;

        /**
         *
         * @param {Element} element
         */
        constructor(element) {

            this.$element = $(element)
            const dataOptions = this.$element.data('options')
            this.dataOptions = JSON.parse(JSON.stringify(dataOptions))

            // Validator
            if (!this.dataOptions || typeof this.dataOptions !== 'object' || !this.dataOptions.data
            ) {
                return;
            }

            const dataset = this.dataOptions.dataset && typeof this.dataOptions.dataset === 'object' ?
                this.dataOptions.dataset : {}

            const options = this.dataOptions.options && typeof this.dataOptions.options === 'object' ?
                this.dataOptions.options : null

            this.dataset = $.extend({
                source: this.substringMatcher(this.dataOptions.data)
            }, this.dataOptions.dataset)

            this.$element.typeahead(options, this.dataset);

            // console.log(TAG);
        }

        substringMatcher(strs) {
            return function findMatches(q, cb) {
                var matches, substrRegex;

                matches = [];

                substrRegex = new RegExp(q, 'i');

                $.each(strs, function (i, str) {
                    if (substrRegex.test(str)) {
                        matches.push(str);
                    }
                });

                cb(matches);
            };
        };

        static #validate() {

            return $(SELECTOR).length > 0
                && typeof window['Bloodhound'] === 'function'
                && typeof $.fn.typeahead === 'function';
        }

        static instance() {
            if (TypeaheadBasic.#validate()) {
                $(SELECTOR).each((i, input) => {
                    new TypeaheadBasic(input)
                })
            }
        }
    }

    TypeaheadBasic.instance();

}(jQuery));
