
// Time Picker
(function ($) {
    "use strict";

    const TAG = 'Time Picker';
    const NAME = 'TimePicker'
    const VERSION = '4.6.2'
    const DATA_KEY = 'app.timePicker'
    const EVENT_KEY = `.${DATA_KEY}`
    const JQUERY_NO_CONFLICT = $.fn[NAME]

    const SELECTOR = '.form-control.time-picker';

    class TimePicker {
        /**
         * @param {HTMLElement} element
         */
        constructor(element) {

            this.$element = $(element)
            const data = this.$element.data()
            this.defaultDate = data?.defaultDate
            this.minDate = data?.minDate
            this.maxDate = data?.maxDate
            this.formatDate = data?.formatDate ?? 'HH:mm'

            /** @type {typeof globalThis.tempusDominus.DefaultOptions} */
            let options = $.extend({
                defaultDate: tempusDominus.DateTime.convert(moment(this.defaultDate).toDate()),
                display: {
                    theme: 'light',
                    components: {
                        date: false,
                        month: false,
                        year: false,
                        decades: false,
                        clock: true,
                        hours: true,
                        minutes: true,
                        seconds: false,
                        useTwentyfourHour: false
                    }
                },
                restrictions: {
                    minDate: this.minDate ? tempusDominus.DateTime.convert(moment(this.minDate).toDate()) : undefined,
                    maxDate: this.maxDate ? tempusDominus.DateTime.convert(moment(this.maxDate).toDate()) : undefined
                }
            }, {})

            this.tempus = new tempusDominus.TempusDominus(element, options)
            this.$element.data({ tempusDominus: this.tempus })

            this.#init()
        }

        #init() {
            this.#momentParse();
            this.#defaultDate();
            this.#eventListener();
            const textfield = new tempusDominus.Textfield(this.$element.get(0))

        }

        #eventListener() {
            const tdEvent = tempusDominus.Namespace.events

            this.$element
                .on(tdEvent.show, (event) => {
                    $(this.tempus.display.widget).removeClass('dark').addClass('bootstrap');
                })
                .on(tdEvent.change, (event) => {
                })
                .on(tdEvent.hide, (event) => {
                })
        }

        #defaultDate() {
            if (this.defaultDate) {
                this.$element.val(moment(this.defaultDate).format(this.formatDate))
            } else {
                this.$element.val('')
            }
        }

        #momentParse() {
            this.tempus.dates.formatInput = (date) => {
                if (date instanceof tempusDominus.DateTime) {
                    return moment(date).format(this.formatDate)
                }
                return date.format();
            }
        }

        static #validate() {
            return $(SELECTOR).length > 0
                && typeof moment === 'function'
                && typeof tempusDominus === 'object';
        }

        static instance() {
            if (TimePicker.#validate()) {
                $(SELECTOR).each((index, element) => {
                    new TimePicker(element)
                })
            }
        }
    }

    window.app = window.app || {};
    window.app.TimePicker = TimePicker;

    $(document).ready(() => {
        TimePicker.instance();
    });

})(jQuery);