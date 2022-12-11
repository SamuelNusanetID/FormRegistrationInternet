$('#oldCustomerForm').validate({
    errorPlacement: (error, element) => {
        if (element.parent('.input-group').length) {
            $(element).addClass('is-invalid');
            error.insertAfter(element.parent());
        } else if (element.parent('.form-check').length) {
            var idOfRadioButton = element.attr('id').split('_')[0];
            $(`input[type=radio][name=${idOfRadioButton}]`).each(e => {
                var idrboval = $(`input[type=radio][name=${idOfRadioButton}]`)[e]
                    .id;
                $(`#${idrboval}`).addClass('is-invalid');
            });
            error.insertAfter($(`#${idOfRadioButton}`));
        } else {
            $(element).addClass('is-invalid');
            error.insertAfter(element);
        }
    },
    rules: {
        branch_id: {
            required: true,
        },
        package_name: {
            required: true,
        },
        inlineTopPaket: {
            required: true,
        },
        custom_bulanan_tahunan: {
            required: true,
        }
    },
    messages: {
        branch_id: {
            required: 'Kolom Regional Wajib Diisi',
        },
        package_name: {
            required: 'Kolom Nama Paket Wajib Diisi',
        },
        inlineTopPaket: {
            required: 'Kolom Jangka Waktu Pembayaran Wajib Diisi'
        },
        custom_bulanan_tahunan: {
            required: 'Kolom Custom Bulan Wajib Diisi'
        }
    }
});

$('#smartwizard').on("leaveStep", function (e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
    var elmForm = $("#form-step-" + currentStepIndex);
    if (stepDirection === 'forward' && elmForm) {
        if ($('#oldCustomerForm').valid()) {
            return true
        } else {
            return false
        }
    }
    return true;
})
