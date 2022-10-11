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
                                        <label for="address_personal" class="form-label">Pilih Lokasi Alamat<span
                                                class="text-danger">*</span></label>
                                        <div class="mb-3" id="map">
                                        </div>
                                        <div class="mb-3">
                                            <label for="address_personal" class="form-label">Alamat Lengkap <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control @error('address_personal') is-invalid @enderror" id="address_personal"
                                                name="address_personal" aria-describedby="address_personal_help" rows="3"
                                                placeholder="Masukkan Alamat Lengkap Anda..." readonly>{{ old('address_personal') }}</textarea>
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
                                style="min-height: 800px !important;">
                                <div class="border rounded px-3 pb-4 pt-2 mb-3 bg-light text-dark"
                                    style="overflow-y: scroll; max-height: 800px !important;">
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
                                    <div class="mb-3" id="option_package_type_price">
                                        <label for="package_top_type" class="form-label">
                                            Pilihan Tipe Harga
                                        </label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineTopPaketType"
                                                    id="inlineTopPaketType_1" value="Retail">
                                                <label class="form-check-label" for="inlineTopPaketType_1">Retail</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineTopPaketType"
                                                    id="inlineTopPaketType_2" value="Pemerintah">
                                                <label class="form-check-label"
                                                    for="inlineTopPaketType_2">Pemerintah</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3" id="option_custom_bulanan">
                                        <label for="custom_bulanan" class="form-label">Custom Field Bulan</label>
                                        <input class="form-control" type="text" id="custom_bulanan"
                                            name="custom_bulanan" placeholder="Masukkan Jumlah Bulan">
                                    </div>
                                    <div class="rounded border-white bg-white p-3 d-none" id="subTotalBayarWidget">
                                        <p class="fw-bold mb-4">Detail Pembayaran</p>
                                        <div class="row mb-2">
                                            <div class="col-12 col-lg-6 fw-bold">
                                                Nama Paket
                                            </div>
                                            <div class="col-12 col-lg-6" id="package_name_show_details">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12 col-lg-6 fw-bold">
                                                Jangka Waktu Pembayaran
                                            </div>
                                            <div class="col-12 col-lg-6" id="package_top_show_details">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <div class="p-2"
                                                    style="border-radius:12px; border: 1px solid #dedede; background-color: #dedede;">
                                                    <p class="fw-bold mb-2">Subtotal</p>
                                                    <p class="h1 fw-bold text-end" id="package_price_show_detail"></p>
                                                </div>
                                                <p>Harga diatas belum termasuk PPN 11%</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="RequestHandler" id="RequestHandler">
                            </div>
                            <div id="form-step-4" class="tab-pane" role="tabpanel" aria-labelledby="form-step-4"
                                style="overflow-y:scroll; min-height:550px !important;">
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
            var marker;
            var circle;
            var gpsRead = true;
            const widgetPopup = () => {
                return (
                    '<div>Teet</div>'
                );
            }

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            var lc = L.control.locate({
                locateOptions: {
                    enableHighAccuracy: true
                }
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
                        $('#address_personal').val(data.display_name);
                        $('#geolocation_personal').val(JSON.stringify(e.latlng));
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
                        $('#address_personal').val(data.display_name);
                        $('#geolocation_personal').val(JSON.stringify(e.latlng));
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
                            $('#address_personal').val(data.display_name);
                            $('#geolocation_personal').val(JSON.stringify(latLang));
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
                        $('#address_personal').val(data.display_name);
                        $('#geolocation_personal').val(JSON.stringify(latlng));
                    });
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
            $('#option_package_type_price').addClass('d-none');
            $('#option_custom_bulanan').addClass('d-none');
            $('#subTotalBayarWidget').addClass('d-none');
            $('#custom_bulanan').attr('readonly', false);

            $('#package_name').on('change', () => {
                $('#custom_bulanan').attr('readonly', false);
                $('#package_type').empty();
                $('#package_categories').empty();
                $('input[type=radio][name=inlineTopPaket]').prop('checked', false);
                $('input[type=radio][name=inlineTopPaketType]').prop('checked', false);
                $('#custom_bulanan').empty();

                $('#option_package_categories').addClass('d-none');
                $('#option_package_top').addClass('d-none');
                $('#option_package_type_price').addClass('d-none');
                $('#option_custom_bulanan').addClass('d-none');
                $('#subTotalBayarWidget').addClass('d-none');

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
                $('#custom_bulanan').attr('readonly', false);
                $('#package_categories').empty();
                $('input[type=radio][name=inlineTopPaket]').prop('checked', false);
                $('input[type=radio][name=inlineTopPaketType]').prop('checked', false);
                $('#custom_bulanan').empty();

                $('#option_package_categories').addClass('d-none');
                $('#option_package_top').addClass('d-none');
                $('#option_package_type_price').addClass('d-none');
                $('#option_custom_bulanan').addClass('d-none');
                $('#subTotalBayarWidget').addClass('d-none');

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
                $('#custom_bulanan').attr('readonly', false);
                $('input[type=radio][name=inlineTopPaket]').prop('checked', false);
                $('input[type=radio][name=inlineTopPaketType]').prop('checked', false);
                $('#custom_bulanan').empty();

                $('#option_package_top').addClass('d-none');
                $('#option_package_type_price').addClass('d-none');
                $('#option_custom_bulanan').addClass('d-none');
                $('#subTotalBayarWidget').addClass('d-none');

                $('#option_package_top').removeClass('d-none');
                dataShowDetail['package_categories'] = $('#package_categories').val();
                dataShowDetail['package_speed'] = isNaN(parseInt($('#package_categories').val())) ?
                    $('#package_categories').val() : '-';

                $('input[type=radio][name=inlineTopPaket]').change(function() {
                    $('#custom_bulanan').attr('readonly', false);
                    $('input[type=radio][name=inlineTopPaketType]').prop('checked', false);
                    $('#custom_bulanan').val('');

                    $('#subTotalBayarWidget').addClass('d-none');
                    if (this.value == 'Bulanan') {
                        dataShowDetail['package_top'] = 'Bulanan';

                        if (dataShowDetail['package_speed'] == dataShowDetail[
                                'package_categories']) {
                            // Data Paket Basic
                            packageData.forEach((element) => {
                                if (element.package_name == dataShowDetail[
                                        'package_name'] && element.package_type ==
                                    dataShowDetail['package_type'] && element
                                    .package_categories == dataShowDetail[
                                        'package_categories']) {
                                    hargaPaket = element.package_price;
                                }
                            });

                            $('#subTotalBayarWidget').addClass('d-none');
                            $('#option_package_type_price').addClass('d-none');
                            $('#option_custom_bulanan').removeClass('d-none');
                        } else {
                            $('#option_package_type_price').removeClass('d-none');
                            $('#option_custom_bulanan').addClass('d-none');

                            $('input:radio[name="inlineTopPaketType"]').change(
                                function() {
                                    if ($(this).is(':checked') && $(this).val() == 'Retail' &&
                                        dataShowDetail['package_top'] == 'Bulanan') {
                                        $('#custom_bulanan').attr('readonly', false);
                                        $('#option_custom_bulanan').removeClass('d-none');
                                        $('#custom_bulanan').val('');
                                        $('#subTotalBayarWidget').addClass('d-none');
                                        packageData.forEach((element) => {
                                            if (element.package_name == dataShowDetail[
                                                    'package_name'] && element
                                                .package_type == dataShowDetail[
                                                    'package_type'] && element
                                                .package_speed == dataShowDetail[
                                                    'package_categories']) {
                                                hargaPaket = element
                                                    .retail_package_price;
                                            }
                                        });
                                        dataShowDetail['package_option'] = 'Retail';
                                    } else if ($(this).is(':checked') && $(this).val() ==
                                        'Pemerintah' &&
                                        dataShowDetail['package_top'] == 'Bulanan') {
                                        $('#custom_bulanan').attr('readonly', false);
                                        $('#option_custom_bulanan').removeClass('d-none');
                                        $('#custom_bulanan').val('');
                                        $('#subTotalBayarWidget').addClass('d-none');
                                        packageData.forEach((element) => {
                                            if (element.package_name == dataShowDetail[
                                                    'package_name'] && element
                                                .package_type == dataShowDetail[
                                                    'package_type'] && element
                                                .package_speed == dataShowDetail[
                                                    'package_categories']) {
                                                hargaPaket = element
                                                    .government_package_price;
                                            }
                                        });
                                        dataShowDetail['package_option'] = 'Pemerintah';
                                    }
                                });
                        }
                    } else if (this.value == 'Tahunan') {
                        dataShowDetail['package_top'] = 'Tahunan';
                        $('#option_custom_bulanan').addClass('d-none');

                        if (dataShowDetail['package_speed'] == dataShowDetail[
                                'package_categories']) {
                            // Data Paket Basic
                            packageData.forEach((element) => {
                                if (element.package_name == dataShowDetail[
                                        'package_name'] && element.package_type ==
                                    dataShowDetail['package_type'] && element
                                    .package_categories == dataShowDetail[
                                        'package_categories']) {
                                    hargaPaket = element.package_price * 12;
                                }
                            });

                            $('#option_package_type_price').addClass('d-none');
                            $('#option_custom_bulanan').addClass('d-none');
                            $('#subTotalBayarWidget').removeClass('d-none');
                            $('#subTotalBayarWidget').removeClass('d-none');
                            $('#package_name_show_details').html("Paket " + dataShowDetail[
                                    'package_name'] + ' ' +
                                (isEmpty(dataShowDetail['package_categories']) ? '(' +
                                    dataShowDetail[
                                        'package_speed'] + ' Mbps) ' + dataShowDetail[
                                        'package_type'] :
                                    dataShowDetail['package_categories'] + ' (' +
                                    dataShowDetail[
                                        'package_type'] + ')'));
                            $('#package_top_show_details').html('Tahunan');

                            // Perhitungan Sub Total
                            const hargaSetelahPPN = parseInt(hargaPaket);
                            $('#package_price_show_detail').html(formatter.format(
                                hargaSetelahPPN));
                            dataShowDetail['fix_price'] = hargaSetelahPPN;
                            dataShowDetail['counted'] = 12;

                            // Send Data to Database
                            var arrResultData = {};
                            packageData.forEach((item) => {
                                if (dataShowDetail['package_speed'] == dataShowDetail[
                                        'package_categories']) {
                                    if (item.package_name === dataShowDetail[
                                            'package_name'] &&
                                        item.package_type === dataShowDetail[
                                            'package_type'] &&
                                        item.package_categories === dataShowDetail[
                                            'package_categories']) {
                                        arrResultData = item;
                                    }
                                } else {
                                    if (item.package_name === dataShowDetail[
                                            'package_name'] &&
                                        item.package_type === dataShowDetail[
                                            'package_type'] &&
                                        item.package_speed === dataShowDetail[
                                            'package_categories']) {
                                        arrResultData = item;
                                    }
                                }
                            });

                            var ResultJSON = {
                                'package_name': dataShowDetail['package_name'],
                                'package_type': dataShowDetail['package_type'],
                                'package_categories': isNaN(parseInt(dataShowDetail[
                                        'package_categories'])) ?
                                    dataShowDetail['package_categories'] : '-',
                                'package_speed': arrResultData['package_speed'],
                                'package_top': dataShowDetail['package_top'],
                                'package_price': dataShowDetail['fix_price'],
                                'optional_package': isEmpty(dataShowDetail['package_option']) ?
                                    null : dataShowDetail['package_option'],
                                'counted': dataShowDetail['counted']
                            };

                            $('#RequestHandler').val(JSON.stringify(ResultJSON));
                        } else {
                            $('#option_package_type_price').removeClass('d-none');

                            $('input:radio[name="inlineTopPaketType"]').change(
                                function() {
                                    if ($(this).is(':checked') && $(this).val() == 'Retail') {
                                        $('#custom_bulanan').attr('readonly', false);
                                        $('#option_custom_bulanan').addClass('d-none');
                                        $('#custom_bulanan').val('');
                                        $('#subTotalBayarWidget').addClass('d-none');
                                        packageData.forEach((element) => {
                                            if (element.package_name == dataShowDetail[
                                                    'package_name'] && element
                                                .package_type == dataShowDetail[
                                                    'package_type'] && element
                                                .package_speed == dataShowDetail[
                                                    'package_categories']) {
                                                hargaPaket = element
                                                    .retail_package_price * 12;
                                                dataShowDetail['fix_price'] =
                                                    hargaPaket;
                                            }
                                        });
                                        dataShowDetail['package_option'] = 'Retail';
                                    } else if ($(this).is(':checked') && $(this).val() ==
                                        'Pemerintah') {
                                        $('#custom_bulanan').attr('readonly', false);
                                        $('#option_custom_bulanan').addClass('d-none');
                                        $('#custom_bulanan').val('');
                                        $('#subTotalBayarWidget').addClass('d-none');
                                        packageData.forEach((element) => {
                                            if (element.package_name == dataShowDetail[
                                                    'package_name'] && element
                                                .package_type == dataShowDetail[
                                                    'package_type'] && element
                                                .package_speed == dataShowDetail[
                                                    'package_categories']) {
                                                hargaPaket = element
                                                    .government_package_price * 12;
                                                dataShowDetail['fix_price'] =
                                                    hargaPaket;
                                            }
                                        });
                                        dataShowDetail['package_option'] = 'Pemerintah';
                                    }

                                    $('#subTotalBayarWidget').removeClass('d-none');
                                    $('#package_name_show_details').html("Paket " +
                                        dataShowDetail['package_name'] + ' ' +
                                        (isEmpty(dataShowDetail['package_categories']) ?
                                            '(' + dataShowDetail[
                                                'package_speed'] + ' Mbps) ' +
                                            dataShowDetail['package_type'] :
                                            dataShowDetail['package_categories'] + ' (' +
                                            dataShowDetail[
                                                'package_type'] + ')'));
                                    $('#package_top_show_details').html('Tahunan');

                                    // Perhitungan Sub Total
                                    const hargaSetelahPPN = parseInt(hargaPaket);
                                    $('#package_price_show_detail').html(formatter.format(
                                        hargaSetelahPPN));
                                    dataShowDetail['fix_price'] = hargaSetelahPPN;
                                    dataShowDetail['counted'] = 12;

                                    // Send Data to Database
                                    var arrResultData = {};
                                    packageData.forEach((item) => {
                                        if (dataShowDetail['package_speed'] ==
                                            dataShowDetail[
                                                'package_categories']) {
                                            if (item.package_name === dataShowDetail[
                                                    'package_name'] &&
                                                item.package_type === dataShowDetail[
                                                    'package_type'] &&
                                                item.package_categories ===
                                                dataShowDetail['package_categories']) {
                                                arrResultData = item;
                                            }
                                        } else {
                                            if (item.package_name === dataShowDetail[
                                                    'package_name'] &&
                                                item.package_type === dataShowDetail[
                                                    'package_type'] &&
                                                item.package_speed === dataShowDetail[
                                                    'package_categories']) {
                                                arrResultData = item;
                                            }
                                        }
                                    });

                                    var ResultJSON = {
                                        'package_name': dataShowDetail['package_name'],
                                        'package_type': dataShowDetail['package_type'],
                                        'package_categories': isNaN(parseInt(dataShowDetail[
                                                'package_categories'])) ?
                                            dataShowDetail['package_categories'] : '-',
                                        'package_speed': arrResultData['package_speed'],
                                        'package_top': dataShowDetail['package_top'],
                                        'package_price': dataShowDetail['fix_price'],
                                        'optional_package': isEmpty(dataShowDetail[
                                            'package_option']) ? null : dataShowDetail[
                                            'package_option'],
                                        'counted': dataShowDetail['counted']
                                    };

                                    $('#RequestHandler').val(JSON.stringify(ResultJSON));
                                });
                        }
                    }
                });
            });

            $('#custom_bulanan').on('input', function() {
                if ($('#custom_bulanan').val() < 12 && $('#custom_bulanan').val() != "") {
                    const hargaCustomBulanan = $('#custom_bulanan').val();

                    $('#subTotalBayarWidget').removeClass('d-none');
                    $('#package_name_show_details').html("Paket " + dataShowDetail['package_name'] + ' ' +
                        (isEmpty(dataShowDetail['package_categories']) ? '(' + dataShowDetail[
                                'package_speed'] + ' Mbps) ' + dataShowDetail['package_type'] :
                            dataShowDetail['package_categories'] + ' (' + dataShowDetail[
                                'package_type'] + ')'));
                    $('#package_top_show_details').html(hargaCustomBulanan + ' Bulan');
                    dataShowDetail['counted'] = hargaCustomBulanan;

                    // Perhitungan Sub Total
                    const hargaSebelumPPN = parseInt(hargaPaket) * hargaCustomBulanan;
                    $('#package_price_show_detail').html(formatter.format(hargaSebelumPPN));
                    dataShowDetail['fix_price'] = hargaSebelumPPN;

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
                        'package_price': dataShowDetail['fix_price'],
                        'optional_package': isEmpty(dataShowDetail['package_option']) ? null :
                            dataShowDetail['package_option'],
                        'counted': dataShowDetail['counted']
                    };

                    $('#RequestHandler').val(JSON.stringify(ResultJSON));
                } else if ($('#custom_bulanan').val() >= 12) {
                    $('#subTotalBayarWidget').addClass('d-none');
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
                return (
                    isFinite(a = this.convert(a).valueOf()) &&
                    isFinite(b = this.convert(b).valueOf()) ?
                    (a > b) - (a < b) :
                    NaN
                );
            },
            inRange: function(d, start, end) {
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
