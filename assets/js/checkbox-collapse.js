
// checkbox-collapse
(function ($) {
    "use strict";
    const ELEMENT = '.checkbox-switch'
    const INPUT_ELEMENT = 'input[type="checkbox"][data-toggle="checkbox-collapse"][data-target]';
    const SWITCH_RIPPLE = 'switch-ripple';
    const CHECKED = 'checked';

    function delay(ms) {
        var _ms = typeof ms === 'undefined' ? 700 : ms;
        return new Promise(resolve => setTimeout(resolve, _ms));
    }

    class CheckboxCollapse {

        /** @type {JQuery<Element>} */
        $collapse

        /** 
         * @param {HTMLElement} input
         */
        constructor(input) {
            this.$inputCheckbox = $(input);
            const targetId = this.$inputCheckbox.data('target')

            if (!targetId || $(`#${targetId}`).length === 0) {
                return;
            }

            this.$collapse = $(`#${targetId}`)

            const self = this;
            this.$inputCheckbox.on('change', function (event) {

                if (event.target.checked) {
                    self.$collapse.collapse('show');
                }
                else {
                    self.$collapse.collapse('hide');
                }
            });

            if (this.$inputCheckbox.is(':' + CHECKED)) {
                self.$collapse.collapse('show');
            } else {
                self.$collapse.collapse('hide');
            }
        }

        addRipple(context) {
            context.addClass(SWITCH_RIPPLE);
            delay(1000).then(() => context.removeClass(SWITCH_RIPPLE))
        }

        static validate() {
            return $(INPUT_ELEMENT).length > 0;
        }

        static instance() {
            if (CheckboxCollapse.validate()) {
                $(INPUT_ELEMENT).each((i, input) => {
                    new CheckboxCollapse(input);
                });
            }
        }
    }

    $(document).ready(() => {
        CheckboxCollapse.instance();
    })

    $(document).on('show.bs.modal', function (event) {
        delay(500).then(() => {
            CheckboxCollapse.instance();
        })
    });
})(jQuery); 
