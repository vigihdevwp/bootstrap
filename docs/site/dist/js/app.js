
// checkbox-circle
(function ($) {
    "use strict";
    const TAG = 'CheckboxCircle'
    const ELEMENT = '.checkbox-circle';
    const INPUT_ELEMENT = 'input.checkbox-circle-form-control[type="checkbox"]';
    const CHECKED = 'checked';
    const CHECKBOX_RIPPLE = 'checkbox-circle-ripple';

    function delay(ms) {
        var _ms = typeof ms === 'undefined' ? 700 : ms;
        return new Promise(resolve => setTimeout(resolve, _ms));
    }

    class CheckboxCircle {

        constructor(inputCheckbox) {
            this.$inputCheckbox = $(inputCheckbox);
            const self = this;
            this.$inputCheckbox.on('change', function (e) {
                const context = $(e.target).closest(ELEMENT);
                if (e.target.checked) {
                    context.addClass(CHECKED).addClass(CHECKBOX_RIPPLE);
                    delay(1000).then(() => context.removeClass(CHECKBOX_RIPPLE));
                }
                else {
                    context.removeClass(CHECKED).addClass(CHECKBOX_RIPPLE);
                    delay(1000).then(() => context.removeClass(CHECKBOX_RIPPLE));
                }
            });

            if (this.$inputCheckbox.is(':' + CHECKED)) {
                this.$inputCheckbox.closest(ELEMENT).addClass(CHECKED).addClass(CHECKBOX_RIPPLE);
                delay(1000).then(() => this.$inputCheckbox.closest(ELEMENT).removeClass(CHECKBOX_RIPPLE));
            }

        }

        #controlLabel() {
            $(ELEMENT).on('click', 'label', function (e) {
                console.log(e);
            })
        }

        static validate() {
            return $(ELEMENT).length > 0;
        }

        static instance() {
            if (CheckboxCircle.validate()) {
                $(ELEMENT).find(INPUT_ELEMENT).each(function (i, inputCheckbox) {
                    new CheckboxCircle(inputCheckbox)
                });
            }
        }
    }
    CheckboxCircle.instance();

    $(document).on('show.bs.modal', function (event) {
        delay(500).then(() => {
            CheckboxCircle.instance();
        })
    });
})(jQuery); ;
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
;
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
})(jQuery); ;
// chebox-switch
(function ($) {
    "use strict";
    const ELEMENT = '.checkbox-switch'
    const INPUT_ELEMENT = 'input.checkbox-switch-form-control[type="checkbox"]';
    const SWITCH_RIPPLE = 'switch-ripple';
    const CHECKED = 'checked';

    function delay(ms) {
        var _ms = typeof ms === 'undefined' ? 700 : ms;
        return new Promise(resolve => setTimeout(resolve, _ms));
    }

    class Switch {

        constructor(element) {
            this.$element = $(element);
            this.$inputCheckbox = $(element).find(INPUT_ELEMENT);

            const self = this;
            this.$inputCheckbox.on('change', function (e) {
                const context = $(e.target).closest(ELEMENT);
                self.addRipple(context);

                if (e.target.checked) {
                    context.addClass(CHECKED);
                }
                else {
                    context.removeClass(CHECKED)
                }
            });

            if (this.$inputCheckbox.is(':' + CHECKED)) {
                const context = this.$inputCheckbox.closest(ELEMENT);
                context.addClass(CHECKED);
                self.addRipple(context);
            }
        }

        addRipple(context) {
            context.addClass(SWITCH_RIPPLE);
            delay(1000).then(() => context.removeClass(SWITCH_RIPPLE))
        }

        static validate() {
            return $(ELEMENT).length > 0;
        }

        static instance() {
            if (Switch.validate()) {
                $(ELEMENT).each((i, element) => {
                    new Switch(element);
                });
            }
        }
    }

    $(document).ready(() => {
        Switch.instance();
    })

    $(document).on('show.bs.modal', function (event) {
        delay(500).then(() => {
            Switch.instance();

        })
    });
})(jQuery); 
;// Chip
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

})(jQuery);;(function ($) {
    "use strict";
    const ELEMENT_INPUT = '.form-control'
    const TEXTFIELD_FLOATING = 'textfield-floating-label'
    const TEXTFIELD_FLOATING_ACTIVE = 'textfield-floating-label-active'
    const TEXTFIELD_FLOATING_COMPLETED = 'textfield-floating-label-completed'
    const EVENT = {
        floating_active: 'floatingActive.textfield',
        floating_completed: 'floatingCompleted.textfield',
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
            if (this.textInput?.length > 0) {

                this.textInput
                    .on('focus', (event) => {
                        $(event.target).closest('.' + TEXTFIELD_FLOATING)
                            .addClass(TEXTFIELD_FLOATING_ACTIVE)
                            .addClass(TEXTFIELD_FLOATING_COMPLETED)
                    })
                    .on('focusout', (event) => {
                        $(event.target).closest('.' + TEXTFIELD_FLOATING).removeClass(TEXTFIELD_FLOATING_ACTIVE);
                        let value = $(event.target)?.val();
                        if (value?.length === 0) {
                            $(event.target).closest('.' + TEXTFIELD_FLOATING).removeClass(TEXTFIELD_FLOATING_COMPLETED);
                        }
                    })
                    .on(EVENT.floating_active, (event) => {
                        $(event.target).closest('.' + TEXTFIELD_FLOATING)
                            .addClass(TEXTFIELD_FLOATING_ACTIVE)
                            .addClass(TEXTFIELD_FLOATING_COMPLETED)
                    })
                    .on(EVENT.floating_completed, (event) => {
                        $(event.target).closest('.' + TEXTFIELD_FLOATING).removeClass(TEXTFIELD_FLOATING_ACTIVE);
                        let value = $(event.target)?.val();
                        if (value?.length === 0) {
                            $(event.target).closest('.' + TEXTFIELD_FLOATING).removeClass(TEXTFIELD_FLOATING_COMPLETED);
                        }
                    })

                timeOut(700, () => {
                    if (this.textInput.val().length > 0) {
                        this.textInput.closest('.' + TEXTFIELD_FLOATING).addClass(TEXTFIELD_FLOATING_COMPLETED)
                    }
                })

            }
        }

        static validate() {
            return $(ELEMENT_INPUT).length > 0;
        }

        static instance() {
            if (Textfield.validate()) {
                $("." + TEXTFIELD_FLOATING).each((i, element) => {
                    new Textfield(element);
                });
            }
        }
    }
    Textfield.instance();

    $(document).on('show.bs.modal', function (event) {
        timeOut(700, () => Textfield.instance())
    });

})(jQuery); ;(function ($) {
    'use strict';

    var TAG = 'PasswordVisibility';
    const VISIBILITY = 'visibility';
    const VISIBILITY_OFF = 'visibility_off';
    const INPUT_PASSWORD = 'input.form-control[type="password"]';

    const delay = (ms) => new Promise(resolve => setTimeout(resolve, ms));

    class PasswordVisibility {

        constructor(element) {
            this.$element = $(element);
            const self = this;
            const icon = $(element).find('.input-group-append .material-icons-outlined').text();
            $(element).find('.input-group-append .input-group-text').addClass('ripple-effect');

            $(element).find('.input-group-append').addClass('ripple-effect').on('click', function (e) {
                if ($(this).find('.material-icons-outlined').text() === VISIBILITY) {
                    self.#runVisibility();
                    return;
                }

                if ($(this).find('.material-icons-outlined').text() === VISIBILITY_OFF) {
                    self.#runVisibilityOff();
                }
            });

        }

        #runVisibility() {
            this.$element.find('input[id]').attr({ type: 'password' });
            this.$element.find('.input-group-append .material-icons-outlined').text(VISIBILITY_OFF);
        }

        #runVisibilityOff() {
            this.$element.find('input[id]').attr({ type: 'text' });
            this.$element.find('.input-group-append .material-icons-outlined').text(VISIBILITY);
        }

        static validate() {
            return $(INPUT_PASSWORD).length > 0;
        }

        static instance() {
            if (PasswordVisibility.validate()) {

                $(INPUT_PASSWORD).each((i, element) => {
                    const $append = $(element).closest('.input-group').find('.input-group-append');
                    if ($append.length > 0) {
                        if ($append.find('.material-icons-outlined').length > 0) {
                            new PasswordVisibility($(element).closest('.input-group').get(0))
                        }
                    }
                });
            }
        }
    }
    PasswordVisibility.instance();

    $(document).on('show.bs.modal', function (event) {
        delay(300).then(() => {
            PasswordVisibility.instance();
        });
    });
})(jQuery);;// RadioButton
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

})(jQuery); ;// Snackbar
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

})(jQuery);;(function ($) {
    "use strict";
    const TAG = 'Textfield Rounded';
    const SELECTOR = '.form-group-rounded'
    const TEXTFIELD_ROUNDED_ACTIVE = 'textfield-rounded-active'
    const TEXTFIELD_ROUNDED_COMPLETED = 'textfield-rounded-completed'


    /**
     * @param {CallableFunction} callback
     * @param {number} ms
     * @return {Promise<void>}
     */
    const timeOut = (ms, callback) => new Promise(resolve => setTimeout(resolve, ms)).then(callback);

    class TextfieldRounded {

        /** @type {JQuery<Element>} */
        $input;

        /** @type {JQuery<Element>} */
        textInput;

        /**
         * @param {JQuery<Element>} $input
         */
        constructor($input) {

            this.$input = $input;
            this.$input
                .on('focus', (event) => {
                    $(event.target).closest(SELECTOR).addClass(TEXTFIELD_ROUNDED_ACTIVE)
                })
                .on('focusout', (event) => {
                    $(event.target).closest(SELECTOR).removeClass(TEXTFIELD_ROUNDED_ACTIVE)
                })
        }

        static validate() {
            return $(SELECTOR).length > 0;
        }

        static instance() {
            if (TextfieldRounded.validate()) {
                $('body').find(SELECTOR)?.toArray()?.map(el => $(el)).forEach($element => {
                    const $input = $element.find('input.form-control');
                    if ($input.length > 0) {
                        new TextfieldRounded($input)
                    }
                })
            }
        }
    }

    TextfieldRounded.instance();

    $(document).on('show.bs.modal', function (event) {
        timeOut(700, () => TextfieldRounded.instance())
    });

})(jQuery); ;/*!
 * Waves v0.7.6
 * http://fian.my.id/Waves
 *
 * Copyright 2014-2018 Alfiana E. Sibuea and other contributors
 * Released under the MIT license
 * https://github.com/fians/Waves/blob/master/LICENSE
 */

