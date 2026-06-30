
// Date Time Picker
(function ($) {
    "use strict";

    const TAG = 'Date Time Picker';
    const NAME = 'DateTimePicker'
    const VERSION = '4.6.2'
    const DATA_KEY = 'app.dateTimePicker'
    const EVENT_KEY = `.${DATA_KEY}`
    const JQUERY_NO_CONFLICT = $.fn[NAME]

    const SELECTOR = '.form-control.date-time-picker';

    const Format = {
        NO_TZ_MYSQL: 'YYYY-MM-DD HH:mm:ss',
        NO_TZ_NO_SECS: 'YYYY-MM-DD HH:mm',
        NO_TIME: 'YYYY-MM-DD'
    }

    class DateTimePicker {

        /**
         * @param {HTMLElement} element
         */
        constructor(element) {

            this.$element = $(element)
            const data = this.$element.data()
            this.defaultDate = data?.defaultDate
            this.minDate = data?.minDate
            this.maxDate = data?.maxDate
            this.parentDate = data?.parentDate
            this.formatDate = data?.formatDate ?? 'DD-MM-YYYY HH:mm'

            if (this.parentDate) {
                new tempusDominus.ParentDateOption(element)
            }

            /** @type {typeof globalThis.tempusDominus.DefaultOptions} */
            let options = $.extend({
                defaultDate: tempusDominus.DateTime.convert(moment(this.defaultDate).toDate()),
                display: {
                    theme: 'light',
                    components: {
                        date: true,
                        month: false,
                        year: false,
                        decades: false,
                        clock: true,
                        hours: true,
                        minutes: true,
                        seconds: false,
                        useTwentyfourHour: true
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
            // console.log(tempus);
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
                    this.#setViewModeCalendar()
                })
        }

        #setViewModeCalendar() {
            setTimeout(() => {
                this.tempus.updateOptions({
                    display: { viewMode: 'calendar' }
                });
            }, 350)
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
            if (DateTimePicker.#validate()) {
                $(SELECTOR).each((index, element) => {
                    new DateTimePicker(element)
                })
            }
        }
    }

    window.app = window.app || {};
    window.app.DateTimePicker = DateTimePicker;

    $(document).ready(() => {
        DateTimePicker.instance();
    });

})(jQuery);