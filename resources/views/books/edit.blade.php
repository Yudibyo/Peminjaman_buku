@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Edit Buku') }}</span>
                    <a href="{{ route('books.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('books.update', $book->id_buku) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="judul" class="col-md-4 col-form-label text-md-end">{{ __('Judul Buku') }}</label>

                            <div class="col-md-6">
                                <input id="judul" type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul', $book->judul) }}" required autofocus>

                                @error('judul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="penulis" class="col-md-4 col-form-label text-md-end">{{ __('Penulis') }}</label>

                            <div class="col-md-6">
                                <input id="penulis" type="text" class="form-control @error('penulis') is-invalid @enderror" name="penulis" value="{{ old('penulis', $book->penulis) }}" required>

                                @error('penulis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="penerbit" class="col-md-4 col-form-label text-md-end">Penerbit</label>
                            <div class="col-md-6">
                                <input id="penerbit" type="text" class="form-control @error('penerbit') is-invalid @enderror" name="penerbit" value="{{ old('penerbit', $book->penerbit) }}" required>
                                @error('penerbit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tahun_terbit" class="col-md-4 col-form-label text-md-end">{{ __('Tahun Terbit') }}</label>

                            <div class="col-md-6">
                                <input id="tahun_terbit" type="number" min="1900" max="{{ date('Y') }}" class="form-control @error('tahun_terbit') is-invalid @enderror" name="tahun_terbit" value="{{ old('tahun_terbit', $book->tahun_terbit) }}" required>

                                @error('tahun_terbit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kategori" class="col-md-4 col-form-label text-md-end">{{ __('Kategori') }}</label>

                            <div class="col-md-6">
                                <select id="kategori" class="form-select @error('kategori') is-invalid @enderror" name="kategori" required>
                                    <option value="" disabled>Pilih kategori</option>
                                    <option value="Fiksi" {{ (old('kategori', $book->kategori) == 'Fiksi') ? 'selected' : '' }}>Fiksi</option>
                                    <option value="Non-Fiksi" {{ (old('kategori', $book->kategori) == 'Non-Fiksi') ? 'selected' : '' }}>Non-Fiksi</option>
                                    <option value="Pendidikan" {{ (old('kategori', $book->kategori) == 'Pendidikan') ? 'selected' : '' }}>Pendidikan</option>
                                    <option value="Bisnis" {{ (old('kategori', $book->kategori) == 'Bisnis') ? 'selected' : '' }}>Bisnis</option>
                                    <option value="Teknologi" {{ (old('kategori', $book->kategori) == 'Teknologi') ? 'selected' : '' }}>Teknologi</option>
                                    <option value="Seni" {{ (old('kategori', $book->kategori) == 'Seni') ? 'selected' : '' }}>Seni</option>
                                    <option value="Lainnya" {{ (old('kategori', $book->kategori) == 'Lainnya') ? 'selected' : '' }}>Lainnya</option>
                                </select>

                                @error('kategori')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="stok" class="col-md-4 col-form-label text-md-end">{{ __('Stok') }}</label>

                            <div class="col-md-6">
                                <input id="stok" type="number" min="0" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ old('stok', $book->stok) }}" required>

                                @error('stok')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cover" class="col-md-4 col-form-label text-md-end">Cover Buku</label>
                            <div class="col-md-6">
                                @if($book->cover)
                                    <img src="{{ asset('uploads/covers/'.$book->cover) }}" alt="Cover Buku" style="max-width:120px;margin-bottom:10px;">
                                @endif
                                <input id="cover" type="file" class="form-control @error('cover') is-invalid @enderror" name="cover" accept="image/*">
                                @error('cover')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="deskripsi" class="col-md-4 col-form-label text-md-end">Deskripsi Buku</label>
                            <div class="col-md-6">
                                <textarea id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="4">{{ old('deskripsi', $book->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> {{ __('Perbarui Buku') }}
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