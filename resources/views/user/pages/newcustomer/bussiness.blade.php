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
                    @if (isset($salesID))
                        </br>
                        <p class="h6 mt-3"><b>SID</b> : {{ $salesID }}</p>
                    @endif
                </h2>
                <!-- SmartWizard html -->
                <form action="{{ URL::to('new-member/bussiness') }}" method="POST" id="bussinessForm"
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
                                    Data Penanggung Jawab
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
                            <div id="form-step-0" class="tab-pane" role="tabpanel" aria-labelledby="form-step-0"
                                style="overflow-y:scroll; max-height:100%;">
                                <div class="container row">
                                    <div class="col-0 col-md-6">
                                        @if (isset($salesID))
                                            <input type="hidden" name="salesID" value="{{ $salesID }}">
                                        @endif
                                        <input type="hidden" name="uuid" value="{{ Request::segment(3) }}">
                                        <div class="mb-3">
                                            <label for="pic_name" class="form-label">Nama
                                                Lengkap <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('pic_name') is-invalid @enderror" id="pic_name"
                                                name="pic_name" placeholder="Masukkan Nama Lengkap Anda..."
                                                value="{{ old('pic_name') }}">
                                            @error('pic_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="pic_identity_number" class="form-label">Nomor Identitas
                                                (KTP/SIM/KITAS) <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('pic_identity_number') is-invalid @enderror"
                                                id="pic_identity_number" name="pic_identity_number"
                                                placeholder="Masukkan Nomor Identitas Anda..."
                                                value="{{ old('pic_identity_number') }}">
                                            @error('pic_identity_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="pic_email_address" class="form-label">Alamat Email
                                                <span class="text-danger">*</span></label>
                                            <input type="email"
                                                class="form-control @error('pic_email_address') is-invalid @enderror"
                                                id="pic_email_address" name="pic_email_address"
                                                placeholder="Masukkan Alamat E-Mail Anda..."
                                                value="{{ old('pic_email_address') }}">
                                            @error('pic_email_address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="pic_phone_number" class="form-label">Nomor HP/WA yang aktif
                                                <span class="text-danger">*</span></label>
                                            <input type="tel"
                                                class="form-control @error('pic_phone_number') is-invalid @enderror"
                                                id="pic_phone_number" name="pic_phone_number"
                                                placeholder="Masukkan Nomor Handphone/Whatsapp Anda..."
                                                value="{{ old('pic_phone_number') }}">
                                            @error('pic_phone_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <style>
                                            #map {
                                                height: 300px;
                                            }
                                        </style>
                                        <div class="mb-3" id="map">
                                        </div>
                                        <input type="hidden" name="geolocation_bussiness" id="geolocation_bussiness"
                                            value="">
                                        <div class="mb-3">
                                            <label for="pic_address" class="form-label">Alamat Lengkap <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control @error('pic_address') is-invalid @enderror" id="pic_address" name="pic_address"
                                                aria-describedby="pic_address_help" rows="4" placeholder="Masukkan Alamat Lengkap Anda...">{{ old('pic_address') }}</textarea>
                                            <div id="pic_address_help" class="form-text mb-1">
                                                Alamat ini digunakan sebagai alamat pemasangan internet.
                                            </div>
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
                                                value="{{ old('company_name') }}">
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
                                                name="company_address" placeholder="Masukkan Alamat Perusahaan Anda..." rows="4">{{ old('company_address') }}</textarea>
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
                                                name="company_npwp" placeholder="__.___.___._-___.___" data-slots="_"
                                                size="13" value="{{ old('company_npwp') }}">
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
                                                value="{{ old('company_phone_number') }}">
                                            @error('company_phone_number')
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
                                        <div class="mb-3">
                                            <label for="service_selfie_photo" class="form-label">Upload Foto Selfie dengan
                                                KTP</label>
                                            <input
                                                class="form-control @error('service_selfie_photo') is-invalid @enderror"
                                                type="file" id="service_selfie_photo" name="service_selfie_photo">
                                            @error('service_selfie_photo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="form-step-1" class="tab-pane" role="tabpanel" aria-labelledby="form-step-1"
                                style="overflow-y:scroll; max-height:100%;">
                                <div class="container row">
                                    <div class="col-0 col-md-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value="true"
                                                id="isdataBillersamewithdataPic" name="isdataBillersamewithdataPic">
                                            <label class="form-check-label" for="isdataBillersamewithdataPic"
                                                {{ old('isdataBillersamewithdataPic') == 'true' ? ' checked' : '' }}>
                                                Data pembayaran sama dengan data penanggung jawab
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
                            <div id="form-step-2" class="tab-pane" role="tabpanel" aria-labelledby="form-step-2"
                                style="overflow-y:scroll; max-height:100%;">
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
                                style="overflow-y:scroll; max-height:100%;">
                                <div class="border rounded px-3 pb-4 pt-2 mb-3 bg-light text-dark">
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
                                                @if ($service->category == 'Bussiness')
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
                            </div>
                            <div id="form-step-4" class="tab-pane" role="tabpanel" aria-labelledby="form-step-4"
                                style="overflow-y:scroll; max-height:100%;">
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
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script src="{{ URL::to('lib/jquery-smartwizard/dist/js/jquery.smartWizard.min.js') }}"></script>
    <!-- Custom Script JS -->
    <script src="{{ URL::to('bin/js/newCustomer/bussiness/smartwizard.js') }}"></script>
    <script src="{{ URL::to('bin/js/newCustomer/bussiness/inputFilter.js') }}"></script>
    <script src="{{ URL::to('bin/js/newCustomer/bussiness/cboConfig.js') }}"></script>
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
                $('#geolocation_bussiness').val(JSON.stringify(e.latlng));
            }
            map.on('locationfound', onLocationFound);
            var geocoder = L.Control.geocoder()
                .on('markgeocode', function(e) {
                    $('#pic_address').val(e.geocode.name);
                    $('#geolocation_bussiness').val(JSON.stringify(e.geocode.center));
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
                    $('#detailPaymentBussiness').removeClass('d-none');
                    $('#termOfPaymentBussiness').addClass('mb-3');

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
                        $('#detailPaymentBussiness').removeClass('d-none');
                        $('#termOfPaymentBussiness').addClass('mb-3');

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
        });
    </script>
    <script src="{{ URL::to('lib/jQuerymask/regex-mask-plugin.js') }}"></script>
    <script>
        // $('#bussinessForm').on('submit', () => {
        //     grecaptcha.execute();
        // });

        document.addEventListener('DOMContentLoaded', () => {
            for (const el of document.querySelectorAll("[placeholder][data-slots]")) {
                const pattern = el.getAttribute("placeholder"),
                    slots = new Set(el.dataset.slots || "_"),
                    prev = (j => Array.from(pattern, (c, i) => slots.has(c) ? j = i + 1 : j))(0),
                    first = [...pattern].findIndex(c => slots.has(c)),
                    accept = new RegExp(el.dataset.accept || "\\d", "g"),
                    clean = input => {
                        input = input.match(accept) || [];
                        return Array.from(pattern, c =>
                            input[0] === c || slots.has(c) ? input.shift() || c : c
                        );
                    },
                    format = () => {
                        const [i, j] = [el.selectionStart, el.selectionEnd].map(i => {
                            i = clean(el.value.slice(0, i)).findIndex(c => slots.has(c));
                            return i < 0 ? prev[prev.length - 1] : back ? prev[i - 1] || first : i;
                        });
                        el.value = clean(el.value).join``;
                        el.setSelectionRange(i, j);
                        back = false;
                    };
                let back = false;
                el.addEventListener("keydown", (e) => back = e.key === "Backspace");
                el.addEventListener("input", format);
                el.addEventListener("focus", format);
                el.addEventListener("blur", () => el.value === pattern && (el.value = ""));
            }
        });
    </script>
@endsection
