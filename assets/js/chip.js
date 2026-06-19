// Chip
(function ($) {
    "use strict";

    const TAG = 'Chip';
    const NAME = 'chip'
    const VERSION = '4.6.2'
    const DATA_KEY = 'bs.chip'
    const EVENT_KEY = `.${DATA_KEY}`
    const JQUERY_NO_CONFLICT = $.fn[NAME]

    const SELECTOR = '.chip[role="chip"]';

    class Chip {

        /**
         * @param {HTMLElement} element
         */
        constructor(element) {
            this.$element = $(element)
            const $close = this.$element.find('.chip-close[data-dismiss="chip"]')
            if ($close.length > 0) {
                $close.on('click', (event) => {
                    const $context = $(event.currentTarget).closest(SELECTOR);
                    $context.trigger(`close${EVENT_KEY}`)
                    $context.remove();
                })
            }
        }

        static #validate() {
            return $(SELECTOR).length > 0;
        }

        static instance() {
            if (Chip.#validate()) {
                $(SELECTOR).each((index, element) => {
                    new Chip(element)
                })
            }
        }
    }

    window.app = window.app || {};
    window.app.Chip = Chip;

    $(document).ready(() => {
        Chip.instance();
    });

})(jQuery);