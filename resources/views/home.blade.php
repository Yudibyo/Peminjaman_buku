@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4>Selamat datang, {{ Auth::user()->nama }}!</h4>
                    @if(Auth::user()->role === 'admin')
                        <p>Anda login sebagai <strong>Admin</strong>.</p>
                        <a href="{{ route('books.index') }}" class="btn btn-primary">Kelola Buku</a>
                    @elseif(Auth::user()->role === 'user')
                        <p>Anda login sebagai <strong>User</strong>.</p>
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-success">Pinjam Buku</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
