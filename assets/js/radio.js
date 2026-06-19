// RadioButton
(function ($) {
    "use strict";

    const TAG = 'Radio';
    const SELECTOR = 'input.radio-input[type="radio"]';
    const SELECTOR_ROOT = '.radio-root';
    const RADIO_CHECKED = 'radio-checked';
    const RADIO_CHECKEDING = 'radio-checkeding';


    /**
     * @param {CallableFunction} callback
     * @param {number} ms
     * @return {Promise<void>}
     */
    const timeOut = (ms, callback) => new Promise(resolve => setTimeout(resolve, ms)).then(callback);

    class Radio {

        /** @type {JQuery<Element>} */
        $element;

        /** @type {JQuery<Element>|undefined} */
        $collapse = undefined;

        /**
         *
         * @param {JQuery<Element>} $element
         */
        constructor($element) {

            this.$element = $element;
            if (this.isCollapse()) {
                this.$collapse = $($element.data('target'));
            }

            const self = this;
            $element
                .on('change', function (event) {
                    const checked = event.target?.checked;
                    const rootEvent = $(event.target).closest(SELECTOR_ROOT)
                    const name = $(event.target).attr('name')
                    if (checked && rootEvent.length > 0 && typeof name === 'string') {
                        $('body').find(SELECTOR_ROOT)
                            ?.filter((i, el) => $(el).find(SELECTOR)?.attr('name') === name)
                            ?.each((i, input) => {
                                const root = $(input).closest(SELECTOR_ROOT)
                                root.removeClass(RADIO_CHECKED);
                                rootEvent.addClass(RADIO_CHECKED);
                            })

                        self.addCheckeding($(event.target))
                        self.handleCollapseChecked('show')
                    } else {
                        self.handleCollapseChecked('hide')
                    }

                })
                .on('click', (event) => {
                    timeOut(700, () => {
                        self.handleCollapseChecked('show')
                    })
                })

            if ($element.is(':checked')) {
                $element.trigger('change')
            }
        }

        /**
         *
         * @param {JQuery<Element>} $element
         */
        addCheckeding($element) {
            const root = $element?.closest(SELECTOR_ROOT);
            if (root && root?.length > 0) {
                root.addClass(RADIO_CHECKEDING)
                timeOut(700, () => {
                    root.removeClass(RADIO_CHECKEDING)
                })
            }
        }

        /**
         *
         * @param {"hide"|"show"} param
         */
        handleCollapseChecked(param) {
            if (this.$collapse && this.$collapse?.length > 0) {
                this.$collapse.collapse(param);
            }
        }

        isCollapse() {
            const data = this.$element.data();
            return data?.toggle === 'collapse' && typeof data?.target === 'string' && $(data?.target).length > 0;
        }

        static #validate() {
            return $(SELECTOR).length > 0;
        }

        static instance() {
            if (Radio.#validate()) {
                $('body').find(SELECTOR).each((i, element) => {
                    new Radio($(element))
                })
            }
        }
    }

    Radio.instance();
    $(document).on('show.bs.modal', function (event) {
        timeOut(500).then(() => {
            Radio.instance();
        })
    });

})(jQuery); 