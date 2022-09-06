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
                <h2 class="text-center fw-bold mt-2 mb-4">
                    Form Registrasi Layanan Baru
                    @if (isset($salesName))
                        </br>
                        <p class="h6 mt-3"><b>AM</b> : {{ $salesName }}</p>
                    @endif
                </h2>
                <!-- SmartWizard html -->
                <form action="{{ URL::to('new-member/personal') }}" method="POST" id="personalForm"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="g-recaptcha" data-sitekey="6LfutlwhAAAAACs1VgAQOYZlok2dejtrePnFt4z0"
                        data-callback="onSubmit" data-size="invisible" data-badge="bottomleft">
                    </div> --}}
                    @error('uuid')
                        <div class="text-center mb-3 h3 text-danger fw-bold">
                            {{ $message }}. Maaf, data kamu tidak tersimpan.
                        </div>
                    @enderror
                    <div id="smartwizard">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#form-step-0">
                                    <div class="num"><i class="fa-solid fa-user"></i></div>
                                    Data Personal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#form-step-1">
                                    <span class="num"><i class="fa-solid fa-money-bill-wave"></i></span>
                                    Data Pembayaran
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#form-step-2">
                                    <span class="num"><i class="fa-solid fa-list-check"></i></span>
                                    Data Teknis
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#form-step-3">
                                    <span class="num"><i class="fas fa-people-carry"></i></span>
                                    Data Layanan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#form-step-4">
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
                                width: 100%;
                                margin-top: .25rem;
                                font-size: .875em;
                                color: #dc3545;
                            }
                        </style>
                        <div class="tab-content">
                            <div id="form-step-0" class="tab-pane px-0" role="tabpanel" aria-labelledby="form-step-0"
                                style="overflow-y:scroll; max-height:100%;">
                                <div class="container row">
                                    <div class="col-0 col-md-6">
                                        @if (isset($salesID))
                                            <input type="hidden" name="salesID" value="{{ $salesID }}">
                                        @endif
                                        <input type="hidden" name="uuid" value="{{ Request::segment(3) }}">
                                        <div class="mb-3">
                                            <label for="fullname_personal" class="form-label">Nama
                                                Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="fullname_personal"
                                                name="fullname_personal" placeholder="Masukkan Nama Lengkap Anda..."
                                                value="{{ old('fullname_personal') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_number_personal" class="form-label">Nomor Identitas
                                                (KTP/SIM/KITAS) <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('id_number_personal') is-invalid @enderror"
                                                id="id_number_personal" name="id_number_personal"
                                                placeholder="Masukkan Nomor Identitas Anda..."
                                                value="{{ old('id_number_personal') }}">
                                            @error('id_number_personal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email_address_personal" class="form-label">Alamat Email
                                                <span class="text-danger">*</span></label>
                                            <input type="email"
                                                class="form-control @error('email_address_personal') is-invalid @enderror"
                                                id="email_address_personal" name="email_address_personal"
                                                placeholder="Masukkan Alamat E-Mail Anda..."
                                                value="{{ old('email_address_personal') }}">
                                            @error('email_address_personal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone_number_personal" class="form-label">Nomor HP/WA yang aktif
                                                <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('phone_number_personal') is-invalid @enderror"
                                                id="phone_number_personal" name="phone_number_personal"
                                                placeholder="Masukkan Nomor Handphone/Whatsapp Anda..."
                                                value="{{ old('phone_number_personal') }}">
                                            @error('phone_number_personal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="service_identity_photo" class="form-label">Upload Foto KTP</label>
                                            <input
                                                class="form-control @error('service_identity_photo') is-invalid @enderror"
                                                type="file" id="service_identity_photo" name="service_identity_photo">
                                            @error('service_identity_photo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-0 col-md-6">
                                        <style>
                                            #map {
                                                height: 300px;
                                            }
                                        </style>
                                        <div class="mb-3" id="map">
                                        </div>
                                        <div class="mb-3">
                                            <label for="address_personal" class="form-label">Alamat Lengkap <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control @error('address_personal') is-invalid @enderror" id="address_personal"
                                                name="address_personal" aria-describedby="address_personal_help" rows="3"
                                                placeholder="Masukkan Alamat Lengkap Anda...">{{ old('address_personal') }}</textarea>
                                            <div id="address_personal_help" class="form-text mb-1">
                                                Alamat ini digunakan sebagai alamat pemasangan internet.
                                            </div>
                                            @error('address_personal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="geolocation_personal" id="geolocation_personal"
                                            value="">
                                    </div>
                                </div>
                                <hr>
                                <div class="container row">
                                    <div class="mb-3">
                                        <label for="survey_id" class="form-label">
                                            ID Survey
                                        </label>
                                        <input type="text" class="form-control" id="survey_id" name="survey_id"
                                            placeholder="Masukkan ID Survey..." value="{{ old('survey_id') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="addonsnote" class="form-label">
                                            Catatan Tambahan
                                        </label>
                                        <textarea class="form-control" id="addonsnote" name="addonsnote" rows="10">{{ old('addonsnote') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="form-step-1" class="tab-pane" role="tabpanel" aria-labelledby="form-step-1"
                                style="overflow-y:scroll; max-height:100%;">
                                <div class="container row">
                                    <div class="col-0 col-md-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="true"
                                                id="isdataBillersamewithdataPersonal"
                                                name="isdataBillersamewithdataPersonal"
                                                {{ old('isdataBillersamewithdataPersonal') == 'true' ? ' checked' : '' }}>
                                            <label class="form-check-label" for="isdataBillersamewithdataPersonal">
                                                Data pembayaran sama dengan data personal
                                            </label>
                                        </div>
                                        <div class="mb-3">
                                            <label for="fullname_biller" class="form-label">Nama
                                                Lengkap <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('fullname_biller') is-invalid @enderror"
                                                id="fullname_biller" name="fullname_biller"
                                                placeholder="Masukkan Nama Lengkap Anda..."
                                                value="{{ old('fullname_biller') }}">
                                            @error('fullname_biller')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone_number_biller" class="form-label">Nomor Handphone
                                                <span class="text-danger">*</span></label>
                                            <input type="tel"
                                                class="form-control @error('phone_number_biller') is-invalid @enderror"
                                                id="phone_number_biller" name="phone_number_biller"
                                                placeholder="Masukkan Nomor Handphone Anda..."
                                                value="{{ old('phone_number_biller') }}">
                                            @error('phone_number_biller')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email_address_biller_primary" class="form-label">Alamat Email
                                                <span class="text-danger">*</span></label>
                                            <input type="email"
                                                class="form-control @error('email_address_biller_primary') is-invalid @enderror"
                                                id="email_address_biller_primary" name="email_address_biller_primary"
                                                placeholder="Masukkan Alamat E-Mail Anda..."
                                                value="{{ old('email_address_biller_primary') }}">
                                            @error('email_address_biller_primary')
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
                            <div id="form-step-2" class="tab-pane" role="tabpanel" aria-labelledby="form-step-2"
                                style="overflow-y:scroll; max-height:100%;">
                                <div class="container row">
                                    <div class="col-0 col-md-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="true"
                                                id="isdataTechnicalsamewithdataPersonal"
                                                name="isdataTechnicalsamewithdataPersonal"
                                                {{ old('isdataTechnicalsamewithdataPersonal') == 'true' ? ' checked' : '' }}>
                                            <label class="form-check-label" for="isdataTechnicalsamewithdataPersonal">
                                                Data teknikal sama dengan data personal
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
                                            <input type="tel"
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
                                style="overflow-y:scroll; max-height:100%;">
                                <div class="border rounded px-3 pb-4 pt-2 mb-3 bg-light text-dark">
                                    <div class="" id="serviceOptionPersonal">
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
                                                @if ($service->category == 'Personal')
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
                                    <div class="mb-3 d-none" id="termOfPaymentPersonal">
                                        <p class="m-0 p-0 mb-1">
                                            Jenis Pembayaran
                                            <span class="text-danger">*</span>
                                        </p>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('topRadioBtnPersonal') is-invalid @enderror"
                                                type="radio" name="topRadioBtnPersonal" id="topRadioBtnMonthlyPersonal"
                                                value="Bulanan"
                                                {{ old('topRadioBtnPersonal') === 'Bulanan' ? 'checked' : null }} />
                                            <label class="form-check-label"
                                                for="topRadioBtnMonthlyPersonal">Bulanan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input @error('topRadioBtnPersonal') is-invalid @enderror"
                                                type="radio" name="topRadioBtnPersonal" id="topRadioBtnAnuallyPersonal"
                                                value="Tahunan"
                                                {{ old('topRadioBtnPersonal') === 'Tahunan' ? 'checked' : null }} />
                                            <label class="form-check-label"
                                                for="topRadioBtnAnuallyPersonal">Tahunan</label>
                                        </div>
                                        @error('topRadioBtnPersonal')
                                            <p class="small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="border rounded px-3 py-2 bg-white text-dark d-none"
                                        id="detailPaymentPersonal">
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
                            </div>
                            <div id="form-step-4" class="tab-pane" role="tabpanel" aria-labelledby="form-step-4"
                                style="overflow-y:scroll; max-height:100%;">
                                <div class="container-fluid p-5 mb-3" id="terms-and-condition">
                                    @include('user.pages.terms.index')
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="termsCbo" name="termsCbo">
                                    <label class="form-check-label" for="termsCbo">
                                        Saya menyetujui syarat dan ketentuan yang berlaku
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
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <!-- Smart Wizard -->
    <script src="{{ URL::to('lib/jquery-smartwizard/dist/js/jquery.smartWizard.min.js') }}"></script>
    <!-- Custom Script JS -->
    <script src="{{ URL::to('bin/js/newCustomer/personal/smartwizard.js') }}"></script>
    <script src="{{ URL::to('bin/js/newCustomer/personal/inputFilter.js') }}"></script>
    <script src="{{ URL::to('bin/js/newCustomer/personal/cboConfig.js') }}"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <!-- Leaflet Plugin JS -->
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.76.1/dist/L.Control.Locate.min.js" charset="utf-8">
    </script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <!-- GeoLocation ScriptJS -->
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
                $('#geolocation_personal').val(JSON.stringify(e.latlng));
            }

            map.on('locationfound', onLocationFound);

            var geocoder = L.Control.geocoder()
                .on('markgeocode', function(e) {
                    $('#address_personal').val(e.geocode.name);
                    $('#geolocation_personal').val(JSON.stringify(e.geocode.center));
                })
                .addTo(map);

            $('#service_product').on('change', function() {
                $('#serviceOptionPersonal').addClass('mb-3');
                $('#termOfPaymentPersonal').removeClass('d-none');
                $('#termOfPaymentPersonal').removeClass('mb-3');
                $('input[type=radio][name=topRadioBtnPersonal]').prop('checked', false);
                $('#detailPaymentPersonal').addClass('d-none');
            });

            $('input[type=radio][name=topRadioBtnPersonal]').change(function() {
                if (this.value == 'Bulanan') {
                    $('#detailPaymentPersonal').removeClass('d-none');
                    $('#termOfPaymentPersonal').addClass('mb-3');

                    var serviceData = {!! json_encode($servicesData) !!};
                    serviceData.forEach(element => {
                        if (element.package_name == $('#service_product').val() && element.period ==
                            'Bulanan') {
                            $('#serviceName').val(element.package_name);
                            $('#servicePrice').val(formatter.format(element
                                .package_price));
                            $('#termofpaymentDeals').val("Bulanan");
                        }
                    });
                } else if (this.value == 'Tahunan') {
                    $('#detailPaymentPersonal').removeClass('d-none');
                    $('#termOfPaymentPersonal').addClass('mb-3');

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
                $('#serviceOptionPersonal').addClass('mb-3');
                $('#termOfPaymentPersonal').removeClass('d-none');
                $('#termOfPaymentPersonal').removeClass('mb-3');
                $('#detailPaymentPersonal').addClass('d-none');

                if ($('input[type=radio][name=topRadioBtnPersonal]').is(':checked')) {
                    if ($('input[type=radio][name=topRadioBtnPersonal]').val() == 'Bulanan') {
                        $('#detailPaymentPersonal').removeClass('d-none');
                        $('#termOfPaymentPersonal').addClass('mb-3');

                        var serviceData = {!! json_encode($servicesData) !!};
                        serviceData.forEach(element => {
                            if (element.package_name == $('#service_product').val() && element.period ==
                                'Bulanan') {
                                $('#serviceName').val(element.package_name);
                                $('#servicePrice').val(formatter.format(element
                                    .package_price));
                                $('#termofpaymentDeals').val("Bulanan");
                            }
                        });
                    } else if ($('input[type=radio][name=topRadioBtnPersonal]').val() == 'Tahunan') {
                        $('#detailPaymentPersonal').removeClass('d-none');
                        $('#termOfPaymentPersonal').addClass('mb-3');

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

        });
    </script>
@endsection
