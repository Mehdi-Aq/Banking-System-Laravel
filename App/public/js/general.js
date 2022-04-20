$(document).ready(function() {
    $('#amount').attr('max', $(this).find(':selected').data('balance'));

    $('#account_nos').change(function () {
        $('#amount').attr('max', $(this).find(':selected').data('balance'));
    })

    $('.accept').on('click', function() {
        let transaction_no = this.value;
        let account_no = $(`#${this.value}`).val();

        console.log(`trans_no: ${transaction_no}, account_no: ${account_no}`)
    })

    $('.decline').on('click', function(e) {
        let transaction_no = this.value;
        if (!confirm("Are you in the right state of mind to decline this transfer?")) {
            e.preventDefault();
        };
    })

    $('.cancel').on('click', function(e) {
        let transaction_no = this.value;
        if (!confirm("Are you sure you want to cancel the transfer?")) {
            e.preventDefault();
        };
    })
});
