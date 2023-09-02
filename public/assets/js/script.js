jQuery(function ($) {
    "use strict";
    const body = $('body');
    let xhr;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    is_select2();
    wbsSelect2Ajax();
    body.on('change', '#wbsSelectLang', function () {
        const _this = $(this), currentLocation = $(location).attr('hostname'),
            currentPatch = $(location).attr('pathname');

        if (_this.val() !== 'fa') {
            window.location.href = 'http://' + currentLocation + '/' + _this.val() + currentPatch;
        } else {
            window.location.href = 'http://' + currentLocation + currentPatch.replace('/en', '');
        }
    });
    body.on('click', '.wbs-panel:not(.no-toggle) header', function () {
        const _this = $(this);
        _this.toggleClass('open').next('.content').stop(true, true).slideToggle();
    });

    if ($('#country option:selected').length > 0) {
        wbsSelect2Ajax('#city', {country: $('#country').val()});
    }

    body.on('change', '#country', function () {
        $('#countryTitle').val($('#country option:selected').text());
        wbsSelect2Ajax('#city', {country: $('#country').val()});
        $('#city').removeAttr('disabled');
    });

    $("#searchInTable").on("keyup", function () {
        const _this = $(this);
        var value = $(this).val().toLowerCase();
        _this.parents('.main-content').find(".content table tbody tr:not(.not-found)").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        if (_this.parents('.main-content').find(".content table tbody tr:not(.not-found):visible").length === 0) {
            if ($('.not-found').length === 0) {
                _this.parents('.main-content').find(".content table tbody").append('<tr class="not-found"><td colspan="10" class="text-center">' + translate['Nothing found!'] + '</td></tr>');
            }
        } else {
            $('.not-found').remove();
        }
    });

    if ($('#from_date').length > 0) {
        new mds.MdsPersianDateTimePicker(document.getElementById('from_date'), {
            groupId: 'filterDate',
            selectedDate: $('#from_date_en').val().length > 0 ? new Date($('#from_date_en').val()) : undefined,
            targetTextSelector: '#from_date',
            targetDateSelector: '#from_date_en',
            fromDate: true
        });

        new mds.MdsPersianDateTimePicker(document.getElementById('to_date'), {
            groupId: 'filterDate',
            selectedDate: $('#to_date_en').val().length > 0 ? new Date($('#to_date_en').val()) : undefined,
            targetTextSelector: '#to_date',
            targetDateSelector: '#to_date_en',
            toDate: true
        });
    }

    body.on('click', '.delete-item', function () {
        if (!confirm(translate['Are you sure to delete the desired item?']) === true) {
            return false;
        }
    });

    function is_select2(elem = '.is-select2') {
        $(elem).select2({
            width: "100%"
        });
    }

    function wbsSelect2Ajax(selector = '.wbsAjaxSelect2', customParams = []) {
        const elem = $(selector);
        elem.each(function () {
            const url = $(this).attr('data-url');
            $(this).select2({
                width: '100%',
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,
                    type: 'POST',
                    data: function (params) {
                        return {
                            q: params.term,
                            page: params.page,
                            customParams: customParams
                        };
                    },
                    processResults: function (data) {
                        var options = [];
                        if (data) {
                            // data is the array of arrays, and each of them contains ID and the Label of the option
                            $.each(data, function (index, text) { // do not forget that "index" is just auto incremented value
                                options.push({id: index, text: text});
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
        });
    }

    function wbsAjax(url, data, dataType, successCallback = null, errorCallback = null, completeCallback = null) {
        if (xhr && xhr.readyState != 4) {
            xhr.abort();
        }
        xhr = $.ajax({
            url: url,
            type: 'POST',
            dataType: dataType,
            data: data,
            success: function (response) {
                successCallback(response);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                if (errorCallback !== null) {
                    errorCallback(thrownError);
                }
            },
            complete: function () {
                if (completeCallback !== null) {
                    completeCallback();
                }
            }
        });
    }
});
