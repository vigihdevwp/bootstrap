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

        /** @type {{remoteUrl:string,name:string}} */
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
            this.dataOptions = dataOptions ? this.#parseDataOptions(JSON.parse(JSON.stringify(dataOptions))) : undefined

            // Validator
            if (!this.dataOptions || typeof this.dataOptions !== 'object' ||
                !this.#keyExist(this.dataOptions, ['remoteUrl', 'name'])
            ) {
                return;
            }

            const options = this.dataOptions.options && typeof this.dataOptions.options === 'object' ?
                this.dataOptions.options : null

            this.dataset = {
                name: this.dataOptions.name,
                source: this.bloodhound(this.dataOptions.remoteUrl)
            }

            this.$element.typeahead(options, this.dataset);

        }

        /**
         *
         * @param {string} url
         * @return {Bloodhound}
         */
        bloodhound(url) {
            return new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: url,
            });
        }

        /**
         * 
         * @param {Object} obj
         * @param {string[]} keys
         */
        #keyExist(obj, keys) {
            const items = Object.keys(obj).filter(key => keys.includes(key))
            return items.length === keys.length;
        }

        #parseDataOptions(options) {
            if (typeof options === 'object') {
                Object.keys(options).forEach(key => {
                    let value = options[key];
                    if (typeof value === 'string' && /[{\[]+/.test(value.trim().slice(0, 1))) {
                        value = JSON.parse(value)
                        options[key] = value
                    }
                });
            }
            return options;
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

    $(document).ready(() => {
        TypeaheadAjax.instance();
    })

}(jQuery))
