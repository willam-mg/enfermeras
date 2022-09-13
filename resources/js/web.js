document.addEventListener("DOMContentLoaded", function () {
    $('.disabled-onsubmit').on('submit', function () {
        $(this).find(':submit').attr('disabled', 'true');
    })
});