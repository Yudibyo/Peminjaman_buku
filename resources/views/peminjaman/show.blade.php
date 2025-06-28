@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Detail Peminjaman') }}</span>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12 text-center">
                            <div class="mb-3">
                                <i class="fas fa-bookmark fa-5x text-primary"></i>
                            </div>
                            <h2>Peminjaman #{{ $peminjaman->id_transaksi }}</h2>
                            
                            @php
                                $today = new DateTime();
                                $kembali = new DateTime($peminjaman->tanggal_kembali);
                                $selisih = $today->diff($kembali);
                                $terlambat = $today > $kembali;
                            @endphp
                            
                            @if($terlambat)
                                <div class="alert alert-danger" role="alert">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    Terlambat {{ $selisih->days }} hari dari tanggal pengembalian
                                </div>
                            @else
                                <div class="alert alert-success" role="alert">
                                    <i class="fas fa-check-circle me-1"></i>
                                    Peminjaman aktif, sisa {{ $selisih->days }} hari lagi
                                </div>
                            @endif
                        </div>
                    </div>

                    <h4 class="border-bottom pb-2 mb-3">Informasi Peminjaman</h4>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Data Peminjam</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th style="width: 40%">Nama</th>
                                    <td>{{ $peminjaman->user->nama ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $peminjaman->user->email ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td>{{ $peminjaman->user->phone ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Tanggal Peminjaman</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th style="width: 40%">Pinjam</th>
                                    <td>{{ $peminjaman->tanggal_pinjam }}</td>
                                </tr>
                                <tr>
                                    <th>Kembali</th>
                                    <td>{{ $peminjaman->tanggal_kembali }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($terlambat)
                                            <span class="badge bg-danger">Terlambat {{ $selisih->days }} hari</span>
                                        @else
                                            <span class="badge bg-success">Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <h4 class="border-bottom pb-2 mb-3">Detail Buku</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <th style="width: 20%">Judul</th>
                                    <td>{{ $peminjaman->book->judul ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Penulis</th>
                                    <td>{{ $peminjaman->book->penulis ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Penerbit</th>
                                    <td>{{ $peminjaman->book->penerbit ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Terbit</th>
                                    <td>{{ $peminjaman->book->tahun_terbit ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td>{{ $peminjaman->book->kategori ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <form action="{{ route('peminjaman.destroy', $peminjaman->id_transaksi) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check-circle me-1"></i> Kembalikan Buku
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 