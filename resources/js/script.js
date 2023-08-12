document.addEventListener('DOMContentLoaded', function () {
    "use strict";
    const body = $('body');
    is_select2();
    select2Ajax();
    body.on('change', '#wbsSelectLang', function () {
        const _this = $(this), currentLocation = $(location).attr('hostname'),
            currentPatch = $(location).attr('pathname');

        if (_this.val() !== 'fa') {
            window.location.href = 'http://' + currentLocation + '/' + _this.val() + currentPatch;
        } else {
            window.location.href = 'http://' + currentLocation + currentPatch.replace('/en', '');
        }
    });
    body.on('click', '.wbs-panel header', function () {
        const _this = $(this);
        _this.toggleClass('open').next('.content').stop(true, true).slideToggle();
    });

    function is_select2(elem = '.is-select2') {
        $(elem).select2({
            width: "100%"
        });
    }

    function select2Ajax(selector = '.wbsAjaxSelect2') {
        const elem = $(selector);
        elem.select2({
            width: '100%',
            ajax: {
                url: '/getCountries/',
                dataType: 'json',
                delay: 250,
                type: 'POST',
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page,
                    };
                },
                processResults: function (data) {
                    var options = [];
                    if (data) {

                        // data is the array of arrays, and each of them contains ID and the Label of the option
                        $.each(data, function (index, text) { // do not forget that "index" is just auto incremented value
                            options.push({id: text[0], text: text[1]});
                        });

                    }
                    return {
                        results: options
                    };
                },
                cache: true
            },
            minimumInputLength: 1,
            escapeMarkup: function (markup) {
                return markup;
            }
        });
    }
}, false);
