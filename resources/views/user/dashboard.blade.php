@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Dashboard</div>
                <div class="card-body">
                    {{-- Daftar Buku Vertikal --}}
                    <h5 class="mb-3">Daftar Buku</h5>
                    <style>
                        .book-card-user-vertical {
                            background: #fff;
                            border-radius: 16px;
                            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
                            color: #333;
                            margin-bottom: 28px;
                            overflow: hidden;
                            display: flex;
                            flex-direction: row;
                            align-items: center;
                            border: 1px solid #f0f0f0;
                            min-height: 180px;
                            min-width: 100%;
                            padding: 18px 0;
                        }
                        .book-cover-user-vertical {
                            width: 150px;
                            height: 200px;
                            background: #f5f5f5;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 4rem;
                            color: #bbb;
                            flex-shrink: 0;
                            margin-left: 18px;
                            margin-right: 24px;
                        }
                        .book-info-user-vertical {
                            flex: 1;
                            padding: 0 16px 0 0;
                        }
                        .book-title-user-vertical {
                            font-size: 1.5rem;
                            font-weight: bold;
                            margin-bottom: 10px;
                            text-align: left;
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                        }
                        .book-meta-user-vertical {
                            font-size: 1.1rem;
                            color: #888;
                            margin-bottom: 6px;
                        }
                    </style>
                    @foreach($books as $book)
                        <div class="book-card-user-vertical">
                            <div class="book-cover-user-vertical">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="book-info-user-vertical">
                                <div class="book-title-user-vertical" title="{{ $book->judul }}">
                                    {{ $book->judul }}
                                </div>
                                <div class="book-meta-user-vertical">
                                    <i class="fas fa-user me-1"></i>{{ $book->penulis }}
                                </div>
                                <div class="book-meta-user-vertical">
                                    <i class="fas fa-tag me-1"></i>{{ $book->kategori }}
                                </div>
                                <div class="book-meta-user-vertical">
                                    <i class="fas fa-calendar me-1"></i>{{ $book->tahun_terbit }}
                                </div>
                                <div class="mb-2">
                                    @if($book->stok > 5)
                                        <span class="badge bg-success">{{ $book->stok }} tersedia</span>
                                    @elseif($book->stok > 0)
                                        <span class="badge bg-warning text-dark">{{ $book->stok }} tersisa</span>
                                    @else
                                        <span class="badge bg-danger">Habis</span>
                                    @endif
                                </div>
                                <div class="d-flex gap-2 mt-2">
                                    <a href="{{ route('books.show', $book->id_buku) }}" class="btn btn-sm btn-primary" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <hr class="my-4">
                    <h4>Selamat datang, {{ Auth::user()->nama }} (User)!</h4>
                    <p>Ini adalah halaman khusus user. Anda dapat melihat dan melakukan peminjaman buku.</p>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-success mb-4">Lihat Peminjaman</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 