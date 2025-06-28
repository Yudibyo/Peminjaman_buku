@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Tambah Peminjaman Baru') }}</span>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    @php
                        $user = Auth::user();
                        $buku = isset($selectedBook) ? $selectedBook : (isset($books) && request('id_buku') ? $books->where('id_buku', request('id_buku'))->first() : null);
                    @endphp
                    <form method="POST" action="{{ route('peminjaman.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Peminjam</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $user->nama }}" readonly>
                                <input type="hidden" name="id_user" value="{{ $user->id_user }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Buku</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $buku ? $buku->judul : '' }}" readonly>
                                <input type="hidden" name="id_buku" value="{{ $buku ? $buku->id_buku : '' }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal_pinjam" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal Pinjam') }}</label>

                            <div class="col-md-6">
                                <input id="tanggal_pinjam" type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>

                                @error('tanggal_pinjam')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal_kembali" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal Kembali') }}</label>

                            <div class="col-md-6">
                                <input id="tanggal_kembali" type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" name="tanggal_kembali" value="{{ old('tanggal_kembali', date('Y-m-d', strtotime('+7 days'))) }}" required>

                                @error('tanggal_kembali')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="text-muted">Maksimal peminjaman 7 hari</small>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> {{ __('Simpan Peminjaman') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 