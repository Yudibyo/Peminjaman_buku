@extends('layouts.app')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="mb-1 fw-bold text-primary">
                        <i class="fas fa-book-open me-2"></i>{{ __('Koleksi Buku LABOON') }}
                    </h1>
                    <p class="text-muted mb-0">Kelola dan lihat daftar buku perpustakaan</p>
                </div>
                @if(Auth::user()->role === 'admin')
                <a href="{{ route('books.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus-circle me-2"></i> Tambah Buku
                </a>
                @endif
            </div>

            <!-- Main Card -->
            <div class="card border-0 shadow-sm">
                <!-- Card Header -->
                <div class="card-header bg-white p-4 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1 fw-bold">
                                <i class="fas fa-list me-2 text-primary"></i>{{ __('Daftar Buku') }}
                            </h5>
                            <p class="text-muted mb-0 small">Total {{ $books->total() }} buku</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <form class="d-flex me-3" method="GET" action="{{ route('books.index') }}">
                                <div class="input-group" style="min-width: 300px;">
                                    <input type="text" name="search" class="form-control border-end-0" 
                                           placeholder="Cari judul buku, penulis, atau kategori..." 
                                           value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary border-start-0" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-0">
                    @if($books->isEmpty())
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-books fa-4x text-muted opacity-50"></i>
                            </div>
                            <h5 class="text-muted mb-3">Belum ada data buku</h5>
                            <p class="text-muted mb-4">Silakan tambahkan buku baru untuk memulai</p>
                            @if(Auth::user()->role === 'admin')
                            <a href="{{ route('books.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i> Tambah Buku Baru
                            </a>
                            @endif
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4" style="width: 60px;">No</th>
                                        <th style="width: 70px;">Cover</th>
                                        <th style="min-width: 300px;">Judul Buku</th>
                                        <th style="min-width: 150px;">Penulis</th>
                                        <th style="width: 120px;">Kategori</th>
                                        <th style="width: 100px;">Tahun</th>
                                        <th style="width: 100px;">Stok</th>
                                        <th class="text-center" style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($books as $index => $book)
                                        <tr class="border-bottom">
                                            <td class="ps-4 fw-bold text-muted">{{ $index + $books->firstItem() }}</td>
                                            <td>
                                                @if($book->cover)
                                                    <img src="{{ asset('uploads/covers/'.$book->cover) }}" alt="Cover {{ $book->judul }}" style="width:40px; height:55px; object-fit:cover; border-radius:4px; box-shadow:0 1px 4px rgba(0,0,0,0.08);">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center" style="width:40px; height:55px; border-radius:4px;">
                                                        <i class="fas fa-book text-primary"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1 fw-bold text-dark">{{ $book->judul }}</h6>
                                                        @if($book->isbn)
                                                        <div class="small text-muted">
                                                            <i class="fas fa-barcode me-1"></i>ISBN: {{ $book->isbn }}
                                                        </div>
                                                        @endif
                                                        @if($book->penerbit)
                                                        <div class="small text-muted">
                                                            <i class="fas fa-building me-1"></i>{{ $book->penerbit }}
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fw-semibold">{{ $book->penulis }}</div>
                                            </td>
                                            <td>
                                                <span class="badge rounded-pill bg-info text-dark px-3 py-2">
                                                    <i class="fas fa-tag me-1"></i>{{ $book->kategori }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary px-3 py-2">{{ $book->tahun_terbit }}</span>
                                            </td>
                                            <td>
                                                @if($book->stok > 5)
                                                    <span class="badge rounded-pill bg-success px-3 py-2">
                                                        <i class="fas fa-check-circle me-1"></i>{{ $book->stok }}
                                                    </span>
                                                @elseif($book->stok > 0)
                                                    <span class="badge rounded-pill bg-warning text-dark px-3 py-2">
                                                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $book->stok }}
                                                    </span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger px-3 py-2">
                                                        <i class="fas fa-times-circle me-1"></i>Habis
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('books.show', $book->id_buku) }}" 
                                                       class="btn btn-sm btn-outline-info" 
                                                       title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if(Auth::user()->role === 'admin')
                                                    <a href="{{ route('books.edit', $book->id_buku) }}" 
                                                       class="btn btn-sm btn-outline-warning" 
                                                       title="Edit Buku">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('books.destroy', $book->id_buku) }}" 
                                                          method="POST" 
                                                          class="d-inline" 
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-outline-danger" 
                                                                title="Hapus Buku">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="px-2 px-md-4 py-4 border-top bg-light">
                            {{ $books->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.book-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border-radius: 12px;
    overflow: hidden;
}

.book-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
}

.book-cover-container {
    height: 200px;
    overflow: hidden;
    background-color: #f8f9fa;
}

.book-cover-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.book-card:hover .book-cover-img {
    transform: scale(1.05);
}

.book-cover-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.card-body {
    padding: 1.25rem;
}

.btn-outline-primary:hover {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: white;
}

.btn-outline-warning:hover {
    background-color: #ffc107;
    border-color: #ffc107;
    color: #212529;
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    border-color: #dc3545;
    color: white;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .book-cover-container {
        height: 180px;
    }
    
    .card-body {
        padding: 1rem;
    }
}

@media (max-width: 576px) {
    .book-cover-container {
        height: 160px;
    }
}
</style>
@endsection