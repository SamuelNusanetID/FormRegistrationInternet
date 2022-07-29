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
                <form action="{{ URL::to('old-member/personal/' . $_GET['id']) }}" method="POST" id="personalForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div id="smartwizard">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#personal-info">
                                    <div class="num"><i class="fa-solid fa-user"></i></div>
                                    Data Personal
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
                            <div id="personal-info" class="tab-pane" role="tabpanel" aria-labelledby="personal-info">
                                <div class="container row">
                                    <div class="col-0 col-md-6">
                                        <input type="hidden" name="uuid" value="{{ Request::segment(3) }}">
                                        <div class="mb-3">
                                            <label for="idpelanggan_personal" class="form-label">ID Pelanggan <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="idpelanggan_personal"
                                                name="idpelanggan_personal" value="{{ $_GET['id'] }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="fullname_personal" class="form-label">Nama
                                                Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="fullname_personal"
                                                name="fullname_personal" value="{{ $oldDataCustomer['name'] }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_number_personal" class="form-label">Nomor Identitas
                                                (KTP/SIM/KITAS) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="id_number_personal"
                                                name="id_number_personal" readonly>
                                        </div>
                                    </div>
                                    <div class="col-0 col-md-6">
                                        <div class="mb-3">
                                            <label for="email_address_personal" class="form-label">Alamat Email
                                                <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email_address_personal"
                                                name="email_address_personal" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone_number_personal" class="form-label">Nomor HP/WA yang aktif
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="phone_number_personal"
                                                name="phone_number_personal" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address_personal" class="form-label">Alamat Lengkap <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" id="address_personal" name="address_personal" rows="5"
                                                placeholder="Masukkan Alamat Lengkap Anda..." readonly>{{ $oldDataCustomer['address'] }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="billing-info" class="tab-pane" role="tabpanel" aria-labelledby="billing-info">
                                <div class="container row">
                                    <div class="col-0 col-md-6">
                                        <div class="mb-3">
                                            <label for="fullname_biller" class="form-label">Nama
                                                Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control-plaintext" id="fullname_biller"
                                                name="fullname_biller" value="{{ $oldDataCustomer['billing_name'] }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone_number_biller" class="form-label">Nomor Handphone
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control-plaintext" id="phone_number_biller"
                                                name="phone_number_biller"
                                                value="{{ $oldDataCustomer['billing_contact'] }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email_address_biller" class="form-label">Alamat Email
                                                <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control-plaintext"
                                                id="email_address_biller" name="email_address_biller"
                                                value="{{ json_decode($oldDataCustomer['billing_email'])[0] }}">
                                        </div>
                                    </div>
                                    <div class="col-0 col-md-6">
                                        @if (count(json_decode($oldDataCustomer['billing_email'])) > 1)
                                            <div class="mb-3">
                                                <label for="email_address_one" class="form-label">Alamat Email Alternatif
                                                    1
                                                </label>
                                                <input type="email" class="form-control-plaintext"
                                                    id="email_address_one" name="email_address_one"
                                                    value="{{ json_decode($oldDataCustomer['billing_email'])[1] == null ? 'Data Belum Ada' : json_decode($oldDataCustomer['billing_email'])[1] }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email_address_two" class="form-label">Alamat Email Alternatif
                                                    2
                                                </label>
                                                <input type="email" class="form-control-plaintext"
                                                    id="email_address_two" name="email_address_two"
                                                    value="{{ json_decode($oldDataCustomer['billing_email'])[2] == null ? 'Data Belum Ada' : json_decode($oldDataCustomer['billing_email'])[2] }}">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="technical-info" class="tab-pane" role="tabpanel" aria-labelledby="technical-info">
                                <div class="container row">
                                    <div class="col-0 col-md-6">
                                        <div class="mb-3">
                                            <label for="fullname_technical" class="form-label">Nama Lengkap<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control-plaintext" id="fullname_technical"
                                                name="fullname_technical"
                                                value="{{ $oldDataCustomer['technical_name'] }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone_number_technical" class="form-label">Nomor Handphone
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control-plaintext"
                                                id="phone_number_technical" name="phone_number_technical"
                                                value="{{ $oldDataCustomer['technical_contact'] }}">
                                        </div>
                                    </div>
                                    <div class="col-0 col-md-6">
                                        <div class="mb-3">
                                            <label for="email_address_technical" class="form-label">Alamat Email
                                                <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control-plaintext"
                                                id="email_address_technical" name="email_address_technical"
                                                value="{{ $oldDataCustomer['technical_email'] }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="service-info" class="tab-pane" role="tabpanel" aria-labelledby="technical-info">
                                <div class="mb-3">
                                    <label for="service_product" class="form-label">Daftar Layanan Terdaftar<span
                                            class="text-danger">*</span></label>
                                    <ol id="service_product">
                                        @foreach (json_decode($oldDataCustomer['service_package']) as $service)
                                            <li style="margin-left: -15px;">{{ $service }}</li>
                                        @endforeach
                                    </ol>
                                </div>
                                <div class="mb-3">
                                    <label for="new_service_product" class="form-label">Pilihan Layanan Baru
                                        <span class="text-danger">*</span>
                                    </label>
                                    @php
                                        $servicesData = ['Dedicated Fiber Optic', 'Dedicated Wireless', 'Broadband Fiber Optic', 'Broadband Wireless'];
                                    @endphp
                                    <select
                                        class="form-select @error('new_service_product') is-invalid @else @if (session()->has('errMessages')) is-invalid @endif @enderror"
                                        name="new_service_product" id="new_service_product">
                                        <option disabled selected>Pilih Jenis Layanan...</option>
                                        @foreach ($servicesData as $service)
                                            @if (old('new_service_product') == $service)
                                                <option value="{{ $service }}" selected>{{ $service }}
                                                </option>
                                            @else
                                                <option value="{{ $service }}">{{ $service }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('new_service_product')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @else
                                        @if (session()->has('errMessages'))
                                            <div class="d-block invalid-feedback">
                                                {{ session('errMessages') }}
                                            </div>
                                        @endif
                                    @enderror
                                </div>
                            </div>
                            <div id="terms-info" class="tab-pane" role="tabpanel" aria-labelledby="terms-info">
                                <div class="container-fluid p-5 mb-3" id="terms-and-condition">
                                    @include('user.pages.terms.index')
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="termsCbo" name="termsCbo">
                                    <label class="form-check-label" for="termsCbo">Saya menyetujui syarat dan
                                        ketentuan yang berlaku</label>
                                </div>
                            </div>
                        </div>

                        <!-- Include optional progressbar HTML -->
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
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
    <script src="{{ URL::to('lib/jquery-smartwizard/dist/js/jquery.smartWizard.min.js') }}"></script>
    <!-- Custom Script JS -->
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
                disabledSteps: [1, 2], // Array Steps disabled
                errorSteps: [], // Array Steps error
                warningSteps: [], // Array Steps warning
                hiddenSteps: [], // Hidden steps
                getContent: null // Callback function for content loading
            });

            $("#btnSubmitPersonalForms").toggle(false);

            $('#termsCbo').click(function() {
                $("#btnSubmitPersonalForms").toggle(this.checked);
            });

            $("#btnSubmitPersonalForms").on('click', () => {
                $("#personalForm").trigger('submit');
            })
        });
    </script>
    <script src="{{ URL::to('bin/js/newCustomer/personal/inputFilter.js') }}"></script>
    <script src="{{ URL::to('bin/js/newCustomer/personal/cboConfig.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Nomor KTP
            var IDNumberPersonal = {!! json_encode($oldDataCustomer['identity_number']) !!};
            $('#id_number_personal').val(masking(IDNumberPersonal, 10));

            // Alamat Email
            var EmailPersonal = {!! json_encode($oldDataCustomer['email']) !!};
            $('#email_address_personal').val(masking(EmailPersonal, 15));

            // Nomor HP
            var NoHPPersonal = {!! json_encode($oldDataCustomer['phone_number']) !!};
            $('#phone_number_personal').val(masking(NoHPPersonal, 5));
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
