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
            showPreviousButton: true, // show/hide a Previous button
            extraHtml: '<button class="btn btn-success" id="btnSubmitPersonalForms" type="button"><i class="fas fa-save me-1"></i> Submit Form</button>' // Extra html to show on toolbar
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
        getContent: provideContent // Callback function for content loading
    });

    function provideContent(idx, stepDirection, stepPosition, selStep, callback) {
        if (idx == 4) {
            $('#tnc-home').addClass('d-none');
            $('#tnc-bussiness').addClass('d-none');
            $('#tnc-dedicated').addClass('d-none');
            const namaPaket = $("#package_name").val();

            switch (namaPaket) {
                case "Broadband Home":
                    $('#tnc-home').removeClass('d-none');
                    $('#tnc-bussiness').addClass('d-none');
                    $('#tnc-dedicated').addClass('d-none');
                    break;
                case "Broadband Bussiness":
                    $('#tnc-home').addClass('d-none');
                    $('#tnc-bussiness').removeClass('d-none');
                    $('#tnc-dedicated').addClass('d-none');
                    break;
                case "Dedicated 1 : 1":
                    $('#tnc-home').addClass('d-none');
                    $('#tnc-bussiness').addClass('d-none');
                    $('#tnc-dedicated').removeClass('d-none');
                    break;
                case "Dedicated 1 : 4":
                    $('#tnc-home').addClass('d-none');
                    $('#tnc-bussiness').addClass('d-none');
                    $('#tnc-dedicated').removeClass('d-none');
                    break;
                default:
                    $('#tnc-home').addClass('d-none');
                    $('#tnc-bussiness').removeClass('d-none');
                    $('#tnc-dedicated').addClass('d-none');
                    break;
            }
        }
        callback();
    }

    jQuery.validator.addMethod("emailordomain", function (value, element) {
        return this.optional(element) || /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(value) || /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/.test(value);
    }, "Silahkan isi alamat email dengan domain yang valid");

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param * 1048576)
    }, 'File foto harus berukuran max. {0} MB');

    $('#personalForm').validate({
        errorPlacement: (error, element) => {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
            fullname_personal: {
                required: true
            },
            option_id_number_personal: {
                required: true
            },
            email_address_personal: {
                required: true,
                email: true,
                emailordomain: true
            },
            phone_number_personal: {
                required: true,
                minlength: 7,
                maxlength: 12
            },
            address_personal: {
                required: true
            },
            geolocation_personal: {
                required: true
            },
            service_identity_photo: {
                required: true,
                accept: 'jpg,jpeg,png',
                filesize: 3
            },
            additionalnpwpphotopersonal: {
                accept: 'jpg,jpeg,png',
                filesize: 3
            },
            fullname_biller: {
                required: true
            },
            phone_number_biller: {
                required: true,
                minlength: 7,
                maxlength: 12
            },
            email_address_biller_primary: {
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
            custom_bulanan: {
                required: true,
            }
        },
        messages: {
            fullname_personal: {
                required: 'Kolom Nama Lengkap Wajib Diisi'
            },
            option_id_number_personal: {
                required: 'Kolom Opsi Pilihan Identitas Wajib Diisi'
            },
            email_address_personal: {
                required: 'Kolom Alamat Email Wajib Diisi',
                email: 'Alamat Email tidak valid'
            },
            phone_number_personal: {
                required: 'Kolom Nomor Handphone Wajib Diisi',
                minlength: 'Nomor Handphone harus mengandung min. 7 karakter',
                maxlength: 'Nomor Handphone melewati batas karakter'
            },
            address_personal: {
                required: 'Kolom Alamat Lengkap Wajib Diisi'
            },
            service_identity_photo: {
                required: 'Kolom Upload Foto KTP Wajib Diisi',
                accept: 'Foto KTP harus berformat jpeg, jpg, atau png',
            },
            additionalnpwpphotopersonal: {
                accept: 'File NPWP harus berformat jpeg, jpg, atau png',
            },
            fullname_biller: {
                required: 'Kolom Nama Lengkap Pembayaran Wajib Diisi'
            },
            phone_number_biller: {
                required: 'Kolom Nomor Handphone Pembayaran Wajib Diisi',
                minlength: 'Nomor Handphone Pembayaran harus mengandung min. 7 karakter',
                maxlength: 'Nomor Handphone Pembayaran melewati batas karakter'
            },
            email_address_biller_primary: {
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
            custom_bulanan: {
                required: 'Kolom Custom Bulan Wajib Diisi'
            }
        }
    });

    $('select[name="option_id_number_personal"]').on('change', function () {
        var settings = $('#personalForm').validate().settings;
        delete settings.rules.id_number_personal;
        delete settings.messages.id_number_personal;

        if ($(this).val() == "KTP") {
            settings.rules.id_number_personal = {
                required: true,
                minlength: 16,
                maxlength: 16
            };
            settings.messages.id_number_personal = {
                required: "Field Nomor KTP Wajib Diisi",
                minlength: "Minimal karakter Nomor KTP adalah 16 karakter",
                maxlength: "Maximal karakter Nomor KTP adalah 16 karakter"
            };
        } else if ($(this).val() == "KITAS") {
            settings.rules.id_number_personal = {
                required: true,
                minlength: 11,
                maxlength: 11
            };
            settings.messages.id_number_personal = {
                required: "Field Nomor KITAS Wajib Diisi",
                minlength: "Minimal karakter Nomor KITAS adalah 11 karakter",
                maxlength: "Maximal karakter Nomor KITAS adalah 11 karakter"
            };
        } else if ($(this).val() == "PASPOR") {
            settings.rules.id_number_personal = {
                required: true,
                minlength: 8,
                maxlength: 8
            };
            settings.messages.id_number_personal = {
                required: "Field Nomor Paspor Wajib Diisi",
                minlength: "Minimal karakter Nomor Paspor adalah 8 karakter",
                maxlength: "Maximal karakter Nomor Paspor adalah 8 karakter"
            };
        }
    });

    $('#smartwizard').on("leaveStep", function (e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
        var elmForm = $("#form-step-" + currentStepIndex);
        if (stepDirection === 'forward' && elmForm) {
            if ($('#personalForm').valid()) {
                return true
            } else {
                return false
            }
        }
        return true;
    })

    $("#btnSubmitPersonalForms").toggle(false);

    $('#termsCbo').click(function () {
        $("#btnSubmitPersonalForms").toggle(this.checked);
    });

    $("#btnSubmitPersonalForms").on('click', () => {
        $("#personalForm").trigger('submit');
    })
});
