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
                            <div id="person-in-charge" class="tab-pane" role="tabpanel" aria-labelledby="person-in-charge">
                                <div class="container row">
                                    <div class="col-0 col-md-6">
                                        <input type="hidden" name="uuid" value="{{ Request::segment(3) }}">
                                        <div class="mb-3">
                                            <label for="pic_name" class="form-label">Nama
                                                Lengkap <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('pic_name') is-invalid @enderror" id="pic_name"
                                                name="pic_name" placeholder="Masukkan Nama Lengkap Anda..."
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
                                                value="{{ old('identity_number', $oldDataCustomer['identity_number']) }}"
                                                readonly>
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
                                                placeholder="Masukkan Alamat E-Mail Anda..."
                                                value="{{ old('email_address', $oldDataCustomer['email']) }}" readonly>
                                            @error('email_address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Alamat Lengkap <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                                                aria-describedby="address_help" rows="4" placeholder="Masukkan Alamat Lengkap Anda..." readonly>{{ old('address', $oldDataCustomer['address']) }}</textarea>
                                            <div id="address_help" class="form-text mb-1">Alamat ini digunakan
                                                sebagai
                                                alamat pemasangan perangkat.</div>
                                            @error('address')
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
                                                value="{{ old('company_name', $oldDataCustomer['company_name']) }}"
                                                readonly>
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
                                                name="company_address" placeholder="Masukkan Alamat Perusahaan Anda..." rows="4" readonly>{{ old('company_address', $oldDataCustomer['company_address']) }}</textarea>
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
                                                value="{{ old('company_npwp', $oldDataCustomer['company_npwp']) }}"
                                                readonly>
                                            @error('company_npwp')
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
                                                value="{{ old('company_employees', $oldDataCustomer['company_employees']) }}"
                                                readonly>
                                            @error('company_employees')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="billing-info" class="tab-pane" role="tabpanel" aria-labelledby="billing-info">
                            </div>
                            <div id="technical-info" class="tab-pane" role="tabpanel" aria-labelledby="technical-info">
                            </div>
                            <div id="service-info" class="tab-pane" role="tabpanel" aria-labelledby="service-info"
                                style="height: 100%; overflow:auto;">
                                <div class="border rounded px-3 pb-4 pt-2 mb-3 bg-light text-dark">
                                    @if (isset($oldDataCustomer['service_package']))
                                        <div class="mb-3">
                                            <label for="service_product" class="form-label">
                                                Daftar Layanan
                                            </label>
                                            <ol>
                                                @foreach (json_decode($oldDataCustomer['service_package']) as $item)
                                                    <li style="margin-left: -15px;">
                                                        <ul>
                                                            <li class="row">
                                                                <p class="col-sm-3 fw-bold p-0 m-0">Nama Layanan</p>
                                                                <p class="col-sm-9 p-0 m-0">{{ $item->service_name }}</p>
                                                            </li>
                                                            <li class="row">
                                                                <p class="col-sm-3 fw-bold p-0 m-0">Harga Layanan</p>
                                                                <p class="col-sm-9 p-0 m-0">{{ $item->service_price }}</p>
                                                            </li>
                                                            <li class="row">
                                                                <p class="col-sm-3 fw-bold p-0 m-0">Jenis Pembayaran</p>
                                                                <p class="col-sm-9 p-0 m-0">
                                                                    {{ $item->termofpaymentDeals }}</p>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    @endif
                                    <div class="" id="serviceOptionBussiness">
                                        <label for="service_product" class="form-label">Pilihan Layanan
                                            <span class="text-danger">*</span>
                                        </label>
                                        @php
                                            $servicesData = json_decode($serviceData);
                                            setlocale(LC_MONETARY, 'id_ID');
                                        @endphp
                                        <select class="form-select @error('service_product') is-invalid @enderror"
                                            name="service_product" id="service_product">
                                            <option disabled selected>Pilih Jenis Layanan...</option>
                                            @foreach ($servicesData as $service)
                                                @if (old('service_product') == $service->nama_layanan)
                                                    <option value="{{ $service->nama_layanan }}" selected>
                                                        {{ $service->nama_layanan }} - Rp. {{ $service->harga_layanan }},-
                                                    </option>
                                                @else
                                                    <option value="{{ $service->nama_layanan }}">
                                                        {{ $service->nama_layanan }} => Rp. @convert((int) $service->harga_layanan) / Bulan
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('service_product')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 d-none" id="termOfPaymentBussiness">
                                        <p class="m-0 p-0 mb-1">
                                            Jenis Pembayaran
                                            <span class="text-danger">*</span>
                                        </p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="topRadioBtnBussiness"
                                                id="topRadioBtnMonthlyBussiness" value="Bulanan">
                                            <label class="form-check-label"
                                                for="topRadioBtnMonthlyBussiness">Bulanan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="topRadioBtnBussiness"
                                                id="topRadioBtnAnuallyBussiness" value="Tahunan">
                                            <label class="form-check-label"
                                                for="topRadioBtnAnuallyBussiness">Tahunan</label>
                                        </div>
                                    </div>
                                    <div class="border rounded px-3 py-2 bg-white text-dark d-none"
                                        id="detailPaymentBussiness">
                                        <div class="row">
                                            <p class="fw-bold mb-3">Rincian Pembayaran</p>
                                            <div class="mb-0 row">
                                                <label for="serviceName" class="col-8 col-md-3 col-form-label fw-bold">-
                                                    Nama
                                                    Layanan</label>
                                                <div class="col-8 col-md-9">
                                                    <input type="text" readonly class="form-control-plaintext"
                                                        id="serviceName" name="serviceName">
                                                </div>
                                            </div>
                                            <div class="mb-0 row">
                                                <label for="servicePrice" class="col-8 col-sm-3 col-form-label fw-bold">-
                                                    Harga
                                                    Layanan</label>
                                                <div class="col-8 col-sm-9">
                                                    <input type="text" readonly class="form-control-plaintext"
                                                        id="servicePrice" name="servicePrice">
                                                </div>
                                            </div>
                                            <div class="mb-0 row">
                                                <label for="termofpaymentDeals"
                                                    class="col-8 col-sm-3 col-form-label fw-bold">-
                                                    Jenis
                                                    Pembayaran</label>
                                                <div class="col-8 col-sm-9">
                                                    <input type="text" readonly class="form-control-plaintext"
                                                        id="termofpaymentDeals" name="termofpaymentDeals">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="service_identity_photo" class="form-label">Upload Foto KTP</label>
                                    <input class="form-control @error('service_identity_photo') is-invalid @enderror"
                                        type="file" id="service_identity_photo" name="service_identity_photo">
                                    @error('service_identity_photo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="service_selfie_photo" class="form-label">Upload Foto Selfie dengan
                                        KTP</label>
                                    <input class="form-control @error('service_selfie_photo') is-invalid @enderror"
                                        type="file" id="service_selfie_photo" name="service_selfie_photo">
                                    @error('service_selfie_photo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
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
            var formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
            });

            // Nomor KTP
            var IDNumberBussiness = {!! json_encode($oldDataCustomer['identity_number']) !!};
            $('#identity_number').val(masking(IDNumberBussiness, 10));

            // Alamat Email
            var EmailBussiness = {!! json_encode($oldDataCustomer['email']) !!};
            $('#email_address').val(masking(EmailBussiness, 15));

            // Company NPWP
            var NPWPBussiness = {!! json_encode($oldDataCustomer['company_npwp']) !!};
            $('#company_npwp').val(masking(NPWPBussiness, 10));

            $('#service_product').on('change', function() {
                $('#serviceOptionBussiness').addClass('mb-3');
                $('#termOfPaymentBussiness').removeClass('d-none');
                $('#termOfPaymentBussiness').removeClass('mb-3');
                $('input[type=radio][name=topRadioBtnBussiness]').prop('checked', false);
                $('#detailPaymentBussiness').addClass('d-none');

                $('input[type=radio][name=topRadioBtnBussiness]').change(function() {
                    if (this.value == 'Bulanan') {
                        $('#detailPaymentBussiness').removeClass('d-none');
                        $('#termOfPaymentBussiness').addClass('mb-3');

                        var serviceData = {!! json_encode($servicesData) !!};
                        serviceData.forEach(element => {
                            if (element.nama_layanan == $('#service_product').val()) {
                                $('#serviceName').val(element.nama_layanan);
                                $('#servicePrice').val(formatter.format(element
                                    .harga_layanan));
                                $('#termofpaymentDeals').val("Bulanan");
                            }
                        });
                    } else if (this.value == 'Tahunan') {
                        $('#detailPaymentBussiness').removeClass('d-none');
                        $('#termOfPaymentBussiness').addClass('mb-3');

                        var serviceData = {!! json_encode($servicesData) !!};
                        serviceData.forEach(element => {
                            if (element.nama_layanan == $('#service_product').val()) {
                                $('#serviceName').val(element.nama_layanan);
                                $('#servicePrice').val(formatter.format(element
                                    .harga_layanan * 12));
                                $('#termofpaymentDeals').val("Tahunan");
                            }
                        });
                    }
                });
            });
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
