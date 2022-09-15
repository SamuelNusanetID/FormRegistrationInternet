@extends('user.layouts.main')

@section('CSS')
    <!-- Smart Wizard -->
    <link href="{{ URL::to('lib/jquery-smartwizard/dist/css/smart_wizard_dots.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::to('bin/css/terms.css') }}">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <!-- Leaflet Locate Plugin -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.76.1/dist/L.Control.Locate.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
@endsection

@section('content-wrapper')
    <div class="container p-0 p-sm-5 mb-3 mb-md-0">
        <div class="card mx-0 mx-sm-5">
            <div class="card-body">
                <h2 class="text-center fw-bold mt-2 mb-4">Form Registrasi Layanan Baru</h2>
                <!-- SmartWizard html -->
                <form action="{{ URL::to('/old-member/' . $customerClass . '/' . $_GET['id']) }}" method="POST"
                    id="oldCustomerForm" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="g-recaptcha" data-sitekey="6LfutlwhAAAAACs1VgAQOYZlok2dejtrePnFt4z0"
                        data-callback="onSubmit" data-size="invisible" data-badge="bottomleft">
                    </div> --}}
                    <div id="smartwizard">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#person-in-charge">
                                    <div class="num"><i class="fa-solid fa-user"></i></div>
                                    {{ $customerClass == 'Personal' ? 'Data Personal' : 'Data Penanggung Jawab' }}
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
                                    <div class="col-12">
                                        <input type="hidden" name="uuid" value="{{ Request::segment(3) }}">
                                        <div class="mb-3">
                                            <label for="customer_id" class="form-label">ID Pelanggan</label>
                                            <input type="text" class="form-control" id="customer_id" name="customer_id"
                                                value="{{ $_GET['id'] }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="full_name" class="form-label">Nama
                                                Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="full_name" name="full_name"
                                                value="{{ $customerData->name }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Alamat Lengkap KTP<span
                                                    class="text-danger">*</span></label>
                                            @foreach (json_decode($customerData->address) as $key => $value)
                                                <textarea class="form-control {{ count(json_decode($customerData->address)) > 1 ? 'mb-3' : null }}"
                                                    id="address-{{ $key }}" name="address[]" aria-describedby="address" rows="4" readonly>{{ $value }}</textarea>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="billing-info" class="tab-pane" role="tabpanel" aria-labelledby="billing-info">
                                <div class="container row">
                                    <div class="col-0 col-md-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="true"
                                                id="isdataBillersamewithdataPic" name="isdataBillersamewithdataPic">
                                            <label class="form-check-label" for="isdataBillersamewithdataPic"
                                                {{ old('isdataBillersamewithdataPic') == 'true' ? ' checked' : '' }}>
                                                Data biller sama dengan data penanggung jawab
                                            </label>
                                        </div>
                                        <div class="mb-3">
                                            <label for="billing_name" class="form-label">Nama
                                                Biller <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('billing_name') is-invalid @enderror"
                                                id="billing_name" name="billing_name"
                                                placeholder="Masukkan Nama Lengkap Anda..."
                                                value="{{ old('billing_name') }}">
                                            @error('billing-info')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="billing_phone" class="form-label">Nomor Handphone
                                                <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('billing_phone') is-invalid @enderror"
                                                id="billing_phone" name="billing_phone"
                                                placeholder="Masukkan Nomor Handphone Anda..."
                                                value="{{ old('billing_phone') }}">
                                            @error('billing_phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="billing_email" class="form-label">Alamat Email
                                                <span class="text-danger">*</span></label>
                                            <input type="email"
                                                class="form-control @error('billing_email') is-invalid @enderror"
                                                id="billing_email" name="billing_email"
                                                placeholder="Masukkan Alamat E-Mail Anda..."
                                                value="{{ old('billing_email') }}">
                                            @error('billing_email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-0 col-md-6">
                                        <div class="mb-3">
                                            <label for="email_address_biller_one" class="form-label">Alamat Email
                                                Alternatif 1
                                            </label>
                                            <input type="email"
                                                class="form-control @error('email_address_biller_one') is-invalid @enderror"
                                                id="email_address_biller_one" name="email_address_biller_one"
                                                placeholder="Masukkan Alamat E-Mail Anda..."
                                                value="{{ old('email_address_biller_one') }}">
                                            @error('email_address_biller_one')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email_address_biller_two" class="form-label">Alamat Email
                                                Alternatif 2
                                            </label>
                                            <input type="email"
                                                class="form-control @error('email_address_biller_two') is-invalid @enderror"
                                                id="email_address_biller_two" name="email_address_biller_two"
                                                placeholder="Masukkan Alamat E-Mail Anda..."
                                                value="{{ old('email_address_biller_two') }}">
                                            @error('email_address_biller_two')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="technical-info" class="tab-pane" role="tabpanel" aria-labelledby="technical-info">
                                <div class="container row">
                                    <div class="col-0 col-md-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="true"
                                                id="isdataTechnicalsamewithdataPic" name="isdataTechnicalsamewithdataPic"
                                                {{ old('isdataTechnicalsamewithdataPic') == 'true' ? ' checked' : '' }}>
                                            <label class="form-check-label" for="isdataTechnicalsamewithdataPic">
                                                Data teknikal sama dengan data penanggung jawab
                                            </label>
                                        </div>
                                        <div class="mb-3">
                                            <label for="fullname_technical" class="form-label">Nama Lengkap<span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('fullname_technical') is-invalid @enderror"
                                                id="fullname_technical" name="fullname_technical"
                                                placeholder="Masukkan Nama Lengkap Anda..."
                                                value="{{ old('fullname_technical') }}">
                                            @error('fullname_technical')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone_number_technical" class="form-label">Nomor Handphone
                                                <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('phone_number_technical') is-invalid @enderror"
                                                id="phone_number_technical" name="phone_number_technical"
                                                placeholder="Masukkan Nomor Handphone Anda..."
                                                value="{{ old('phone_number_technical') }}">
                                            @error('phone_number_technical')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-0 col-md-6">
                                        <div class="mb-3">
                                            <label for="email_address_technical" class="form-label">Alamat Email
                                                <span class="text-danger">*</span></label>
                                            <input type="email"
                                                class="form-control @error('email_address_technical') is-invalid @enderror"
                                                id="email_address_technical" name="email_address_technical"
                                                placeholder="Masukkan Alamat E-Mail Anda..."
                                                value="{{ old('email_address_technical') }}">
                                            @error('email_address_technical')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="service-info" class="tab-pane" role="tabpanel" aria-labelledby="service-info"
                                style="min-height:550px !important; overflow:auto;">
                                @if (isset($customerData->service->service_package))
                                    <div class="mb-3">
                                        <label for="product_detail" class="mb-2">
                                            Detail Layanan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <ol>
                                            @foreach (json_decode($customerData->service->service_package) as $service)
                                                <li class="align-middle">
                                                    <table class="table border" style="width:100%;">
                                                        <colgroup>
                                                            <col style="width: 30%;">
                                                            <col style="width: 5%;">
                                                            <col style="width: 65%;">
                                                        </colgroup>
                                                        <tbody>
                                                            @foreach ($service as $key => $value)
                                                                @if ($key == 'service_name')
                                                                    <tr>
                                                                        <td class="fw-bold">Nama Produk</td>
                                                                        <td>:</td>
                                                                        <td>{{ $value }}</td>
                                                                    </tr>
                                                                @elseif ($key == 'service_price')
                                                                    <tr>
                                                                        <td class="fw-bold">Harga Produk</td>
                                                                        <td>:</td>
                                                                        <td>{{ $value }}</td>
                                                                    </tr>
                                                                @elseif ($key == 'termofpaymentDeals')
                                                                    <tr>
                                                                        <td class="fw-bold">Jangka Waktu Pembayaran</td>
                                                                        <td>:</td>
                                                                        <td>{{ $value }}</td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                @endif
                                <div class="border rounded px-3 pb-4 pt-2 mb-3 bg-light text-dark">
                                    <div class="" id="serviceOptionBussiness">
                                        <label for="service_product" class="form-label">Pilihan Layanan Baru
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
                                                @if ($service->category == $customerClass)
                                                    @if (old('service_product') == $service->package_name)
                                                        <option value="{{ $service->package_name }}" selected>
                                                            {{ $service->package_name }} - Rp.
                                                            {{ $service->package_price }},-
                                                        </option>
                                                    @else
                                                        <option value="{{ $service->package_name }}">
                                                            {{ $service->package_name }} => Rp. @convert((int) $service->package_price) /
                                                            {{ $service->period }}
                                                        </option>
                                                    @endif
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
                                            <input
                                                class="form-check-input @error('topRadioBtnBussiness') is-invalid @enderror"
                                                type="radio" name="topRadioBtnBussiness"
                                                id="topRadioBtnMonthlyBussiness" value="Bulanan"
                                                {{ old('topRadioBtnBussiness') === 'Bulanan' ? 'checked' : null }}>
                                            <label class="form-check-label"
                                                for="topRadioBtnMonthlyBussiness">Bulanan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('topRadioBtnBussiness') is-invalid @enderror"
                                                type="radio" name="topRadioBtnBussiness"
                                                id="topRadioBtnAnuallyBussiness" value="Tahunan"
                                                {{ old('topRadioBtnBussiness') === 'Tahunan' ? 'checked' : null }}>
                                            <label class="form-check-label"
                                                for="topRadioBtnAnuallyBussiness">Tahunan</label>
                                        </div>
                                        @error('topRadioBtnBussiness')
                                            <p class="small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="row g-3 align-items-center py-1 d-none" id="monthlyEditFieldBussiness">
                                        <label for="editBulanServiceListBussiness">
                                            Field Bulanan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-auto">
                                            <label for="editBulanServiceListBussiness" class="col-form-label">
                                                Jumlah Bulan
                                            </label>
                                        </div>
                                        <div class="col-auto">
                                            <input type="number" id="editBulanServiceListBussiness"
                                                name="editBulanServiceListBussiness" class="form-control"
                                                aria-describedby="passwordHelpInline" min="1" max="12">
                                        </div>
                                        <div class="col-auto">
                                            <span id="passwordHelpInline" class="form-text">
                                                Bulan
                                            </span>
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
                                <style>
                                    #map {
                                        height: 50em;
                                    }
                                </style>
                                <div class="mb-3" id="map">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat Lengkap Pemasangan Baru <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="new_address" name="new_address" aria-describedby="address" rows="4"></textarea>
                                    <div id="pic_address_help" class="form-text mb-1">Alamat ini digunakan
                                        sebagai
                                        alamat pemasangan internet.</div>
                                </div>
                            </div>
                            <div id="terms-info" class="tab-pane" role="tabpanel" aria-labelledby="terms-info"
                                style="min-height:550px !important;">
                                <div class="container-fluid p-5 mb-3" id="terms-and-condition">
                                    @include('user.pages.terms.index')
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="termsCbo" name="termsCbo">
                                    <label class="form-check-label" for="termsCbo">
                                        Dengan mencentang checklist kotak disamping, berarti anda sudah menyetujui semua
                                        syarat dan ketentuan yang berlaku di Nusanet.
                                    </label>
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
        <a href="{{ URL::to('/new-member') }}" class="btn btn-primary mb-3">
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
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <!-- Leaflet Plugin JS -->
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.76.1/dist/L.Control.Locate.min.js" charset="utf-8">
    </script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
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
                disabledSteps: [1, 2], // Array Steps disabled
                errorSteps: [], // Array Steps error
                warningSteps: [], // Array Steps warning
                hiddenSteps: [], // Hidden steps
                getContent: null // Callback function for content loading
            });

            $("#btnSubmitBussinessForms").toggle(false);

            $('#termsCbo').click(function() {
                $("#btnSubmitBussinessForms").toggle(this.checked);
            });

            $("#btnSubmitBussinessForms").on('click', () => {
                $("#bussinessForm").trigger('submit');
            })
        });
    </script>
    <script>
        $(document).ready(() => {
            var formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
            });

            const map = L.map('map');
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            var lc = L.control.locate().addTo(map);
            lc.start();

            function onLocationFound(e) {
                var radius = e.accuracy;
                L.marker(e.latlng).addTo(map);
                L.circle(e.latlng, radius).addTo(map);
            }

            map.on('locationfound', onLocationFound);

            var geocoder = L.Control.geocoder()
                .on('markgeocode', function(e) {
                    $('#new_address').val(e.geocode.name);
                })
                .addTo(map);

            $('#service_product').on('change', function() {
                $('#serviceOptionBussiness').addClass('mb-3');
                $('#termOfPaymentBussiness').removeClass('d-none');
                $('#termOfPaymentBussiness').removeClass('mb-3');
                $('input[type=radio][name=topRadioBtnBussiness]').prop('checked', false);
                $('#detailPaymentBussiness').addClass('d-none');
            });

            $('input[type=radio][name=topRadioBtnBussiness]').change(function() {
                if (this.value == 'Bulanan') {
                    $('#monthlyEditFieldBussiness').removeClass('d-none');
                    $('#monthlyEditFieldBussiness').addClass('mb-3');
                    $('#termOfPaymentBussiness').addClass('mb-3');

                    $('#editBulanServiceListBussiness').on('keyup', function() {
                        var max = parseInt($(this).attr('max'));
                        var min = parseInt($(this).attr('min'));
                        if ($(this).val() > max) {
                            $(this).val(max);
                        } else if ($(this).val() < min) {
                            $(this).val(min);
                        }

                        if (this.value != "" && this.value <= 12) {
                            $('#detailPaymentBussiness').removeClass('d-none');

                            var serviceData = {!! json_encode($servicesData) !!};
                            serviceData.forEach(element => {
                                if (element.package_name == $('#service_product').val() &&
                                    element.period ==
                                    'Bulanan') {
                                    $('#serviceName').val(element.package_name);
                                    $('#servicePrice').val(formatter.format((element
                                        .package_price) * this.value));
                                    $('#termofpaymentDeals').val("Bulanan");
                                }
                            });
                        } else {
                            $('#detailPaymentBussiness').addClass('d-none');
                        }
                    });
                } else if (this.value == 'Tahunan') {
                    $('#detailPaymentBussiness').removeClass('d-none');
                    $('#termOfPaymentBussiness').addClass('mb-3');

                    var serviceData = {!! json_encode($servicesData) !!};
                    serviceData.forEach(element => {
                        if (element.package_name == $('#service_product').val() && element.period ==
                            'Tahunan') {
                            $('#serviceName').val(element.package_name);
                            $('#servicePrice').val(formatter.format(element
                                .package_price));
                            $('#termofpaymentDeals').val("Tahunan");
                        }
                    });
                }
            });

            if ($('#service_product').val() != null) {
                $('#serviceOptionBussiness').addClass('mb-3');
                $('#termOfPaymentBussiness').removeClass('d-none');
                $('#termOfPaymentBussiness').removeClass('mb-3');
                $('#detailPaymentBussiness').addClass('d-none');

                if ($('input[type=radio][name=topRadioBtnBussiness]').is(':checked')) {
                    if ($('input[type=radio][name=topRadioBtnBussiness]').val() == 'Bulanan') {
                        $('#monthlyEditFieldBussiness').removeClass('d-none');
                        $('#monthlyEditFieldBussiness').addClass('mb-3');
                        $('#termOfPaymentBussiness').addClass('mb-3');

                        $('#editBulanServiceListBussiness').on('keyup', function() {
                            var max = parseInt($(this).attr('max'));
                            var min = parseInt($(this).attr('min'));
                            if ($(this).val() > max) {
                                $(this).val(max);
                            } else if ($(this).val() < min) {
                                $(this).val(min);
                            }

                            if (this.value != "" && this.value <= 12) {
                                $('#detailPaymentBussiness').removeClass('d-none');

                                var serviceData = {!! json_encode($servicesData) !!};
                                serviceData.forEach(element => {
                                    if (element.package_name == $('#service_product').val() &&
                                        element.period ==
                                        'Bulanan') {
                                        $('#serviceName').val(element.package_name);
                                        $('#servicePrice').val(formatter.format((element
                                            .package_price) * this.value));
                                        $('#termofpaymentDeals').val("Bulanan");
                                    }
                                });
                            } else {
                                $('#detailPaymentBussiness').addClass('d-none');
                            }
                        });
                    } else if ($('input[type=radio][name=topRadioBtnBussiness]').val() == 'Tahunan') {
                        $('#detailPaymentBussiness').removeClass('d-none');
                        $('#termOfPaymentBussiness').addClass('mb-3');

                        var serviceData = {!! json_encode($servicesData) !!};
                        serviceData.forEach(element => {
                            if (element.package_name == $('#service_product').val() && element.period ==
                                'Tahunan') {
                                $('#serviceName').val(element.package_name);
                                $('#servicePrice').val(formatter.format(element
                                    .package_price));
                                $('#termofpaymentDeals').val("Tahunan");
                            }
                        });
                    }
                }
            }

            var countedData = {!! json_encode(count(json_decode($customerData->address))) !!};
            for (let index = 0; index < countedData; index++) {
                var oldalamatPasang = $(`#address-${index}`).val().split('');
                var countChar = oldalamatPasang.length;
                var maskingSum = Math.round(countChar / 2);

                var newValueAlamatPasang = [];
                for (let x = 0; x < maskingSum; x++) {
                    newValueAlamatPasang[x] = "*";
                }

                for (let y = maskingSum; y < countChar; y++) {
                    newValueAlamatPasang[y] = oldalamatPasang[y];
                }

                $(`#address-${index}`).val(newValueAlamatPasang.join(''));
            }
        });
    </script>
@endsection
