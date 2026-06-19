(function ($) {
    "use strict";
    class Sidebar {
        constructor() {
            const pathname = location.pathname
            $('.app-sidebar').find('a[href]')?.each((index, element) => {
                const href = $(element).attr('href')
                $(element).closest('ul')?.find('li').each((index, element) => {
                    $(element).removeClass('active')
                })
                if (href === pathname) {
                    const $toggle = $(element).closest('[id].collapse').closest('li')?.find('button[data-toggle="collapse"]')
                    $(element).closest('[id].collapse')?.collapse('show')
                    setTimeout(() => {
                        $(element).closest('li')?.addClass('active')
                    }, 500)
                }
            })

            $('[data-toggle="app-sidebar"]')?.on('click', (event) => {
                event.preventDefault();
                // $('#sidebar').toggle()
                $('#sidebar').toggleClass('sidebar-none')
            })
        }
    }

    new Sidebar(); //
})(jQuery);