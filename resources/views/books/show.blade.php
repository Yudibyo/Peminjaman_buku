@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Detail Buku') }}</span>
                    <a href="{{ route('books.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12 text-center">
                            @if($book->cover)
                                <img src="{{ asset('uploads/covers/'.$book->cover) }}" alt="Cover Buku" style="width:160px;height:220px;object-fit:cover;border-radius:8px;margin-bottom:16px;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" style="width:160px;height:220px;margin:0 auto 16px auto;">
                                    <span class="text-muted">No Cover</span>
                                </div>
                            @endif
                            <h2>{{ $book->judul }}</h2>
                            <p class="text-muted mb-0">{{ $book->penulis }}</p>
                        </div>
                    </div>

                    <table class="table">
                        <tr>
                            <th style="width: 30%">ID Buku</th>
                            <td>{{ $book->id_buku }}</td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td>{{ $book->judul }}</td>
                        </tr>
                        <tr>
                            <th>Penulis</th>
                            <td>{{ $book->penulis }}</td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <td>{{ $book->penerbit }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Terbit</th>
                            <td>{{ $book->tahun_terbit }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td><span class="badge bg-info">{{ $book->kategori }}</span></td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>
                                @if($book->stok > 0)
                                    <span class="badge bg-success">{{ $book->stok }} tersedia</span>
                                @else
                                    <span class="badge bg-danger">Tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    </table>

                    @if($book->deskripsi)
                        <div class="mt-4">
                            <h5>Deskripsi Buku</h5>
                            <div class="border rounded p-3 bg-light">{{ $book->deskripsi }}</div>
                        </div>
                    @endif

                    @if(Auth::user()->role === 'admin')
                        <div class="d-flex justify-content-center mt-4">
                            <a href="{{ route('books.edit', $book->id_buku) }}" class="btn btn-warning me-2">
                                <i class="fas fa-edit"></i> Edit Buku
                            </a>
                            <form action="{{ route('books.destroy', $book->id_buku) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Hapus Buku
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 