@extends('user.layouts.main')

@section('content-wrapper')
    <div class="container d-flex flex-column align-items-center justify-content-between" style="height: 100%;">
        <div class="card p-4 mt-5">
            <div class="card-body">
                <h2 class="fw-bold text-center">Pendaftaran Layanan Baru</h2>
                <p class="text-center">Pilih Tipe Pelanggan</p>
                <div class="row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        @if (isset($salesID))
                            <form action="{{ URL::to(Request::segment(1) . '/personal/' . $UUID) }}" method="POST">
                                @csrf
                                <input type="hidden" name="salesID" value="{{ $salesID }}">
                                <div class="card btn-pelanggan-baru">
                                    <button class="btn p-0 m-0 text-white"
                                        style="text-decoration: none; background: transparent;" type="submit">
                                        <div class="card-body text-center">
                                            <img class="img-fluid mb-3" src="{{ URL::to('bin/img/personal.png') }}"
                                                width="70">
                                            <p class="h5">Personal</p>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        @else
                            <a href="{{ URL::to(Request::segment(1) . '/personal/' . $UUID) }}"
                                style="text-decoration: none;">
                                <div class="card btn-pelanggan-baru">
                                    <div class="card-body text-center">
                                        <img class="img-fluid mb-3" src="{{ URL::to('bin/img/personal.png') }}"
                                            width="70">
                                        <p class="h5">Personal</p>
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        @if (isset($salesID))
                            <form action="{{ URL::to(Request::segment(1) . '/bussiness/' . $UUID) }}" method="POST">
                                @csrf
                                <input type="hidden" name="salesID" value="{{ $salesID }}">
                                <div class="card btn-pelanggan-lama">
                                    <button class="btn p-0 m-0 text-white"
                                        style="text-decoration: none; background: transparent;" type="submit">
                                        <div class="card-body text-center">
                                            <img class="img-fluid mb-3" src="{{ URL::to('bin/img/bisnis.png') }}"
                                                width="70">
                                            <p class="h5">Bisnis</p>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        @else
                            <a href="{{ URL::to(Request::segment(1) . '/bussiness/' . $UUID) }}"
                                style="text-decoration: none;">
                                <div class="card btn-pelanggan-lama">
                                    <div class="card-body text-center">
                                        <img class="img-fluid mb-3" src="{{ URL::to('bin/img/bisnis.png') }}"
                                            width="70">
                                        <p class="h5">Bisnis</p>
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="container align-items-end">
            <a href="{{ URL::to('/') }}" class="btn btn-primary mb-3">
                <i class="fas fa-arrow-alt-circle-left me-1"></i>
                Kembali Ke Halaman Utama
            </a>
        </div>
    </div>
@endsection

@section('JS')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(() => {
            if ({!! json_encode(session()->has('successMessage')) !!}) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: {!! json_encode(session('successMessage')) !!},
                    icon: 'success'
                })
            } else if ({!! json_encode(session()->has('errorMessage')) !!}) {
                Swal.fire({
                    title: 'Gagal!',
                    text: {!! json_encode(session('errorMessage')) !!},
                    icon: 'error'
                })
            }
        });
    </script>
@endsection
