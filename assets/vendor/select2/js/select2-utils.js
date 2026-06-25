
/**
 * @typedef {import("select2").Select2} Select2Intance
 */
(function ($) {
    "use strict";

    /**
     * @param {CallableFunction} callback
     * @param {number} ms
     * @return {Promise<void>}
     */
    const timeOut = (ms, callback) => new Promise(resolve => setTimeout(resolve, ms)).then(callback);


    const TAG = 'Select2';
    const SELECTOR = '.form-control.select2';

    class Utils {

        /** @type {JQuery<Element>} */
        $element

        /** @type {JQuery<Element>} */
        $container

        /**
         *
         * @param {HTMLElement} element
         */
        constructor(element) {

            this.$element = $(element)
            this.$container = this.$element.closest('div').find('.select2.select2-container')

            this.#init();
            window.select2Utils = this

        }

        #init() {
            const self = this;
            this.$element
                .on('change', function (event) {
                })
                .on('select2:open', function (event) {
                    const $target = $(event.target)
                    self.addArrow('up');
                    self.addTheme('default');
                })
                .on('select2:selecting', function (event) {
                })
                .on('select2:clearing', function (event) {
                })
                .on('select2:close', function (event) {
                    const $target = $(event.target)
                    const $select2 = $target.data('select2')
                    self.addArrow('down')
                });

            this.addArrow('down')
            self.addTheme('default');
        }

        /**
         * @param {string} name
         * @returns {void}
         */
        addTheme(name) {
            const $container = $('body').find('.select2-container')
            const $select2container = this.$element.closest('div').find('.select2.select2-container')
            if ($container?.length > 0) {
                $container.addClass(`select2-container--${name}`)
            }
            if ($select2container?.length > 0) {
                $select2container.addClass(`select2-container--${name}`)
            }
        }

        /**
         * @param {string} name
         * @returns {void}
         */
        addArrow(name) {
            const $arrow = this.$container.find('.select2-selection__arrow')
            if ($arrow?.length > 0) {
                $arrow.empty()
                $arrow.append($('<span/>').addClass('material-icons-outlined').text(`keyboard_arrow_${name}`))
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
            if (Utils.#validate()) {
                $(SELECTOR).each((i, select) => {
                    new Utils(select)
                })
            }
        }
    }

    timeOut(300, () => {
        Utils.instance();
    })

}(jQuery));
