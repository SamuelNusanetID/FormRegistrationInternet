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
                        <style>
                            .form-control.error {
                                border-color: #dc3545;
                                padding-right: calc(1.5em + .75rem);
                                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
                                background-repeat: no-repeat;
                                background-position: right calc(.375em + .1875rem) center;
                                background-size: calc(.75em + .375rem) calc(.75em + .375rem);
                            }

                            .error {
                                font-size: .875em;
                                color: #dc3545;
                            }
                        </style>
                        <div class="tab-content">
                            <div id="form-step-0" class="tab-pane" role="tabpanel" aria-labelledby="form-step-0">
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
                                                value="{{ $customerData['full_name'] }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Alamat Lengkap KTP<span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" id="address" name="address" aria-describedby="address" rows="4" readonly>{{ $customerData['address'] }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="form-step-1" class="tab-pane" role="tabpanel" aria-labelledby="form-step-1">
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
                            <div id="form-step-2" class="tab-pane" role="tabpanel" aria-labelledby="form-step-2">
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
                            <div id="form-step-3" class="tab-pane" role="tabpanel" aria-labelledby="form-step-3"
                                style="min-height:800px !important; overflow:auto;">
                                <style>
                                    #map {
                                        height: 30em;
                                    }
                                </style>
                                <div class="mb-3" id="map">
                                </div>
                                <div class="form-text mb-3">
                                    Silahkan Cari, Geser dan Pilih Lokasi Anda.
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat Lengkap Pemasangan Baru <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="new_address" name="new_address" aria-describedby="address" rows="4"></textarea>
                                    <div id="address" class="form-text mb-1">Alamat ini digunakan
                                        sebagai
                                        alamat pemasangan internet.</div>
                                    <div class="mb-3">
                                        <label for="branch_id" class="form-label">
                                            Regional
                                            <span class="text-danger">*</span>
                                        </label>
                                        @php
                                            $regionalForm = [
                                                [
                                                    'branch_id' => '020',
                                                    'branch_name' => 'Medan Multatuli',
                                                ],
                                                [
                                                    'branch_id' => '062',
                                                    'branch_name' => 'Bali',
                                                ],
                                            ];
                                        @endphp
                                        <select class="form-select" name="branch_id" id="branch_id">
                                            <option selected disabled>Pilih Regional Anda...</option>
                                            @foreach ($regionalForm as $item)
                                                @if (old('branch_id') == $item['branch_id'])
                                                    <option value="{{ $item['branch_id'] }}" selected>
                                                        {{ $item['branch_name'] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item['branch_id'] }}">
                                                        {{ $item['branch_name'] }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" name="geolocation_existing" id="geolocation_existing">
                                </div>
                                <div class="border rounded px-3 pb-4 pt-2 mb-3 bg-light text-dark"
                                    style="overflow-y: scroll; max-height: 800px !important;">
                                    <input type="hidden" name="service_charge_personal" id="service_charge_personal">
                                    <div class="mb-3">
                                        <label for="package_name" class="form-label">Pilihan Nama Paket</label>
                                        <input class="form-control" list="package_name_list" id="package_name"
                                            name="package_name" placeholder="Ketik untuk cari..."
                                            oninput="onInputDataLayananPersonal();">
                                        <datalist id="package_name_list">
                                        </datalist>
                                    </div>
                                    <div class="mb-3" id="option_package_top">
                                        <label for="package_top" class="form-label">
                                            Pilihan Tipe Waktu Pembayaran Paket
                                        </label>
                                        <div id="inlineTopPaket">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineTopPaket"
                                                    id="inlineTopPaket_1" value="Bulanan">
                                                <label class="form-check-label" for="inlineTopPaket_1">Bulanan</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineTopPaket"
                                                    id="inlineTopPaket_2" value="Tahunan">
                                                <label class="form-check-label" for="inlineTopPaket_2">Tahunan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3" id="option_custom_bulanan_tahunan">
                                        <label for="custom_bulanan_tahunan" class="form-label">
                                            Kustom Field Bulan/Tahun
                                        </label>
                                        <input class="form-control" type="text" id="custom_bulanan_tahunan"
                                            name="custom_bulanan_tahunan" placeholder="Masukkan Jumlah Bulan/Tahun">
                                    </div>
                                </div>
                                <input type="hidden" name="RequestHandler" id="RequestHandler">
                            </div>
                            <div id="form-step-4" class="tab-pane" role="tabpanel" aria-labelledby="form-step-4"
                                style="min-height:550px !important;">
                                <div class="container-fluid p-5 mb-3" id="terms-and-condition">
                                    <div class="d-none" id="tnc-home">
                                        @include('user.pages.terms.home')
                                    </div>
                                    <div class="d-none" id="tnc-bussiness">
                                        @include('user.pages.terms.bussiness')
                                    </div>
                                    <div class="d-none" id="tnc-dedicated">
                                        @include('user.pages.terms.dedicated')
                                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script src="{{ URL::to('bin/js/custExist/validation.js') }}"></script>
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
                getContent: provideContent // Callback function for content loading
            });

            function provideContent(idx, stepDirection, stepPosition, selStep, callback) {
                callback();
            }

            $("#btnSubmitBussinessForms").toggle(false);

            $('#termsCbo').click(function() {
                $("#btnSubmitBussinessForms").toggle(this.checked);
            });

            $("#btnSubmitBussinessForms").on('click', () => {
                $("#oldCustomerForm").trigger('submit');
            });
        });
    </script>
    <script>
        $(document).ready(() => {
            const map = L.map('map');
            var marker;
            var circle;
            var gpsRead = true;

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            var lc = L.control.locate({
                locateOptions: {
                    enableHighAccuracy: true
                },
                strings: {
                    title: "Klik untuk melihat lokasi anda saat ini!"
                },
                icon: "fa-solid fa-location-crosshairs"
            }).addTo(map);
            lc.start();

            map.on('locationfound', onLocationFound);
            map.on('click', onClick);

            var idxOnLoc = 0;

            function onLocationFound(e) {
                idxOnLoc += 1;
                if (marker || idxOnLoc > 1) {
                    map.removeLayer(marker);
                    map.removeLayer(circle);
                } else if (marker && idxOnLoc > 1) {
                    map.removeLayer(marker);
                    map.removeLayer(circle);
                    lc.stopFollowing();
                }
                var radius = e.accuracy;
                marker = new L.marker(e.latlng, {
                    draggable: true
                }).on('dragend', onDragEnd);
                circle = new L.circle(e.latlng, radius);
                map.addLayer(marker);
                map.addLayer(circle);

                // Ajax to search address by lat and lang
                var latitude = e.latlng.lat;
                var langitude = e.latlng.lng;
                $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${langitude}`,
                    function(data) {
                        marker.bindPopup(`${data.display_name}`).openPopup();
                        $('#new_address').val(data.display_name);
                        $('#geolocation_existing').val(JSON.stringify(e.latlng));
                    });

                map.locate({
                    setView: true,
                    watch: true
                });
            }

            function onClick(e) {
                if (marker) {
                    map.removeLayer(marker);
                    map.removeLayer(circle);
                    if (lc._active) {
                        lc.stopFollowing();
                        lc.stop();
                    }
                }
                var radius = 25;
                marker = new L.Marker(e.latlng, {
                    draggable: true
                }).on('dragend', onDragEnd);
                circle = new L.circle(e.latlng, radius);
                map.addLayer(marker);
                map.addLayer(circle);

                // Ajax to search address by lat and lang
                var latitude = e.latlng.lat;
                var langitude = e.latlng.lng;
                $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${langitude}`,
                    function(data) {
                        marker.bindPopup(`${data.display_name}`).openPopup();
                        $('#new_address').val(data.display_name);
                        $('#geolocation_existing').val(JSON.stringify(e.latlng));
                    });
            }

            var geocoder = L.Control.geocoder({
                    defaultMarkGeocode: false
                })
                .on('markgeocode', function(e) {
                    if (marker) {
                        map.removeLayer(marker);
                        map.removeLayer(circle);
                        if (lc._active) {
                            lc.stopFollowing();
                            lc.stop();
                        }
                    }

                    var radius = 25;
                    var latLang = e.geocode.center;

                    marker = new L.marker(latLang, {
                        draggable: true
                    }).on('dragend', onDragEnd);
                    circle = new L.circle(latLang, radius);
                    map.addLayer(marker);
                    map.addLayer(circle);
                    // Ajax to search address by lat and lang
                    var latitude = latLang.lat;
                    var langitude = latLang.lng;
                    $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${langitude}`,
                        function(data) {
                            marker.bindPopup(`${data.display_name}`).openPopup();
                            $('#new_address').val(data.display_name);
                            $('#geolocation_existing').val(JSON.stringify(latLang));
                        });
                })
                .addTo(map);

            function onDragEnd(e) {
                if (marker) {
                    map.removeLayer(marker);
                    map.removeLayer(circle);
                    if (lc._active) {
                        lc.stopFollowing();
                        lc.stop();
                    }
                }

                var latlng = e.target.getLatLng();
                var radius = 25;
                marker = new L.Marker(latlng, {
                    draggable: true
                }).on('dragend', onDragEnd);
                circle = new L.circle(latlng, radius);
                map.addLayer(marker);
                map.addLayer(circle);

                // Ajax to search address by lat and lang
                var latitude = latlng.lat;
                var langitude = latlng.lng;
                $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${langitude}`,
                    function(data) {
                        marker.bindPopup(`${data.display_name}`).openPopup();
                        $('#new_address').val(data.display_name);
                        $('#geolocation_existing').val(JSON.stringify(latlng));
                    });
            }
        });
    </script>
    <!-- Data Layanan ScriptJS -->
    <script>
        var splittingValue = [];
        var getDataLayananArr;

        $(document).ready(async () => {
            getDataLayananArr = await getDataLayananAPI();

            $('#branch_id').on('change', () => {
                const kode_cabang = $('#branch_id').val();

                var fetchDataLayanan = fetch(
                    `https://legacy.is5.nusa.net.id/service?branchId=${kode_cabang}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json;charset=utf-8',
                            'X-Api-Key': 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                        },
                    }
                );

                fetchDataLayanan
                    .then((res) => res.json())
                    .then((services) => {
                        services.forEach(srs => {
                            $('#package_name_list').append($('<option>', {
                                value: `${srs.ServiceType}`
                            }));
                        });
                    }).catch(err => {
                        alert("Server is not responding, " + err);
                    });
            });

            async function getDataLayananAPI() {
                let obj;
                const res = await fetch(
                    `https://legacy.is5.nusa.net.id/service`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json;charset=utf-8',
                            'X-Api-Key': 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                        },
                    }
                );
                obj = await res.json();
                return obj;
            }
        })

        function isEmpty(value) {
            if (value == null || value == undefined) {
                return true;
            } else if (value == 0) {
                return true;
            } else if (value == '-') {
                return true;
            }
            return false;
        }

        function onInputDataLayananPersonal() {
            var val = document.getElementById("package_name").value;
            var opts = document.getElementById('package_name_list').childNodes;
            for (var i = 0; i < opts.length; i++) {
                if (opts[i].value === val) {
                    getDataLayananArr.forEach(element => {
                        if (element.ServiceType == opts[i].value) {
                            $('#service_charge_personal').val(element.ServiceCharge);
                        }
                    });

                    $('#tnc-home').addClass('d-none');
                    $('#tnc-bussiness').addClass('d-none');
                    $('#tnc-dedicated').addClass('d-none');
                    splittingValue = opts[i].value.split(" ");
                    if (splittingValue.includes('Home')) {
                        $('#tnc-home').removeClass('d-none');
                    } else if (splittingValue.includes('Business')) {
                        $('#tnc-bussiness').removeClass('d-none');
                    } else if (splittingValue.includes('Dedicated')) {
                        $('#tnc-dedicated').removeClass('d-none');
                    } else {
                        $('#tnc-bussiness').removeClass('d-none');
                    }
                    break;
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        var isFalse = {!! json_encode(session()->has('errorMessage')) !!};
        if (isFalse) {
            Swal.fire(
                'Gagal!',
                {!! json_encode(session('errorMessage')) !!},
                'error'
            )
        }
    </script>
@endsection
