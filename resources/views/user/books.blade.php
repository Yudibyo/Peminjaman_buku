@extends('layouts.app')

@section('content')
<style>
    .book-card-user-list {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        color: #333;
        margin-bottom: 0;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        border: 1px solid #f0f0f0;
        min-width: 0;
        max-width: 100%;
        width: 100%;
        padding: 24px 12px 18px 12px;
        transition: box-shadow 0.2s;
        cursor: pointer;
        height: 100%;
    }
    .book-card-user-list:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    }
    .book-cover-user-list {
        width: 160px;
        height: 220px;
        background: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 5rem;
        color: #bbb;
        margin-bottom: 18px;
        border-radius: 8px;
        overflow: hidden;
    }
    .book-cover-user-list img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
        display: block;
    }
    .book-title-user-list {
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 100%;
    }
    .book-meta-user-list {
        font-size: 1rem;
        color: #888;
        text-align: center;
        margin-bottom: 0.5rem;
    }
    @media (max-width: 767px) {
        .book-cover-user-list { width: 120px; height: 160px; }
    }
</style>
<div class="container py-4 min-vh-100">
    <h4 class="mb-4">Daftar Buku</h4>
    <form method="GET" action="{{ route('user.books.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari judul, penulis, kategori, atau penerbit..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    <div class="row g-4 justify-content-center">
        @foreach($books as $book)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">
                <div class="book-card-user-list w-100" data-book='@json($book)'>
                    <div class="book-cover-user-list">
                        @if($book->cover)
                            <img src="{{ asset('uploads/covers/'.$book->cover) }}" alt="Cover Buku">
                        @else
                            <i class="fas fa-book"></i>
                        @endif
                    </div>
                    <div class="book-title-user-list" title="{{ $book->judul }}">
                        {{ $book->judul }}
                    </div>
                    <div class="mt-3 text-center">
                        <a href="{{ route('peminjaman.create', ['id_buku' => $book->id_buku]) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus-circle me-1"></i> Pinjam Buku
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal Info Buku -->
    <div class="modal fade" id="bookInfoModal" tabindex="-1" aria-labelledby="bookInfoModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="bookInfoModalLabel">Informasi Buku</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="text-center mb-3">
                <img id="modal-book-cover" src="" alt="Cover Buku" style="width:160px;height:220px;object-fit:cover;border-radius:8px;">
            </div>
            <h4 id="modal-book-title" class="fw-bold mb-3 text-center"></h4>
            <table class="table table-borderless mb-3">
                <tr>
                    <th style="width: 40%">Penulis</th>
                    <td id="modal-book-penulis"></td>
                </tr>
                <tr>
                    <th>Penerbit</th>
                    <td id="modal-book-penerbit"></td>
                </tr>
                <tr>
                    <th>Tahun Terbit</th>
                    <td id="modal-book-tahun"></td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td><span class="badge bg-info text-dark" id="modal-book-kategori"></span></td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td id="modal-book-stok"></td>
                </tr>
            </table>
            <div id="modal-book-deskripsi-box" class="mt-3" style="display:none;">
                <h6>Deskripsi Buku</h6>
                <div class="border rounded p-3 bg-light" id="modal-book-deskripsi"></div>
            </div>
            <div class="mt-4 text-center">
                <a id="modal-pinjam-link" href="#" class="btn btn-success">
                    <i class="fas fa-plus-circle me-1"></i> Pinjam Buku
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@push('scripts')
<script>
document.querySelectorAll('.book-card-user-list').forEach(function(card) {
    card.addEventListener('click', function(e) {
        if(e.target.closest('a.btn')) return;
        const book = JSON.parse(this.dataset.book);
        document.getElementById('modal-book-title').textContent = book.judul;
        document.getElementById('modal-book-penulis').textContent = book.penulis;
        document.getElementById('modal-book-penerbit').textContent = book.penerbit || '-';
        document.getElementById('modal-book-tahun').textContent = book.tahun_terbit;
        document.getElementById('modal-book-kategori').textContent = book.kategori;
        document.getElementById('modal-book-stok').textContent = book.stok;
        if(book.deskripsi && book.deskripsi.trim() !== '') {
            document.getElementById('modal-book-deskripsi').textContent = book.deskripsi;
            document.getElementById('modal-book-deskripsi-box').style.display = 'block';
        } else {
            document.getElementById('modal-book-deskripsi').textContent = '';
            document.getElementById('modal-book-deskripsi-box').style.display = 'none';
        }
        if(book.cover) {
            document.getElementById('modal-book-cover').src = '/uploads/covers/' + book.cover;
            document.getElementById('modal-book-cover').style.display = 'block';
        } else {
            document.getElementById('modal-book-cover').src = '';
            document.getElementById('modal-book-cover').style.display = 'none';
        }
        document.getElementById('modal-pinjam-link').href = '/peminjaman/create?id_buku=' + book.id_buku;
        var modal = new bootstrap.Modal(document.getElementById('bookInfoModal'));
        modal.show();
    });
});
</script>
@endpush
@endsection 