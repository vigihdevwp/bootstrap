(function ($) {
    "use strict";

    /**
     * @param {CallableFunction} callback
     * @param {number} ms
     * @return {Promise<void>}
     */
    const timeOut = (ms, callback) => new Promise(resolve => setTimeout(resolve, ms)).then(callback);

    const TAG = 'Select2 Ajax';
    const SELECTOR = '.form-control.select2-ajax';

    const Templates = {

        /**
         *
         * @param {{id:string,text:string}} item
         * @returns {string}
         */
        templateResultBasic: (item) => {
            return $('<div/>').addClass('select2-custom-group')
                .append([
                    $('<span/>').addClass('text-label').text(item?.text),
                    $('<span/>').addClass('text-item').text('')
                ])
        },

        /**
         *
         * @param {{id:string,text:string}} item
         * @returns {string}
         */
        templateSelectionBasic: (item) => {
            return item.text;
        },

        /**
         *
         * @param {{id:string,text:string}} item
         * @returns {string}
         */
        templateResult: (item) => {
            return $('<div/>').addClass('select2-custom-group')
                .append([
                    $('<span/>').addClass('text-label').text(item?.text),
                    $('<span/>').addClass('text-item').text('')
                ])
        },

        /**
         *
         * @param {{id:string,text:string}} item
         * @returns {string}
         */
        templateSelection: (item) => {
            return item.text;
        },
    }

    class Select2Ajax {

        /** @type {{url:string}} */
        dataOptions

        /**
         *
         * @param {HTMLElement} element
         */
        constructor(element) {

            this.$element = $(element)
            this.dataOptions = this.$element.data('options')

            // Validator
            if (!this.dataOptions || typeof this.dataOptions !== 'object' || !this.dataOptions.url
                || !this.dataOptions.theme
                || !this.dataOptions.templateResult
                || typeof Templates[`${this.dataOptions.templateResult}`] !== 'function'
                || !this.dataOptions.templateSelection
                || typeof Templates[`${this.dataOptions.templateSelection}`] !== 'function'
            ) {
                return;
            }

            const options = {
                ajax: this.ajaxOptions(this.dataOptions.url),
                placeholder: '',
                allowClear: true,
                minimumInputLength: 1,
                theme: this.dataOptions.theme,
                templateResult: Templates[`${this.dataOptions.templateResult}`],
                templateSelection: Templates[`${this.dataOptions.templateSelection}`],
            }

            this.$element.select2(options);

            // console.log(TAG);
        }

        /**
         * @param {string} url
         * @returns {Array<{id:string,text:string,textInfo:string|undefined}>}
         */
        ajaxOptions(url) {
            return {
                url: url,
                dataType: 'json',
                delay: 500,
                cache: true,
                processResults: (data, params) => {
                    return {
                        results: data?.items ?? []
                    };
                }
            }
        }

        /**
         * @returns {boolean}
         */
        static #validate() {
            return typeof $ === 'function' && $(SELECTOR).length > 0 && typeof $.fn.select2 === 'function';
        }

        /**
         * @returns {void}
         */
        static instance() {
            if (Select2Ajax.#validate()) {
                $(SELECTOR).each((i, select) => {
                    new Select2Ajax(select)
                })
            }
        }
    }

    Select2Ajax.instance();

}(jQuery));
