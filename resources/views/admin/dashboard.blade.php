@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>
                <div class="card-body">
                    <h4>Selamat datang, {{ Auth::user()->nama }} (Admin)!</h4>
                    <p>Ini adalah halaman khusus admin. Anda dapat mengelola data buku dan melihat statistik.</p>
                    <a href="{{ route('books.index') }}" class="btn btn-primary">Kelola Buku</a>
                    {{-- Tambahkan ringkasan statistik jika diinginkan --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 