@extends('user.layouts.main')

@section('content-wrapper')
    <div class="container d-flex align-items-center justify-content-center" style="height: 100%;">
        <div class="card p-4" style="width: 35em;">
            <div class="card-body">
                <h2 class="fw-bold text-center">Pendaftaran Layanan Baru</h2>
                <p class="text-center">Pilih Jenis Pelanggan</p>
                <div class="row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <a href="{{ URL::to('new-member') }}">
                            <div class="card btn-pelanggan-baru">
                                <div class="card-body text-center">
                                    <img class="img-fluid mb-3" src="{{ URL::to('bin/img/add-user.png') }}"
                                        width="70">
                                    <p class="h5">Pelanggan Baru</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ URL::to('old-member') }}">
                            <div class="card btn-pelanggan-lama">
                                <div class="card-body text-center">
                                    <img class="img-fluid mb-3" src="{{ URL::to('bin/img/resume.png') }}" width="70">
                                    <p class="h5">Pelanggan Lama</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
