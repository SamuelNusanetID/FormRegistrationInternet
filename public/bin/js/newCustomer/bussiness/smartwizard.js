$(document).ready(function () {
    $('#smartwizard').smartWizard({
        selected: 0, // Initial selected step, 0 = first step
        theme: 'dots', // theme for the wizard, related css need to include for other than default theme
        justified: true, // Nav menu justification. true/false
        autoAdjustHeight: true, // Automatically adjust content height
        backButtonSupport: true, // Enable the back button support
        enableUrlHash: false, // Enable selection of the step based on url hash
        transition: {
            animation: 'fade', // Animation effect on navigation, none|fade|slideHorizontal|slideVertical|slideSwing|css(Animation CSS class also need to specify)
            speed: '400', // Animation speed. Not used if animation is 'css'
        },
        toolbar: {
            position: 'bottom', // none|top|bottom|both
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true,
            extraHtml: '<button class="btn btn-success" id="btnSubmitBussinessForms" type="submit"><i class="fas fa-save me-1"></i> Submit Form</button>' // show/hide a Previous button
        },
        anchor: {
            enableNavigation: true, // Enable/Disable anchor navigation
            enableNavigationAlways: false, // Activates all anchors clickable always
            enableDoneState: true, // Add done state on visited steps
            markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            unDoneOnBackNavigation: true, // While navigate back, done state will be cleared
            enableDoneStateNavigation: true // Enable/Disable the done state navigation
        },
        keyboard: {
            keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
            keyLeft: [37], // Left key code
            keyRight: [39] // Right key code
        },
        lang: { // Language variables for button
            next: 'Selanjutnya >>',
            previous: '<< Sebelumnya'
        },
        disabledSteps: [], // Array Steps disabled
        errorSteps: [], // Array Steps error
        warningSteps: [], // Array Steps warning
        hiddenSteps: [], // Hidden steps
        getContent: null // Callback function for content loading
    });

    jQuery.validator.addMethod("emailordomain", function (value, element) {
        return this.optional(element) || /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(value) || /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/.test(value);
    }, "Silahkan isi alamat email dengan domain yang valid");

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param * 1000000)
    }, 'File foto harus berukuran max. {0} MB');

    $('#bussinessForm').validate({
        rules: {
            pic_name: {
                required: true
            },
            pic_identity_number: {
                required: true,
                minlength: 16,
                maxlength: 16
            },
            pic_email_address: {
                required: true,
                email: true,
                emailordomain: true
            },
            pic_phone_number: {
                required: true,
                minlength: 7,
                maxlength: 12
            },
            geolocation_bussiness: {
                required: true
            },
            pic_address: {
                required: true
            },
            company_name: {
                required: true
            },
            company_address: {
                required: true
            },
            company_npwp: {
                required: true
            },
            company_phone_number: {
                required: true,
                minlength: 10,
                maxlength: 10
            },
            service_identity_photo: {
                required: true,
                accept: 'jpg,jpeg,png',
                filesize: 3
            },
            billing_name: {
                required: true
            },
            billing_phone: {
                required: true,
                minlength: 7,
                maxlength: 12
            },
            billing_email: {
                required: true,
                email: true,
                emailordomain: true
            },
            fullname_technical: {
                required: true
            },
            phone_number_technical: {
                required: true,
                minlength: 7,
                maxlength: 12
            },
            email_address_technical: {
                required: true,
                email: true,
                emailordomain: true
            },
            service_product: {
                required: true,
            },
            topRadioBtnBussiness: {
                required: true,
            }
        },
        messages: {
            pic_name: {
                required: 'Kolom Nama Lengkap Wajib Diisi'
            },
            pic_identity_number: {
                required: 'Kolom Nomor Identitas Wajib Diisi',
                minlength: 'Nomor Identitas harus mengandung min. 16 karakter',
                maxlength: 'Nomor Identitas melewati batas karakter'
            },
            pic_email_address: {
                required: 'Kolom Alamat Email Wajib Diisi',
                email: 'Alamat Email Tidak Valid'
            },
            pic_phone_number: {
                required: 'Kolom Nomor Handphone Wajib Diisi',
                minlength: 'Nomor Handphone harus mengandung min. 7 karakter',
                maxlength: 'Nomor Handphone melewati batas karakter'
            },
            pic_address: {
                required: 'Kolom Alamat Lengkap Wajib Diisi'
            },
            company_name: {
                required: 'Kolom Nama Perusahaan Wajib Diisi'
            },
            company_address: {
                required: 'Kolom Alamat Lengkap Perusahaan Wajib Diisi'
            },
            company_npwp: {
                required: 'Kolom NPWP Perusahaan Wajib Diisi'
            },
            company_phone_number: {
                required: 'Kolom Nomor Telepon Perusahaan Wajib Diisi',
                minlength: 'Nomor Telepon Perusahaan harus mengandung min. 10 karakter',
                maxlength: 'Nomor Telepon Perusahaan melewati batas karakter'
            },
            service_identity_photo: {
                required: 'Kolom Upload Foto KTP Wajib Diisi',
                accept: 'Foto KTP harus berformat jpeg, jpg, atau png'
            },
            service_selfie_photo: {
                required: 'Kolom Upload Foto Selfie dan KTP Wajib Diisi',
                accept: 'Foto Selfie dan KTP harus berformat jpeg, jpg, atau png'
            },
            billing_name: {
                required: 'Kolom Nama Lengkap Pembayaran Wajib Diisi'
            },
            billing_phone: {
                required: 'Kolom Nomor Handphone Pembayaran Wajib Diisi',
                minlength: 'Nomor Handphone Pembayaran harus mengandung min. 7 karakter',
                maxlength: 'Nomor Handphone Pembayaran melewati batas karakter'
            },
            billing_email: {
                required: 'Kolom Alamat Email Pembayaran Wajib Diisi',
                email: 'Alamat Email Pembayaran tidak valid',
            },
            fullname_technical: {
                required: 'Kolom Nama Lengkap Teknikal Wajib Diisi'
            },
            phone_number_technical: {
                required: 'Kolom Nomor Handphone Teknikal Wajib Diisi',
                minlength: 'Nomor Handphone Teknikal harus mengandung min. 7 karakter',
                maxlength: 'Nomor Handphone Teknikal melewati batas karakter'
            },
            email_address_technical: {
                required: 'Kolom Alamat Email Teknikal Wajib Diisi',
                email: 'Alamat Email Teknikal tidak valid',
            },
            service_product: {
                required: 'Kolom Pilihan Layanan Wajib Diisi',
            },
            topRadioBtnBussiness: {
                required: 'Kolom Jenis Pembayaran Wajib Diisi',
            }
        }
    });

    $('#smartwizard').on("leaveStep", function (e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
        var elmForm = $("#form-step-" + currentStepIndex);
        console.log($('#bussinessForm').valid());
        if (stepDirection === 'forward' && elmForm) {
            if ($('#bussinessForm').valid()) {
                return true
            } else {
                return false
            }
        }
        return true;
    })

    $("#btnSubmitBussinessForms").toggle(false);

    $('#termsCbo').click(function () {
        $("#btnSubmitBussinessForms").toggle(this.checked);
    });

    $("#btnSubmitBussinessForms").on('click', () => {
        $("#bussinessForm").trigger('submit');
    })
});
