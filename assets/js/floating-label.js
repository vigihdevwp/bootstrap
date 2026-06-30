(function ($) {
    "use strict";
    const ELEMENT_INPUT = '.form-control'
    const TEXTFIELD_FLOATING = 'textfield-floating-label'
    const TEXTFIELD_FLOATING_ACTIVE = 'textfield-floating-label-active'
    const TEXTFIELD_FLOATING_COMPLETED = 'textfield-floating-label-completed'
    const EVENT = {
        active: 'active.textfield',
        completed: 'completed.textfield',
        off_active: 'offActive.textfield',
        off_completed: 'offCompleted.textfield',
    }

    /**
     * @param {CallableFunction} callback
     * @param {number} ms
     * @return {Promise<void>}
     */
    const timeOut = (ms, callback) => new Promise(resolve => setTimeout(resolve, ms)).then(callback);

    class Textfield {

        /** @type {JQuery<Element>} */
        textfield;

        /** @type {JQuery<Element>} */
        textInput;

        /**
         * @param {Element} textfield
         */
        constructor(textfield) {

            this.textfield = $(textfield);
            this.textInput = this.textfield.find('input.form-control');
            this.#init()
            this.#onListener()

        }

        #init() {
            if (this.textInput.val().length > 0) {
                this.#setCompleted(this.textInput)
            }
        }
        #onListener() {

            this.textInput
                .on('focus', (event) => {
                    this.#setActive(event.currentTarget, true)
                    this.#setCompleted(event.currentTarget, true)
                })
                .on('focusout', (event) => {
                    this.#setActive(event.currentTarget, false)
                    let value = $(event.currentTarget).val();
                    if (value?.length === 0) {
                        this.#setCompleted(event.currentTarget, false)
                    }
                })
                .on(EVENT.active, (event) => {
                    this.#setActive(event.currentTarget, true)
                })
                .on(EVENT.completed, (event) => {
                    this.#setCompleted(event.currentTarget, true)
                })
                .on(EVENT.off_active, (event) => {
                    this.#setActive(event.currentTarget, false)
                })
                .on(EVENT.off_completed, (event) => {
                    this.#setCompleted(event.currentTarget, false)
                })

        }
        /**
         * @param {HTMLElement} input
         * @param {boolean} condition
         */
        #setActive(input, condition = true) {
            const $textfield = this.#getTextfieldFloating(input)
            if (typeof condition === 'boolean' && $textfield.length > 0) {
                if (condition) {
                    $textfield.addClass(TEXTFIELD_FLOATING_ACTIVE)
                } else {
                    $textfield.removeClass(TEXTFIELD_FLOATING_ACTIVE)
                }
            }
        }
        /**
         * @param {boolean} condition
         * @param {HTMLElement} input
         */
        #setCompleted(input, condition = true) {
            const $textfield = this.#getTextfieldFloating(input)
            if (typeof condition === 'boolean' && $textfield.length > 0) {
                if (condition) {
                    $textfield.addClass(TEXTFIELD_FLOATING_COMPLETED)
                } else {
                    $textfield.removeClass(TEXTFIELD_FLOATING_COMPLETED)
                }
            }
        }

        /**
         * 
         * @param {HTMLElement} input
         * @returns {JQuery<Element>}
         */
        #getTextfieldFloating(input) {
            return $(input).closest(`.${TEXTFIELD_FLOATING}`)
        }

        static #validate() {
            return $(ELEMENT_INPUT).length > 0;
        }

        static instance() {
            if (Textfield.#validate()) {
                $(`.${TEXTFIELD_FLOATING}`).each((i, element) => {
                    new Textfield(element);
                });
            }
        }
    }

    $(document).ready(() => {
        Textfield.instance();
    })

})(jQuery); 