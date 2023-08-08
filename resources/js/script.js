document.addEventListener('DOMContentLoaded', function () {
    "use strict";
    const body = $('body');
    body.on('change', '#wbsSelectLang', function () {
        const _this = $(this), currentLocation = $(location).attr('hostname'),
            currentPatch = $(location).attr('pathname');

        if (_this.val() !== 'fa') {
            window.location.href = 'http://' + currentLocation + '/' + _this.val() + currentPatch;
        } else {
            window.location.href = 'http://' + currentLocation + currentPatch.replace('/en', '');
        }
    });
}, false);
