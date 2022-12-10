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
                <form action="{{ URL::to('new-member/bussiness') }}" method="POST" id="bussinessForm"
                    enctype="multipart/form-data">
                    @csrf
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
                                            <label for="gender_bussiness" class="form-label">
                                                Jenis Kelamin
                                                <span class="text-danger">*</span>
                                            </label>
                                            @php
                                                $genderSelect = [
                                                    [
                                                        'kode_gender' => 'M',
                                                        'nama_gender' => 'Laki - Laki',
                                                    ],
                                                    [
                                                        'kode_gender' => 'F',
                                                        'nama_gender' => 'Perempuan',
                                                    ],
                                                ];
                                            @endphp
                                            <select class="form-select" name="gender_bussiness" id="gender_bussiness">
                                                <option disabled selected>Pilih Jenis Kelamin...</option>
                                                @foreach ($genderSelect as $item)
                                                    <option value="{{ $item['kode_gender'] }}">{{ $item['nama_gender'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <label for="custPOBBussiness" class="form-label">
                                                    Tempat Lahir
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="custPOBBussiness"
                                                    name="custPOBBussiness" placeholder="Masukkan Tempat Lahir Anda..."
                                                    value="{{ old('custPOBBussiness') }}">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="custDOBBussiness" class="form-label">
                                                    Tanggal Lahir
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="date" class="form-control" id="custDOBBussiness"
                                                    name="custDOBBussiness" placeholder="Masukkan Tanggal Lahir Anda..."
                                                    value="{{ old('custDOBBussiness') }}">
                                            </div>
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
                                            <label for="pic_phone_number" class="form-label">
                                                Nomor HP/WA yang aktif
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text fw-bold bg-success text-white">+62</span>
                                                <input type="text"
                                                    class="form-control @error('pic_phone_number') is-invalid @enderror"
                                                    id="pic_phone_number" name="pic_phone_number"
                                                    placeholder="Masukkan Nomor Handphone/Whatsapp Anda..."
                                                    value="{{ old('pic_phone_number') }}" maxlength="11">
                                            </div>
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
                                        <label for="address_personal" class="form-label">Pilih Lokasi Alamat<span
                                                class="text-danger">*</span></label>
                                        <div class="mb-3" id="map">
                                        </div>
                                        <div class="form-text mb-3">
                                            Silahkan Cari, Geser dan Pilih Lokasi Anda.
                                        </div>
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
                                        <input type="hidden" name="geolocation_bussiness" id="geolocation_bussiness"
                                            value="">
                                        <div class="mb-3">
                                            <label for="inputGroupIdentityNumberPersonal" class="form-label">
                                                Nomor Identitas
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group" id="inputGroupIdentityNumberPersonal"
                                                style="width: 100%;">
                                                <select class="form-select bg-success text-white"
                                                    name="option_pic_identity_number" id="option_pic_identity_number"
                                                    style="width: 20%;">
                                                    <option disabled selected>Pilih...</option>
                                                    <option value="KTP">KTP</option>
                                                    <option value="KITAS">KITAS</option>
                                                    <option value="PASPOR">PASPOR</option>
                                                </select>
                                                <input type="text"
                                                    class="form-control @error('pic_identity_number') is-invalid @enderror col-sm-10"
                                                    id="pic_identity_number" name="pic_identity_number"
                                                    placeholder="Masukkan Nomor Identitas Anda..."
                                                    value="{{ old('pic_identity_number') }}" style="width: 80%;">
                                                @error('pic_identity_number')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="service_identity_photo" class="form-label">Upload Foto Identitas
                                                <span class="text-danger">*</span>
                                            </label>
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
                                            <label for="company_npwp_sppkp" class="form-label">No. NPWP/SPPKP Perusahaan
                                                <span class="text-danger">*</span></label>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('company_npwp_sppkp') is-invalid @enderror"
                                                name="company_npwp_sppkp" placeholder="__.___.___._-___.___"
                                                data-slots="_" size="13" value="{{ old('company_npwp_sppkp') }}"
                                                id="company_npwp_sppkp">
                                            @error('company_npwp_sppkp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="company_npwp_sppkp_upload" class="form-label">Upload NPWP/SPPKP
                                                Perusahaan
                                                <span class="text-danger">*</span></label>
                                            </label>
                                            <input
                                                class="form-control @error('company_npwp_sppkp_upload') is-invalid @enderror"
                                                type="file" id="company_npwp_sppkp_upload"
                                                name="company_npwp_sppkp_upload">
                                            @error('company_npwp_sppkp_upload')
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
                                            <label for="billing_phone" class="form-label">
                                                Nomor Handphone
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text fw-bold bg-success text-white"
                                                    id="billing_phone_label">+62</span>
                                                <input type="tel"
                                                    class="form-control @error('billing_phone') is-invalid @enderror"
                                                    id="billing_phone" name="billing_phone"
                                                    placeholder="Masukkan Nomor Handphone Anda..."
                                                    value="{{ old('billing_phone') }}" maxlength="11">
                                            </div>
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
                                            <label for="phone_number_technical" class="form-label">
                                                Nomor Handphone
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text fw-bold bg-success text-white"
                                                    id="phone_number_technical_label">+62</span>
                                                <input type="tel"
                                                    class="form-control @error('phone_number_technical') is-invalid @enderror"
                                                    id="phone_number_technical" name="phone_number_technical"
                                                    placeholder="Masukkan Nomor Handphone Anda..."
                                                    value="{{ old('phone_number_technical') }}" maxlength="11">
                                            </div>
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
                                    <input type="hidden" name="kode_cabang_personal_hidden"
                                        id="kode_cabang_personal_hidden">
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
                                style="overflow-y:scroll; min-height:550px !important;">
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

    @php
        $errorMessage = session()->has('errorMessage') ? session('errorMessage') : false;
    @endphp
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
    <script src="{{ URL::to('bin/js/newCustomer/bussiness/mapconfig.js') }}"></script>
    <script src="{{ URL::to('lib/jQuerymask/regex-mask-plugin.js') }}"></script>
    <script src="{{ URL::to('bin/js/newCustomer/bussiness/inputmask.js') }}"></script>
    <!-- Data Layanan ScriptJS -->
    <script>
        var splittingValue = [];
        var getDataLayananArr;

        $(document).ready(async () => {
            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            });

            getDataLayananArr = await getDataLayananAPI();

            $('#branch_id').on('change', () => {
                const kode_cabang = $('#branch_id').val();
                $('#kode_cabang_personal_hidden').val(kode_cabang);
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
        });

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
    <script src="{{ URL::to('bin/js/newCustomer/bussiness/dateconverter.js') }}"></script>
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
