@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0 fw-bold"><i class="fas fa-bookmark me-2"></i>{{ __('Peminjaman Buku LABOON') }}</h1>
                <a href="{{ route('user.books.index') }}" class="btn btn-success">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Peminjaman
                </a>
            </div>
            
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center">
                    <span class="fw-bold fs-5"><i class="fas fa-clipboard-list me-2"></i>{{ __('Daftar Peminjaman') }}</span>
                    <div class="d-flex">
                        <form class="d-flex me-2" method="GET" action="{{ route('peminjaman.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari peminjam..." value="{{ request('search') }}">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    @if($peminjaman->isEmpty())
                        <div class="alert alert-info m-4 text-center">
                            <i class="fas fa-info-circle fa-2x mb-3"></i>
                            <p class="mb-0">Belum ada data peminjaman. Silakan tambahkan peminjaman baru.</p>
                            <a href="{{ route('peminjaman.create') }}" class="btn btn-success mt-3">
                                <i class="fas fa-plus-circle me-1"></i> Tambah Peminjaman Baru
                            </a>
                        </div>
                    @else
                        <div class="row">
                            @foreach($peminjaman as $index => $p)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 shadow-sm border-0">
                                        <div class="card-body text-center d-flex flex-column justify-content-between">
                                            <div>
                                                @if($p->book && $p->book->cover)
                                                    <img src="{{ asset('uploads/covers/'.$p->book->cover) }}" alt="Cover Buku" style="width:100px;height:140px;object-fit:cover;border-radius:8px;margin-bottom:10px;">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center mb-2" style="width: 100px; height: 140px; margin: 0 auto 10px auto;">
                                                        <span class="text-muted">No Cover</span>
                                                    </div>
                                                @endif
                                                <h5 class="card-title fw-bold mt-2">{{ $p->book->judul ?? 'Buku tidak ditemukan' }}</h5>
                                                <div class="mb-2 text-muted small">
                                                    <i class="fas fa-user me-1"></i> {{ $p->user->nama ?? 'User tidak ditemukan' }}
                                                </div>
                                                <div class="mb-1">
                                                    <i class="fas fa-calendar-alt me-1"></i> Pinjam: <span class="fw-semibold">{{ $p->tanggal_pinjam }}</span>
                                                </div>
                                                <div class="mb-2">
                                                    <i class="fas fa-calendar-check me-1"></i> Kembali: <span class="fw-semibold">{{ $p->tanggal_kembali }}</span>
                                                </div>
                                                @php
                                                    $today = new DateTime();
                                                    $kembali = new DateTime($p->tanggal_kembali);
                                                    $selisih = $today->diff($kembali);
                                                    $terlambat = $today > $kembali;
                                                @endphp
                                                @if($terlambat)
                                                    <span class="badge rounded-pill bg-danger mb-2">
                                                        <i class="fas fa-exclamation-circle me-1"></i>
                                                        Terlambat {{ $selisih->days }} hari
                                                    </span>
                                                @else
                                                    <span class="badge rounded-pill bg-success mb-2">
                                                        <i class="fas fa-check-circle me-1"></i>
                                                        Aktif
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="d-flex justify-content-center gap-2 mt-3">
                                                <a href="{{ route('peminjaman.show', $p->id_transaksi) }}" class="btn btn-sm btn-primary" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form action="{{ route('peminjaman.destroy', $p->id_transaksi) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-success" title="Kembalikan Buku">
                                                        <i class="fas fa-check me-1"></i> Kembalikan
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="px-3 py-3">
                            {{ $peminjaman->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection