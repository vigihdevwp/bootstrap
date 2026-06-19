// Snackbar
(function ($) {
    "use strict";

    const TAG = 'Snackbar';

    const NAME = 'snackbar'
    const VERSION = '4.6.2'
    const DATA_KEY = 'bs.snackbar'
    const EVENT_KEY = `.${DATA_KEY}`
    const JQUERY_NO_CONFLICT = $.fn[NAME]

    const SELECTOR = '.snackbar[data-placement]';

    class Snackbar {

        /**
         * @param {HTMLElement} element
         */
        constructor(element) {
            this.$element = $(element)
            this.timeoutId = null;

            const options = this.$element.data();
            this.delay = options?.delay ?? 5000

            if (this.$element.hasClass('show')) {
                this.show()
            }
        }

        /**
         * Fungsi untuk memunculkan snackbar dengan posisi tertentu
         * @param {string} placement - 'bottom-left', 'bottom-center', 'bottom-right'
         */
        show() {
            clearTimeout(this.timeoutId);
            this.$element.removeClass('hide').addClass('show');
            this.timeoutId = setTimeout(() => {
                this.hide();
            }, this.delay);
        }

        /**
         * Fungsi untuk menyembunyikan snackbar
         */
        hide() {
            this.$element.removeClass('show').addClass('hide');
        }

        static #validate() {
            return $(SELECTOR).length > 0;
        }

        static instance() {
            if (Snackbar.#validate()) {
                $(SELECTOR).each((index, element) => {
                    new Snackbar(element)
                })
            }
        }
    }

    window.app = window.app || {};
    window.app.Snackbar = Snackbar;

    $(document).ready(() => {
        Snackbar.instance();
    });

})(jQuery);