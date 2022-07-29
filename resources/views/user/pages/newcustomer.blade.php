@extends('user.layouts.main')

@section('content-wrapper')
    <div class="container d-flex align-items-center justify-content-center" style="height: 100%;">
        <div class="card p-4" style="width: 35em;">
            <div class="card-body">
                <h2 class="fw-bold text-center">Pendaftaran Layanan Baru</h2>
                <p class="text-center">Pilih Tipe Pelanggan</p>
                <div class="row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <a href="{{ URL::to(Request::segment(1) . '/personal/' . $UUID) }}" style="text-decoration: none;">
                            <div class="card btn-pelanggan-baru">
                                <div class="card-body text-center">
                                    <img class="img-fluid mb-3" src="{{ URL::to('bin/img/personal.png') }}" width="70">
                                    <p class="h5">Personal</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ URL::to(Request::segment(1) . '/bussiness/' . $UUID) }}" style="text-decoration: none;">
                            <div class="card btn-pelanggan-lama">
                                <div class="card-body text-center">
                                    <img class="img-fluid mb-3" src="{{ URL::to('bin/img/bisnis.png') }}" width="70">
                                    <p class="h5">Bisnis</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <a href="{{ URL::to('/') }}" class="btn btn-primary mb-3">
            <i class="fas fa-arrow-alt-circle-left me-1"></i>
            Kembali Ke Halaman Utama
        </a>
    </div>

    @php
    $messageStatus = session()->has('message') ? session('message') : false;
    @endphp
@endsection

@section('JS')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        var msgstat = "<?php echo "$messageStatus"; ?>";
        $(document).ready(() => {
            if (msgstat) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: msgstat,
                    icon: 'success',
                    confirmButtonText: 'Baik, akan saya tunggu.'
                })
            }
        });
    </script>
@endsection
