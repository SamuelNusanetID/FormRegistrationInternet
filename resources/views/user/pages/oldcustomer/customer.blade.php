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
                                style="min-height:800px !important; overflow:auto;">
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
                                    <input type="hidden" name="geolocation_existing" id="geolocation_existing">
                                </div>
                                <div class="border rounded px-3 pb-4 pt-2 mb-3 bg-light text-dark"
                                    style="overflow-y: scroll; max-height: 200px !important;">
                                    <div class="mb-3">
                                        <label for="package_name" class="form-label">Pilihan Nama Paket</label>
                                        <select class="form-select" id="package_name" name="package_name">
                                            <option selected disabled>Pilih Nama Paket...</option>
                                            @foreach ($packageName as $layananpaket)
                                                <option value="{{ $layananpaket }}">Paket {{ $layananpaket }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3" id="option_package_type">
                                        <label for="package_type" class="form-label">Pilihan Tipe Paket</label>
                                        <select class="form-select" id="package_type" name="package_type">
                                            <option selected disabled>Pilih Tipe Paket...</option>
                                        </select>
                                    </div>
                                    <div class="mb-3" id="option_package_categories">
                                        <label for="package_categories" class="form-label">Pilihan Kategori Paket</label>
                                        <select class="form-select" id="package_categories" name="package_categories">
                                            <option selected disabled>Pilih Kategori Paket...</option>
                                        </select>
                                    </div>
                                    <div class="mb-3" id="option_package_top">
                                        <label for="package_top" class="form-label">
                                            Pilihan Jangka Waktu Pembayaran Paket
                                        </label>
                                        <div>
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
                                        <label for="custom_bulanan_tahunan" class="form-label">Custom Field
                                            Bulan/Tahun</label>
                                        <input class="form-control" type="text" id="custom_bulanan_tahunan"
                                            name="custom_bulanan_tahunan" placeholder="Masukkan Jumlah Bulan/Tahun">
                                    </div>
                                </div>
                                <input type="hidden" name="RequestHandler" id="RequestHandler">
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
    <!-- Data Layanan ScriptJS -->
    <script>
        $(document).ready(() => {
            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            });
            var currentdate = new Date();
            var datetime = currentdate.getFullYear() + "-" + (String(currentdate.getMonth() + 1).padStart(2, '0')) +
                "-" + currentdate
                .getDate() + " " +
                String(currentdate.getHours()).padStart(2, '0') + ":" +
                String(currentdate.getMinutes()).padStart(2, '0') + ":" +
                String(currentdate.getSeconds()).padStart(2, '0');
            const packageData = {!! json_encode($serviceData) !!};
            const promoData = {!! json_encode($promoData) !!};
            var dataShowDetail = [];
            let hargaPaket = 0;

            $('#option_package_type').addClass('d-none');
            $('#option_package_categories').addClass('d-none');
            $('#option_package_top').addClass('d-none');
            $('#option_custom_bulanan_tahunan').addClass('d-none');
            $('#custom_bulanan_tahunan').attr('readonly', false);

            $('#package_name').on('change', () => {
                $('#custom_bulanan_tahunan').attr('readonly', false);
                $('#package_type').empty();
                $('#package_categories').empty();
                $('input[type=radio][name=inlineTopPaket]').prop('checked', false);
                $('#custom_bulanan_tahunan').empty();

                $('#option_package_categories').addClass('d-none');
                $('#option_package_top').addClass('d-none');
                $('#option_custom_bulanan_tahunan').addClass('d-none');

                var packageName = $('#package_name').val();

                if (packageName != "" || packageName != null) {
                    $('#option_package_type').removeClass('d-none');

                    var arrPackageType = [];
                    packageData.forEach(package => {
                        if (package.package_name == packageName) {
                            arrPackageType[package.package_type] = 0;
                        }
                    });

                    $('#package_type').append('<option disabled selected>Pilih Tipe Paket...</option>');
                    for (const [key, value] of Object.entries(arrPackageType)) {
                        $('#package_type').append($('<option>', {
                            value: key,
                            text: key
                        }));
                    }

                    dataShowDetail['package_name'] = packageName;
                } else {
                    $('#option_package_type').addClass('d-none');
                }
            });

            $('#package_type').on('change', () => {
                $('#custom_bulanan_tahunan').attr('readonly', false);
                $('#package_categories').empty();
                $('input[type=radio][name=inlineTopPaket]').prop('checked', false);
                $('#custom_bulanan_tahunan').empty();

                $('#option_package_categories').addClass('d-none');
                $('#option_package_top').addClass('d-none');
                $('#option_custom_bulanan_tahunan').addClass('d-none');

                var packageName = $('#package_name').val();
                var packageType = $('#package_type').val();
                $('#package_categories').empty();

                if (packageType != "" || packageType != null) {
                    $('#option_package_categories').removeClass('d-none');

                    var arrPackageCategories = [];
                    var i = 0;
                    packageData.forEach(package => {
                        if (package.package_name == packageName && package.package_type ==
                            packageType) {
                            if (!isEmpty(package.package_categories)) {
                                arrPackageCategories[package.package_categories] = package
                                    .package_speed;
                                dataShowDetail['package_categories'] = null;
                            } else {
                                arrPackageCategories[package
                                        .package_speed] = package
                                    .package_speed;
                                dataShowDetail['package_categories'] = package.package_categories;
                            }
                        }
                        i++;
                    });

                    $('#package_categories').append(
                        '<option disabled selected>Pilih Kategori Paket...</option>');
                    for (const [key, value] of Object.entries(arrPackageCategories)) {
                        $('#package_categories').append($('<option>', {
                            value: key != value ? key : value,
                            text: (key != value ? key + ' ( ' + value + ' Mbps)' : value +
                                ' Mbps')
                        }));
                    }

                    dataShowDetail['package_type'] = packageType;
                } else {
                    $('#option_package_categories').addClass('d-none');
                }
            });

            $('#package_categories').on('change', () => {
                $('#custom_bulanan_tahunan').attr('readonly', false);
                $('input[type=radio][name=inlineTopPaket]').prop('checked', false);
                $('#custom_bulanan_tahunan').empty();

                $('#option_package_top').addClass('d-none');
                $('#option_custom_bulanan_tahunan').addClass('d-none');

                $('#option_package_top').removeClass('d-none');
                dataShowDetail['package_categories'] = $('#package_categories').val();
                dataShowDetail['package_speed'] = isNaN(parseInt($('#package_categories').val())) ?
                    $('#package_categories').val() : '-';


                $('input[type=radio][name=inlineTopPaket]').change(function() {
                    $('#custom_bulanan_tahunan').attr('readonly', false);
                    $('#custom_bulanan_tahunan').val('');

                    if (this.value == 'Bulanan') {
                        dataShowDetail['package_top'] = 'Bulanan';
                        $('#option_custom_bulanan_tahunan').removeClass('d-none');
                    } else if (this.value == 'Tahunan') {
                        dataShowDetail['package_top'] = 'Tahunan';
                        $('#option_custom_bulanan_tahunan').addClass('d-none');
                        $('#option_custom_bulanan_tahunan').removeClass('d-none');
                    }
                });
            });

            $('#custom_bulanan_tahunan').on('input', function() {
                const hargaCustomBulanan = $('#custom_bulanan_tahunan').val();

                if (dataShowDetail['package_top'] == "Bulanan") {
                    dataShowDetail['counted'] = hargaCustomBulanan;

                    // Send Data to Database
                    var arrResultData = {};
                    packageData.forEach((item) => {
                        if (dataShowDetail['package_speed'] == dataShowDetail[
                                'package_categories']) {
                            if (item.package_name === dataShowDetail['package_name'] &&
                                item.package_type === dataShowDetail['package_type'] &&
                                item.package_categories === dataShowDetail['package_categories']) {
                                arrResultData = item;
                            }
                        } else {
                            if (item.package_name === dataShowDetail['package_name'] &&
                                item.package_type === dataShowDetail['package_type'] &&
                                item.package_speed === dataShowDetail['package_categories']) {
                                arrResultData = item;
                            }
                        }
                    });

                    var ResultJSON = {
                        'package_name': dataShowDetail['package_name'],
                        'package_type': dataShowDetail['package_type'],
                        'package_categories': isNaN(parseInt(dataShowDetail['package_categories'])) ?
                            dataShowDetail['package_categories'] : '-',
                        'package_speed': arrResultData['package_speed'],
                        'package_top': dataShowDetail['package_top'],
                        'package_price': arrResultData['package_price'] * dataShowDetail['counted'],
                        'optional_package': isEmpty(dataShowDetail['package_option']) ? null :
                            dataShowDetail['package_option'],
                        'counted': dataShowDetail['counted']
                    };

                    $('#RequestHandler').val(JSON.stringify(ResultJSON));
                } else if (dataShowDetail['package_top'] == "Tahunan") {
                    dataShowDetail['counted'] = hargaCustomBulanan;

                    // Send Data to Database
                    var arrResultData = {};
                    packageData.forEach((item) => {
                        if (dataShowDetail['package_speed'] == dataShowDetail[
                                'package_categories']) {
                            if (item.package_name === dataShowDetail['package_name'] &&
                                item.package_type === dataShowDetail['package_type'] &&
                                item.package_categories === dataShowDetail['package_categories']) {
                                arrResultData = item;
                            }
                        } else {
                            if (item.package_name === dataShowDetail['package_name'] &&
                                item.package_type === dataShowDetail['package_type'] &&
                                item.package_speed === dataShowDetail['package_categories']) {
                                arrResultData = item;
                            }
                        }
                    });

                    var ResultJSON = {
                        'package_name': dataShowDetail['package_name'],
                        'package_type': dataShowDetail['package_type'],
                        'package_categories': isNaN(parseInt(dataShowDetail['package_categories'])) ?
                            dataShowDetail['package_categories'] : '-',
                        'package_speed': arrResultData['package_speed'],
                        'package_top': dataShowDetail['package_top'],
                        'package_price': arrResultData['package_price'] * (dataShowDetail['counted'] *
                            12),
                        'optional_package': isEmpty(dataShowDetail['package_option']) ? null :
                            dataShowDetail['package_option'],
                        'counted': dataShowDetail['counted'] * 12
                    };

                    $('#RequestHandler').val(JSON.stringify(ResultJSON));
                }
            });
        });

        function dateTimeConverter(datetime) {
            var dateParts = new Date(Date.parse(datetime.replace(/-/g, '/'))).getTime();
            return dateParts;
        }

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

        var dates = {
            convert: function(d) {
                // Converts the date in d to a date-object. The input can be:
                //   a date object: returned without modification
                //  an array      : Interpreted as [year,month,day]. NOTE: month is 0-11.
                //   a number     : Interpreted as number of milliseconds
                //                  since 1 Jan 1970 (a timestamp)
                //   a string     : Any format supported by the javascript engine, like
                //                  "YYYY/MM/DD", "MM/DD/YYYY", "Jan 31 2009" etc.
                //  an object     : Interpreted as an object with year, month and date
                //                  attributes.  **NOTE** month is 0-11.
                return (
                    d.constructor === Date ? d :
                    d.constructor === Array ? new Date(d[0], d[1], d[2]) :
                    d.constructor === Number ? new Date(d) :
                    d.constructor === String ? new Date(d) :
                    typeof d === "object" ? new Date(d.year, d.month, d.date) :
                    NaN
                );
            },
            compare: function(a, b) {
                // Compare two dates (could be of any type supported by the convert
                // function above) and returns:
                //  -1 : if a < b
                //   0 : if a = b
                //   1 : if a > b
                // NaN : if a or b is an illegal date
                // NOTE: The code inside isFinite does an assignment (=).
                return (
                    isFinite(a = this.convert(a).valueOf()) &&
                    isFinite(b = this.convert(b).valueOf()) ?
                    (a > b) - (a < b) :
                    NaN
                );
            },
            inRange: function(d, start, end) {
                // Checks if date in d is between dates in start and end.
                // Returns a boolean or NaN:
                //    true  : if d is between start and end (inclusive)
                //    false : if d is before start or after end
                //    NaN   : if one or more of the dates is illegal.
                // NOTE: The code inside isFinite does an assignment (=).
                return (
                    isFinite(d = this.convert(d).valueOf()) &&
                    isFinite(start = this.convert(start).valueOf()) &&
                    isFinite(end = this.convert(end).valueOf()) ?
                    start <= d && d <= end :
                    NaN
                );
            }
        }
    </script>
@endsection
