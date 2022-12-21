function printInWindow(url) {
    $.get(url, function (data) {
        var w = window.open("", "Imprimir", "width=800,scrollbars=yes,resizable=yes,status=yes");
        w.document.write(data);
        setTimeout(() => {
            w.print();
            w.close();
        }, 2000);
    });
}
document.addEventListener("DOMContentLoaded", function () {
    $('.disabled-onsubmit').on('submit', function () {
        $(this).find(':submit').attr('disabled', 'true');
    });

    window.addEventListener('modal', (event) => {
        $(`#modal-${event.detail.component}`).modal(event.detail.event);
    });
    window.addEventListener('switalert', (event) => {
        let data = event.detail;
        Swal.fire({
            icon: data.type,
            title: data.title,
            text: data.message
        })
    });
    window.addEventListener('browserPrint', event => {
        printInWindow(event.detail.url);
    });

    $(document).ready(function () {
        // $("body").tooltip({ selector: '[data-toggle=tooltip]' });
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
});
