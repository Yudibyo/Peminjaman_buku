@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Tambah Buku Baru') }}</span>
                    <a href="{{ route('books.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="judul" class="col-md-4 col-form-label text-md-end">{{ __('Judul Buku') }}</label>

                            <div class="col-md-6">
                                <input id="judul" type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" required autofocus>

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
                                <input id="penulis" type="text" class="form-control @error('penulis') is-invalid @enderror" name="penulis" value="{{ old('penulis') }}" required>

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
                                <input id="penerbit" type="text" class="form-control @error('penerbit') is-invalid @enderror" name="penerbit" value="{{ old('penerbit') }}" required>
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
                                <input id="tahun_terbit" type="number" min="1900" max="{{ date('Y') }}" class="form-control @error('tahun_terbit') is-invalid @enderror" name="tahun_terbit" value="{{ old('tahun_terbit') }}" required>

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
                                    <option value="" disabled selected>Pilih kategori</option>
                                    <option value="Fiksi" {{ old('kategori') == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                                    <option value="Non-Fiksi" {{ old('kategori') == 'Non-Fiksi' ? 'selected' : '' }}>Non-Fiksi</option>
                                    <option value="Pendidikan" {{ old('kategori') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                    <option value="Bisnis" {{ old('kategori') == 'Bisnis' ? 'selected' : '' }}>Bisnis</option>
                                    <option value="Teknologi" {{ old('kategori') == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                                    <option value="Seni" {{ old('kategori') == 'Seni' ? 'selected' : '' }}>Seni</option>
                                    <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                                <input id="stok" type="number" min="0" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ old('stok', 1) }}" required>

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
                                <input id="cover" type="file" class="form-control @error('cover') is-invalid @enderror" name="cover" accept="image/*">
                                @error('cover')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <img id="cover-preview" src="#" alt="Preview Cover" style="display:none;max-width:120px;margin-top:10px;" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="deskripsi" class="col-md-4 col-form-label text-md-end">Deskripsi Buku</label>
                            <div class="col-md-6">
                                <textarea id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
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
                                    <i class="fas fa-save me-1"></i> {{ __('Simpan Buku') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('cover').onchange = function(evt) {
    const [file] = this.files;
    if (file) {
        const preview = document.getElementById('cover-preview');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
}
</script>
@endsection 