
// checkbox-outline
(function ($) {
    "use strict";
    const TAG = 'CheckboxOutline'
    const ELEMENT = '.checkbox-outline';
    const INPUT_ELEMENT = 'input.checkbox-outline-form-control[type="checkbox"]';
    const CHECKED = 'checked';
    const CHECKBOX_RIPPLE = 'checkbox-outline-ripple';

    function delay(ms) {
        var _ms = typeof ms === 'undefined' ? 700 : ms;
        return new Promise(resolve => setTimeout(resolve, _ms));
    }

    class CheckboxOutline {

        /**
         * Initializes a new instance of the CheckboxOutline class
         * Sets up event handlers for checkbox state changes and applies appropriate CSS classes
         * @param {HTMLElement} inputCheckbox - The checkbox input element to initialize
         */
        constructor(inputCheckbox) {
            this.$inputCheckbox = $(inputCheckbox);
            const self = this;
            // Set up change event handler for the checkbox
            this.$inputCheckbox.on('change', function (event) {
                const context = $(event.target).closest(ELEMENT);
                if (event.target.checked) {
                    // Add checked and ripple effect classes when checkbox is checked
                    context.addClass(CHECKED).addClass(CHECKBOX_RIPPLE);
                    delay(1000).then(() => context.removeClass(CHECKBOX_RIPPLE));
                }
                else {
                    // Remove checked class and add ripple effect when checkbox is unchecked
                    context.removeClass(CHECKED).addClass(CHECKBOX_RIPPLE);
                    delay(1000).then(() => context.removeClass(CHECKBOX_RIPPLE));
                }
            });

            // Check if checkbox is initially checked and apply appropriate classes
            if (this.$inputCheckbox.is(':' + CHECKED)) {
                this.$inputCheckbox.closest(ELEMENT).addClass(CHECKED).addClass(CHECKBOX_RIPPLE);
                delay(1000).then(() => this.$inputCheckbox.closest(ELEMENT).removeClass(CHECKBOX_RIPPLE));
            }

        }

        #controlLabel() {
            $(ELEMENT).on('click', 'label', function (e) {
            })
        }

        static validate() {
            return $(ELEMENT).length > 0;
        }

        static instance() {
            if (CheckboxOutline.validate()) {
                $(ELEMENT).find(INPUT_ELEMENT).each(function (i, inputCheckbox) {
                    new CheckboxOutline(inputCheckbox)
                });
            }
        }
    }

    $(document).ready(() => {
        CheckboxOutline.instance();
    })

    $(document).on('show.bs.modal', function (event) {
        delay(500).then(() => {
            CheckboxOutline.instance();
        })
    });
})(jQuery); 