; (function (window, factory) {
    'use strict';

    // AMD. Register as an anonymous module.  Wrap in function so we have access
    // to root via `this`.
    if (typeof define === 'function' && define.amd) {
        define([], function () {
            window.Waves = factory.call(window);
            return window.Waves;
        });
    }

    // Node. Does not work with strict CommonJS, but only CommonJS-like
    // environments that support module.exports, like Node.
    else if (typeof exports === 'object') {
        module.exports = factory.call(window);
    }

    // Browser globals.
    else {
        window.Waves = factory.call(window);
    }
})(typeof global === 'object' ? global : this, function () {
    'use strict';

    var Waves = Waves || {};
    var $$ = document.querySelectorAll.bind(document);
    var toString = Object.prototype.toString;
    var isTouchAvailable = 'ontouchstart' in window;


    // Find exact position of element
    function isWindow(obj) {
        return obj !== null && obj === obj.window;
    }

    function getWindow(elem) {
        return isWindow(elem) ? elem : elem.nodeType === 9 && elem.defaultView;
    }

    function isObject(value) {
        var type = typeof value;
        return type === 'function' || type === 'object' && !!value;
    }

    function isDOMNode(obj) {
        return isObject(obj) && obj.nodeType > 0;
    }

    function getWavesElements(nodes) {
        var stringRepr = toString.call(nodes);

        if (stringRepr === '[object String]') {
            return $$(nodes);
        } else if (isObject(nodes) && /^\[object (Array|HTMLCollection|NodeList|Object)\]$/.test(stringRepr) && nodes.hasOwnProperty('length')) {
            return nodes;
        } else if (isDOMNode(nodes)) {
            return [nodes];
        }

        return [];
    }

    function offset(elem) {
        var docElem, win,
            box = { top: 0, left: 0 },
            doc = elem && elem.ownerDocument;

        docElem = doc.documentElement;

        if (typeof elem.getBoundingClientRect !== typeof undefined) {
            box = elem.getBoundingClientRect();
        }
        win = getWindow(doc);
        return {
            top: box.top + win.pageYOffset - docElem.clientTop,
            left: box.left + win.pageXOffset - docElem.clientLeft
        };
    }

    function convertStyle(styleObj) {
        var style = '';

        for (var prop in styleObj) {
            if (styleObj.hasOwnProperty(prop)) {
                style += (prop + ':' + styleObj[prop] + ';');
            }
        }

        return style;
    }

    var Effect = {

        // Effect duration
        duration: 750,

        // Effect delay (check for scroll before showing effect)
        delay: 200,

        show: function (e, element, velocity) {

            // Disable right click
            if (e.button === 2) {
                return false;
            }

            element = element || this;

            // Create ripple
            var ripple = document.createElement('div');
            ripple.className = 'waves-ripple waves-rippling';
            element.appendChild(ripple);

            // Get click coordinate and element width
            var pos = offset(element);
            var relativeY = 0;
            var relativeX = 0;
            // Support for touch devices
            if ('touches' in e && e.touches.length) {
                relativeY = (e.touches[0].pageY - pos.top);
                relativeX = (e.touches[0].pageX - pos.left);
            }
            //Normal case
            else {
                relativeY = (e.pageY - pos.top);
                relativeX = (e.pageX - pos.left);
            }
            // Support for synthetic events
            relativeX = relativeX >= 0 ? relativeX : 0;
            relativeY = relativeY >= 0 ? relativeY : 0;

            var scale = 'scale(' + ((element.clientWidth / 100) * 3) + ')';
            var translate = 'translate(0,0)';

            if (velocity) {
                translate = 'translate(' + (velocity.x) + 'px, ' + (velocity.y) + 'px)';
            }

            // Attach data to element
            ripple.setAttribute('data-hold', Date.now());
            ripple.setAttribute('data-x', relativeX);
            ripple.setAttribute('data-y', relativeY);
            ripple.setAttribute('data-scale', scale);
            ripple.setAttribute('data-translate', translate);

            // Set ripple position
            var rippleStyle = {
                top: relativeY + 'px',
                left: relativeX + 'px'
            };

            ripple.classList.add('waves-notransition');
            ripple.setAttribute('style', convertStyle(rippleStyle));
            ripple.classList.remove('waves-notransition');

            // Scale the ripple
            rippleStyle['-webkit-transform'] = scale + ' ' + translate;
            rippleStyle['-moz-transform'] = scale + ' ' + translate;
            rippleStyle['-ms-transform'] = scale + ' ' + translate;
            rippleStyle['-o-transform'] = scale + ' ' + translate;
            rippleStyle.transform = scale + ' ' + translate;
            rippleStyle.opacity = '1';

            var duration = e.type === 'mousemove' ? 2500 : Effect.duration;
            rippleStyle['-webkit-transition-duration'] = duration + 'ms';
            rippleStyle['-moz-transition-duration'] = duration + 'ms';
            rippleStyle['-o-transition-duration'] = duration + 'ms';
            rippleStyle['transition-duration'] = duration + 'ms';

            ripple.setAttribute('style', convertStyle(rippleStyle));
        },

        hide: function (e, element) {
            element = element || this;

            var ripples = element.getElementsByClassName('waves-rippling');

            for (var i = 0, len = ripples.length; i < len; i++) {
                removeRipple(e, element, ripples[i]);
            }

            if (isTouchAvailable) {
                element.removeEventListener('touchend', Effect.hide);
                element.removeEventListener('touchcancel', Effect.hide);
            }

            element.removeEventListener('mouseup', Effect.hide);
            element.removeEventListener('mouseleave', Effect.hide);
        }
    };

    /**
     * Collection of wrapper for HTML element that only have single tag
     * like <input> and <img>
     */
    var TagWrapper = {

        // Wrap <input> tag so it can perform the effect
        input: function (element) {

            var parent = element.parentNode;

            // If input already have parent just pass through
            if (parent.tagName.toLowerCase() === 'i' && parent.classList.contains('waves-effect')) {
                return;
            }

            // Put element class and style to the specified parent
            var wrapper = document.createElement('i');
            wrapper.className = element.className + ' waves-input-wrapper';
            element.className = 'waves-button-input';

            // Put element as child
            parent.replaceChild(wrapper, element);
            wrapper.appendChild(element);

            // Apply element color and background color to wrapper
            var elementStyle = window.getComputedStyle(element, null);
            var color = elementStyle.color;
            var backgroundColor = elementStyle.backgroundColor;

            wrapper.setAttribute('style', 'color:' + color + ';background:' + backgroundColor);
            element.setAttribute('style', 'background-color:rgba(0,0,0,0);');

        },

        // Wrap <img> tag so it can perform the effect
        img: function (element) {

            var parent = element.parentNode;

            // If input already have parent just pass through
            if (parent.tagName.toLowerCase() === 'i' && parent.classList.contains('waves-effect')) {
                return;
            }

            // Put element as child
            var wrapper = document.createElement('i');
            parent.replaceChild(wrapper, element);
            wrapper.appendChild(element);

        }
    };

    /**
     * Hide the effect and remove the ripple. Must be
     * a separate function to pass the JSLint...
     */
    function removeRipple(e, el, ripple) {

        // Check if the ripple still exist
        if (!ripple) {
            return;
        }

        ripple.classList.remove('waves-rippling');

        var relativeX = ripple.getAttribute('data-x');
        var relativeY = ripple.getAttribute('data-y');
        var scale = ripple.getAttribute('data-scale');
        var translate = ripple.getAttribute('data-translate');

        // Get delay beetween mousedown and mouse leave
        var diff = Date.now() - Number(ripple.getAttribute('data-hold'));
        var delay = 350 - diff;

        if (delay < 0) {
            delay = 0;
        }

        if (e.type === 'mousemove') {
            delay = 150;
        }

        // Fade out ripple after delay
        var duration = e.type === 'mousemove' ? 2500 : Effect.duration;

        setTimeout(function () {

            var style = {
                top: relativeY + 'px',
                left: relativeX + 'px',
                opacity: '0',

                // Duration
                '-webkit-transition-duration': duration + 'ms',
                '-moz-transition-duration': duration + 'ms',
                '-o-transition-duration': duration + 'ms',
                'transition-duration': duration + 'ms',
                '-webkit-transform': scale + ' ' + translate,
                '-moz-transform': scale + ' ' + translate,
                '-ms-transform': scale + ' ' + translate,
                '-o-transform': scale + ' ' + translate,
                'transform': scale + ' ' + translate
            };

            ripple.setAttribute('style', convertStyle(style));

            setTimeout(function () {
                try {
                    el.removeChild(ripple);
                } catch (e) {
                    return false;
                }
            }, duration);

        }, delay);
    }


    /**
     * Disable mousedown event for 500ms during and after touch
     */
    var TouchHandler = {

        /* uses an integer rather than bool so there's no issues with
         * needing to clear timeouts if another touch event occurred
         * within the 500ms. Cannot mouseup between touchstart and
         * touchend, nor in the 500ms after touchend. */
        touches: 0,

        allowEvent: function (e) {

            var allow = true;

            if (/^(mousedown|mousemove)$/.test(e.type) && TouchHandler.touches) {
                allow = false;
            }

            return allow;
        },
        registerEvent: function (e) {
            var eType = e.type;

            if (eType === 'touchstart') {

                TouchHandler.touches += 1; // push

            } else if (/^(touchend|touchcancel)$/.test(eType)) {

                setTimeout(function () {
                    if (TouchHandler.touches) {
                        TouchHandler.touches -= 1; // pop after 500ms
                    }
                }, 500);

            }
        }
    };


    /**
     * Delegated click handler for .waves-effect element.
     * returns null when .waves-effect element not in "click tree"
     */
    function getWavesEffectElement(e) {

        if (TouchHandler.allowEvent(e) === false) {
            return null;
        }

        var element = null;
        var target = e.target || e.srcElement;

        while (target.parentElement) {
            if ((!(target instanceof SVGElement)) && target.classList.contains('waves-effect')) {
                element = target;
                break;
            }
            target = target.parentElement;
        }

        return element;
    }

    /**
     * Bubble the click and show effect if .waves-effect elem was found
     */
    function showEffect(e) {

        // Disable effect if element has "disabled" property on it
        // In some cases, the event is not triggered by the current element
        // if (e.target.getAttribute('disabled') !== null) {
        //     return;
        // }

        var element = getWavesEffectElement(e);

        if (element !== null) {

            // Make it sure the element has either disabled property, disabled attribute or 'disabled' class
            if (element.disabled || element.getAttribute('disabled') || element.classList.contains('disabled')) {
                return;
            }

            TouchHandler.registerEvent(e);

            if (e.type === 'touchstart' && Effect.delay) {

                var hidden = false;

                var timer = setTimeout(function () {
                    timer = null;
                    Effect.show(e, element);
                }, Effect.delay);

                var hideEffect = function (hideEvent) {

                    // if touch hasn't moved, and effect not yet started: start effect now
                    if (timer) {
                        clearTimeout(timer);
                        timer = null;
                        Effect.show(e, element);
                    }
                    if (!hidden) {
                        hidden = true;
                        Effect.hide(hideEvent, element);
                    }

                    removeListeners();
                };

                var touchMove = function (moveEvent) {
                    if (timer) {
                        clearTimeout(timer);
                        timer = null;
                    }
                    hideEffect(moveEvent);

                    removeListeners();
                };

                element.addEventListener('touchmove', touchMove, false);
                element.addEventListener('touchend', hideEffect, false);
                element.addEventListener('touchcancel', hideEffect, false);

                var removeListeners = function () {
                    element.removeEventListener('touchmove', touchMove);
                    element.removeEventListener('touchend', hideEffect);
                    element.removeEventListener('touchcancel', hideEffect);
                };
            } else {

                Effect.show(e, element);

                if (isTouchAvailable) {
                    element.addEventListener('touchend', Effect.hide, false);
                    element.addEventListener('touchcancel', Effect.hide, false);
                }

                element.addEventListener('mouseup', Effect.hide, false);
                element.addEventListener('mouseleave', Effect.hide, false);
            }
        }
    }

    Waves.init = function (options) {
        var body = document.body;

        options = options || {};

        if ('duration' in options) {
            Effect.duration = options.duration;
        }

        if ('delay' in options) {
            Effect.delay = options.delay;
        }

        if (isTouchAvailable) {
            body.addEventListener('touchstart', showEffect, false);
            body.addEventListener('touchcancel', TouchHandler.registerEvent, false);
            body.addEventListener('touchend', TouchHandler.registerEvent, false);
        }

        body.addEventListener('mousedown', showEffect, false);
    };


    /**
     * Attach Waves to dynamically loaded inputs, or add .waves-effect and other
     * waves classes to a set of elements. Set drag to true if the ripple mouseover
     * or skimming effect should be applied to the elements.
     */
    Waves.attach = function (elements, classes) {

        elements = getWavesElements(elements);

        if (toString.call(classes) === '[object Array]') {
            classes = classes.join(' ');
        }

        classes = classes ? ' ' + classes : '';

        var element, tagName;

        for (var i = 0, len = elements.length; i < len; i++) {

            element = elements[i];
            tagName = element.tagName.toLowerCase();

            if (['input', 'img'].indexOf(tagName) !== -1) {
                TagWrapper[tagName](element);
                element = element.parentElement;
            }

            if (element.className.indexOf('waves-effect') === -1) {
                element.className += ' waves-effect' + classes;
            }
        }
    };


    /**
     * Cause a ripple to appear in an element via code.
     */
    Waves.ripple = function (elements, options) {
        elements = getWavesElements(elements);
        var elementsLen = elements.length;

        options = options || {};
        options.wait = options.wait || 0;
        options.position = options.position || null; // default = centre of element


        if (elementsLen) {
            var element, pos, off, centre = {}, i = 0;
            var mousedown = {
                type: 'mousedown',
                button: 1
            };
            var hideRipple = function (mouseup, element) {
                return function () {
                    Effect.hide(mouseup, element);
                };
            };

            for (; i < elementsLen; i++) {
                element = elements[i];
                pos = options.position || {
                    x: element.clientWidth / 2,
                    y: element.clientHeight / 2
                };

                off = offset(element);
                centre.x = off.left + pos.x;
                centre.y = off.top + pos.y;

                mousedown.pageX = centre.x;
                mousedown.pageY = centre.y;

                Effect.show(mousedown, element);

                if (options.wait >= 0 && options.wait !== null) {
                    var mouseup = {
                        type: 'mouseup',
                        button: 1
                    };

                    setTimeout(hideRipple(mouseup, element), options.wait);
                }
            }
        }
    };

    /**
     * Remove all ripples from an element.
     */
    Waves.calm = function (elements) {
        elements = getWavesElements(elements);
        var mouseup = {
            type: 'mouseup',
            button: 1
        };

        for (var i = 0, len = elements.length; i < len; i++) {
            Effect.hide(mouseup, elements[i]);
        }
    };

    /**
     * Deprecated API fallback
     */
    Waves.displayEffect = function (options) {
        console.error('Waves.displayEffect() has been deprecated and will be removed in future version. Please use Waves.init() to initialize Waves effect');
        Waves.init(options);
    };

    Waves.init();
    return Waves;
});
