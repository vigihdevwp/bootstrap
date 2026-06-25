(function ($) {
    "use strict";

    /**
     * @param {CallableFunction} callback
     * @param {number} ms
     * @return {Promise<void>}
     */
    const timeOut = (ms, callback) => new Promise(resolve => setTimeout(resolve, ms)).then(callback);

    const TAG = 'Typeahead Prefetch Test Native Assets';
    const SELECTOR = '.form-control.typeahead-prefetch';

    class TypeaheadPrefetch {

        options = {};

        dataset = {};

        /** @type {{remoteUrl:string}} */
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
            this.dataOptions = dataOptions ? JSON.parse(JSON.stringify(dataOptions)) : undefined

            // Validator
            if (!this.dataOptions || typeof this.dataOptions !== 'object' || !this.dataOptions.remoteUrl
            ) {
                return;
            }

            const dataset = this.dataOptions.dataset && typeof this.dataOptions.dataset === 'object' ?
                this.dataOptions.dataset : {}

            const options = this.dataOptions.options && typeof this.dataOptions.options === 'object' ?
                this.dataOptions.options : null

            this.dataset = $.extend({
                source: this.bloodhound(this.dataOptions.remoteUrl)
            }, this.dataOptions.dataset)

            this.$element.typeahead(options, this.dataset);

        }

        /**
         * @param {string} url
         * @return {Bloodhound}
         */
        bloodhound(url) {
            return new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: url
            });
        }

        static #validate() {

            return $(SELECTOR).length > 0
                && typeof window['Bloodhound'] === 'function'
                && typeof $.fn.typeahead === 'function';
        }

        static instance() {
            if (TypeaheadPrefetch.#validate()) {
                $(SELECTOR).each((i, input) => {
                    new TypeaheadPrefetch(input)
                })
            }
        }
    }

    TypeaheadPrefetch.instance();

}(jQuery));
