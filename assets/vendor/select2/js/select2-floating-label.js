(function ($) {
    "use strict";

    /**
     * @param {CallableFunction} callback
     * @param {number} ms
     * @return {Promise<void>}
     */
    const timeOut = (ms, callback) => new Promise(resolve => setTimeout(resolve, ms)).then(callback);

    const TAG = 'Select2 Floating Label';
    const SELECTOR = '.form-control.select2-floating-label';
    const FLOATING = 'textfield-floating-label';
    const FLOATING_COMPLETED = 'textfield-floating-label-completed';
    const FLOATING_ACTIVE = 'textfield-floating-label-active';
    const MATERIAL_ICONS = 'material-icons-outlined';

    class Select2FloatingLabel {

        /** @type {object} */
        utils = null;

        /** @type {JQuery<Element>} */
        $element;

        /**
         *
         * @param {HTMLElement} element
         */
        constructor(element) {

            this.$element = $(element)

            const self = this;
            this.$element
                .on('change', function (event) {
                })
                .on('select2:open', function (event) {
                    const $target = $(event.target)
                    self.#floatingActive(true)
                    self.#floatingCompleted(true)
                })
                .on('select2:selecting', function (event) {
                })
                .on('select2:clearing', function (event) {
                })
                .on('select2:close', function (event) {
                    const $target = $(event.target)
                    const $select2 = $target.data('select2')
                    self.#floatingActive(false)
                    if (self.isEmptySelect()) {
                        self.#floatingCompleted(false)
                    }
                });

            this.init()
        }

        init() {
            if (!this.isEmptySelect()) {
                this.#floatingCompleted(true)
            }
        }

        /**
         * @returns {boolean}
         */
        isEmptySelect() {
            return this.$element.val() === null || this.$element.val()?.length === 0
        }

        /**
         *
         * @param {boolean} condition
         */
        #floatingActive(condition) {
            const $element = this.$element;
            if ($element?.length > 0) {
                if (typeof condition === 'boolean' && !condition) {
                    $element.closest(`.${FLOATING}`).removeClass(FLOATING_ACTIVE)
                } else {
                    $element.closest(`.${FLOATING}`).addClass(FLOATING_ACTIVE)
                }
            }
        }

        /**
         *
         * @param {boolean} condition
         */
        #floatingCompleted(condition) {
            const $element = this.$element;
            if ($element?.length > 0) {
                if (typeof condition === 'boolean' && !condition) {
                    $element.closest(`.${FLOATING}`).removeClass(FLOATING_COMPLETED)
                } else {
                    $element.closest(`.${FLOATING}`).addClass(FLOATING_COMPLETED)
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
            if (Select2FloatingLabel.#validate()) {
                $(SELECTOR).each((i, select) => {
                    new Select2FloatingLabel(select)
                })
            }
        }
    }

    timeOut(300, () => {
        Select2FloatingLabel.instance();
    })

}(jQuery));
