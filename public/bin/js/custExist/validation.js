$('#oldCustomerForm').validate({
    errorPlacement: (error, element) => {
        if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
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
        package_type: {
            required: true,
        },
        package_categories: {
            required: true,
        },
        inlineTopPaket: {
            required: true,
        },
        inlineTopPaketType: {
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
        package_type: {
            required: 'Kolom Tipe Paket Wajib Diisi',
        },
        package_categories: {
            required: 'Kolom Kategori Paket Wajib Diisi'
        },
        inlineTopPaket: {
            required: 'Kolom Jangka Waktu Pembayaran Wajib Diisi'
        },
        inlineTopPaketType: {
            required: 'Kolom Tipe Harga Wajib Diisi'
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
