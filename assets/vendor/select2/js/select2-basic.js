// Select2 Basic
(function ($) {
    "use strict";

    /**
     * @param {CallableFunction} callback
     * @param {number} ms
     * @return {Promise<void>}
     */
    const timeOut = (ms, callback) => new Promise(resolve => setTimeout(resolve, ms)).then(callback);

    const TAG = 'Select2 Basic';
    const SELECTOR = '.form-control.select2-basic';

    class Select2Basic {

        /**
         *
         * @param {HTMLElement} element
         */
        constructor(element) {

            this.$element = $(element)
            const dataOptions = this.$element.data('option') ?? undefined
            this.dataOptions = dataOptions ? JSON.parse(JSON.stringify(dataOptions)) : undefined

            // Validator
            if (!this.dataOptions || typeof this.dataOptions !== 'object' || !this.dataOptions.theme
            ) {
                return;
            }
            const data = this.dataOptions?.data
            if (typeof data === 'string') {
                this.dataOptions.data = JSON.parse(this.dataOptions.data);
            }

            this.options = $.extend({
                placeholder: "",
                allowClear: true
            }, this.dataOptions);

            // console.log(TAG);
            this.$element.select2(this.options);

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
            if (Select2Basic.#validate()) {
                $(SELECTOR).each((i, select) => {
                    new Select2Basic(select)
                })
            }
        }
    }

    $(document).ready(() => {
        Select2Basic.instance();
    })

}(jQuery));
