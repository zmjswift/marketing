jQuery(document).ready(function ($) {
    $('body').on('click', '.fa-qrcode', function () {
        var currentPageUrl = window.location.href;

        var qrCodeUrl = 'https://api.pwmqr.com/qrcode/create/?url=' + encodeURIComponent(currentPageUrl);

        var modalContent = $('<div class="modal-content" style="width: 300px;height: auto;">').append(
            $('<div class="modal-header">').append(
                $('<h5 class="modal-title">').text('Scan the QR code')
            ),
            $('<div class="modal-body">').append(
                $('<img>').attr('src', qrCodeUrl).addClass('img-fluid')
            )
        );

        var modalDialog = $('<div class="modal-dialog modal-dialog-centered">').append(modalContent);
        var modal = $('<div class="modal fade" tabindex="-1">').append(modalDialog);

        $('body').append(modal);

        modal.modal('show');

        modal.on('hidden.bs.modal', function (e) {
            modal.remove();
        });
    });
});
