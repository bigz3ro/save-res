var ajaxLock = false;

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
    // $('.timeago').timeago();
    confirmModal.init();
});
/* Confirm modal */
var confirmModal = {
    yesCallBack: null,
    noCallBack: null,
    text: null,
    level: null,
    data: null,
    init: function () {// Initialize
        $('#btn-confirm-no').click(function () {
            if (confirmModal.noCallBack) {
                confirmModal.noCallBack(confirmModal.data);
            }
            $('#modal-confirm').modal('hide');
        });
        $('#btn-confirm-yes').click(function () {
            if (confirmModal.yesCallBack) {
                confirmModal.yesCallBack(confirmModal.data);
            }
            $('#modal-confirm').modal('hide');
        });
    },
    reset: function () {
        $('#confirm-title').attr('class', 'modal-title');
        $('#btn-confirm-yes').removeClass('btn-danger btn-warning btn-primary');
        this.yesCallBack = null,
        this.noCallBack = null,
        this.text = null,
        this.level = 'warning';
        this.data = null;
    },
    showConfirm: function (text, level, yesCallBack, noCallBack, data) {
        this.reset();
        this.text = text;
        if (level) {
            this.level = level;
        }
        if (yesCallBack) {
            this.yesCallBack = yesCallBack;
        }
        if (noCallBack) {
            this.noCallBack = noCallBack;
        }
        if (data) {
            this.data = data;
        }
        this.showConfirmModal();
    },
    showConfirmModal: function () {
        if (this.level == 'danger') {
            $('#confirm-title').addClass('text-danger');
            $('#btn-confirm-yes').addClass('btn-danger');
        } else if (this.level == 'warning') {
            $('#confirm-title').addClass('text-warning');
            $('#btn-confirm-yes').addClass('btn-warning');
        } else if (this.level == 'info') {
            $('#confirm-title').addClass('text-info');
            $('#btn-confirm-yes').addClass('btn-primary');
        }

        $('#confirm-message').html(this.text);
        $('#modal-confirm').modal('show');
    },
};
var Loading = {
    show: function() {
        $("#loading").show();
    },
    hide: function() {
        $("#loading").hide();
    }
};
