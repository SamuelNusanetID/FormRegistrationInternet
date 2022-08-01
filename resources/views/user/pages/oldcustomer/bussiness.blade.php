@extends('user.layouts.main')

@section('CSS')
    <!-- Smart Wizard -->
    <link href="{{ URL::to('lib/jquery-smartwizard/dist/css/smart_wizard_dots.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::to('bin/css/terms.css') }}">
@endsection

@section('content-wrapper')
    <div class="container p-0 p-sm-5 mb-3 mb-md-0">
        <div class="card mx-0 mx-sm-5">
            <div class="card-body">
                <h2 class="text-center fw-bold mt-2 mb-4">Form Registrasi Layanan Baru</h2>
                <!-- SmartWizard html -->
                <form action="{{ URL::to('old-member/bussiness/' . $_GET['id']) }}" method="POST" id="bussinessForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div id="smartwizard">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#person-in-charge">
                                    <div class="num"><i class="fa-solid fa-user"></i></div>
                                    Data Penanggung Jawab
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#billing-info">
                                    <span class="num"><i class="fa-solid fa-money-bill-wave"></i></span>
                                    Data Billing
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#technical-info">
                                    <span class="num"><i class="fa-solid fa-list-check"></i></span>
                                    Data Teknis
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#service-info">
                                    <span class="num"><i class="fas fa-people-carry"></i></span>
                                    Data Layanan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#terms-info">
                                    <span class="num"><i class="fas fa-scroll"></i></span>
                                    Syarat & Ketentuan
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="container row">
                                <div class="col-0 col-md-6">
                                    <input type="hidden" name="uuid" value="{{ Request::segment(3) }}">
                                    <div class="mb-3">
                                        <label for="pic_name" class="form-label">Nama
                                            Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('pic_name') is-invalid @enderror"
                                            id="pic_name" name="pic_name" placeholder="Masukkan Nama Lengkap Anda..."
                                            value="{{ old('pic_name', $oldDataCustomer['name']) }}" readonly>
                                        @error('pic_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="identity_number" class="form-label">Nomor Identitas
                                            (KTP/SIM/KITAS) <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('identity_number') is-invalid @enderror"
                                            id="identity_number" name="identity_number"
                                            placeholder="Masukkan Nomor Identitas Anda..."
                                            value="{{ old('identity_number') }}" readonly>
                                        @error('identity_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email_address" class="form-label">Alamat Email
                                            <span class="text-danger">*</span></label>
                                        <input type="email"
                                            class="form-control @error('email_address') is-invalid @enderror"
                                            id="email_address" name="email_address"
                                            placeholder="Masukkan Alamat E-Mail Anda..." value="{{ old('email_address') }}"
                                            readonly>
                                        @error('email_address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">Nomor HP/WA yang aktif
                                            <span class="text-danger">*</span></label>
                                        <input type="tel"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            id="phone_number" name="phone_number"
                                            placeholder="Masukkan Nomor Handphone/Whatsapp Anda..."
                                            value="{{ old('phone_number') }}" readonly>
                                        @error('phone_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="pic_address" class="form-label">Alamat Lengkap <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control @error('pic_address') is-invalid @enderror" id="pic_address" name="pic_address"
                                            aria-describedby="pic_address_help" rows="4" placeholder="Masukkan Alamat Lengkap Anda..." readonly>{{ old('pic_address') }}</textarea>
                                        <div id="pic_address_help" class="form-text mb-1">Alamat ini digunakan
                                            sebagai
                                            alamat pemasangan perangkat.</div>
                                        @error('pic_address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-0 col-md-6">
                                    <div class="mb-3">
                                        <label for="company_name" class="form-label">Nama Perusahaan
                                            <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('company_name') is-invalid @enderror"
                                            id="company_name" name="company_name"
                                            placeholder="Masukkan Nama Perusahaan Anda..."
                                            value="{{ old('company_name') }}" readonly>
                                        @error('company_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="company_address" class="form-label">Alamat Perusahaan
                                            <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('company_address') is-invalid @enderror" id="company_address"
                                            name="company_address" placeholder="Masukkan Alamat Perusahaan Anda..." rows="4" readonly>{{ old('company_address') }}</textarea>
                                        @error('company_address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="company_npwp" class="form-label">No. NPWP Perusahaan
                                            <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('company_npwp') is-invalid @enderror"
                                            id="company_npwp" name="company_npwp"
                                            placeholder="Masukkan Nomor NPWP Perusahaan Anda..."
                                            value="{{ old('company_npwp') }}" readonly>
                                        @error('company_npwp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="company_phone_number" class="form-label">No. Telepon Perusahaan
                                            <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('company_phone_number') is-invalid @enderror"
                                            id="company_phone_number" name="company_phone_number"
                                            placeholder="Masukkan Nomor Telepon Perusahaan Anda..."
                                            value="{{ old('company_phone_number') }}" readonly>
                                        @error('company_phone_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="company_employees" class="form-label">Jumlah Karyawan</label>
                                        <input type="text"
                                            class="form-control @error('company_employees') is-invalid @enderror"
                                            id="company_employees" name="company_employees"
                                            placeholder="Masukkan Jumlah Karyawan di Perusahaan Anda..."
                                            value="{{ old('company_employees') }}" readonly>
                                        @error('company_employees')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Include optional progressbar HTML -->
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <a href="{{ URL::to('/old-member') }}" class="btn btn-primary mb-3">
            <i class="fas fa-arrow-alt-circle-left me-1"></i>
            Kembali Ke Halaman Sebelumnya
        </a>
    </div>
@endsection

@section('JS')
    <!-- Bootstrap 5.1 -->
    <script src="{{ URL::to('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Smart Wizard -->
    <script src="{{ URL::to('lib/jquery-smartwizard/dist/js/jquery.smartWizard.min.js') }}" type="text/javascript">
    </script>
    <script>
        $(document).ready(function() {
            $('#smartwizard').smartWizard({
                selected: 0, // Initial selected step, 0 = first step
                theme: 'dots', // theme for the wizard, related css need to include for other than default theme
                justified: true, // Nav menu justification. true/false
                autoAdjustHeight: true, // Automatically adjust content height
                backButtonSupport: true, // Enable the back button support
                enableUrlHash: true, // Enable selection of the step based on url hash
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
                hiddenSteps: [1, 2], // Hidden steps
                getContent: null // Callback function for content loading
            });

            $("#btnSubmitBussinessForms").toggle(false);

            $('#termsCbo').click(function() {
                $("#btnSubmitBussinessForms").toggle(this.checked);
            });

            setInputFilter(document.getElementById("identity_personal_number"), function(value) {
                return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
            }, "Nomor Identitas harus berupa angka");
            setInputFilter(document.getElementById("billing_phone"), function(value) {
                return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
            }, "Nomor Handphone harus berupa angka");

            $("#btnSubmitBussinessForms").on('click', () => {
                $("#bussinessForm").trigger('submit');
            })
        });

        function setInputFilter(textbox, inputFilter, errMsg) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"]
            .forEach(function(event) {
                textbox.addEventListener(event, function(e) {
                    if (inputFilter(this.value)) {
                        // Accepted value
                        if (["keydown", "mousedown", "focusout"].indexOf(e.type) >= 0) {
                            this.classList.remove("input-error");
                            this.setCustomValidity("");
                        }
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        // Rejected value - restore the previous one
                        this.classList.add("input-error");
                        this.setCustomValidity(errMsg);
                        this.reportValidity();
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    } else {
                        // Rejected value - nothing to restore
                        this.value = "";
                    }
                });
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            // Nomor KTP
            var IDNumberBussiness = {!! json_encode($oldDataCustomer['identity_number']) !!};
            $('#identity_number').val(masking(IDNumberBussiness, 10));

            // Alamat Email
            var EmailBussiness = {!! json_encode($oldDataCustomer['email']) !!};
            $('#email_address').val(masking(EmailBussiness, 15));

            // Nomor HP
            var NPWPBussiness = {!! json_encode($oldDataCustomer['company_npwp']) !!};
            $('#phone_number').val(masking(NPWPBussiness, 10));
        });

        function masking(value, maskingSum) {
            return value.replace(value.substr(value.length - maskingSum),
                generateMask(
                    maskingSum));
        }

        function generateMask(jumlahMask) {
            var newStr = [];
            for (let index = 0; index < jumlahMask; index++) {
                newStr[index] = '*';
            }

            return newStr.join('');
        }
    </script>
@endsection
