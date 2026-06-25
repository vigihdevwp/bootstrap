(function ($) {
    "use strict";

    /**
     * @param {CallableFunction} callback
     * @param {number} ms
     * @return {Promise<void>}
     */
    const timeOut = (ms, callback) => new Promise(resolve => setTimeout(resolve, ms)).then(callback);

    const TAG = 'Typeahead Bloodhound (Ajax) Test Native Assets';
    const SELECTOR = '.form-control.typeahead-ajax';

    class TypeaheadAjax {


        options = {};

        dataset = {};

        /** @type {{remoteUrl:string,display:string}} */
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
            if (!this.dataOptions || typeof this.dataOptions !== 'object' || !this.dataOptions.remoteUrl || !this.dataOptions.display
            ) {
                return;
            }

            const dataset = this.dataOptions.dataset && typeof this.dataOptions.dataset === 'object' ?
                this.dataOptions.dataset : {}

            const options = this.dataOptions.options && typeof this.dataOptions.options === 'object' ?
                this.dataOptions.options : null

            this.dataset = $.extend({
                display: this.dataOptions.display,
                source: this.bloodhound(this.dataOptions.remoteUrl, this.dataOptions.display)
            }, this.dataOptions.dataset)

            this.$element.typeahead(options, this.dataset);

            // console.log(TAG);
        }

        /**
         *
         * @param {string} url
         * @param {string} display
         * @return {Bloodhound}
         */
        bloodhound(url, display) {
            const newUrl = url.replace(/\/\w+\.json$/, '')
            return new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace(display),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: url,
                remote: {
                    url: `${newUrl}/queries/%QUERY.json`,
                    wildcard: '%QUERY'
                }
            });
        }

        static #validate() {

            return $(SELECTOR).length > 0
                && typeof window['Bloodhound'] === 'function'
                && typeof $.fn.typeahead === 'function';
        }

        static instance() {
            if (TypeaheadAjax.#validate()) {
                $(SELECTOR).each((i, input) => {
                    new TypeaheadAjax(input)
                })
            }
        }
    }

    TypeaheadAjax.instance();

}(jQuery))
