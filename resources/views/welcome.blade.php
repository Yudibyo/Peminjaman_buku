@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="text-center my-5 py-5">
                <img src="{{ asset('logo/Laboon.png') }}" alt="Logo Perpustakaan" style="height:250px; width:auto; margin:0 auto 2rem auto; display:block;">
                <h1 class="display-2 fw-bold mt-4 text-primary">LABOON</h1>
                <p class="lead fs-4 text-muted">Perpustakaan Digital Modern</p>
                <div class="mt-4 col-md-8 mx-auto">
                    <p class="fs-5">Sistem manajemen perpustakaan digital yang memudahkan pengelolaan dan peminjaman buku</p>
                </div>
            </div>
            
            <div class="row mb-5 g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-5">
                            <div class="feature-icon bg-primary text-white rounded-circle p-3 mb-4 mx-auto" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-search fa-2x"></i>
                            </div>
                            <h3 class="fw-bold">Cari Buku</h3>
                            <p class="card-text">Temukan buku yang Anda butuhkan dengan mudah di koleksi perpustakaan kami.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-5">
                            <div class="feature-icon bg-secondary text-white rounded-circle p-3 mb-4 mx-auto" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-book fa-2x"></i>
                            </div>
                            <h3 class="fw-bold">Pinjam Buku</h3>
                            <p class="card-text">Sistem peminjaman yang cepat dan mudah untuk mengakses koleksi buku kami.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-5">
                            <div class="feature-icon text-white rounded-circle p-3 mb-4 mx-auto" style="background-color: var(--accent); width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-chart-line fa-2x"></i>
                            </div>
                            <h3 class="fw-bold">Pantau Status</h3>
                            <p class="card-text">Lacak status peminjaman buku Anda dengan dashboard yang informatif.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="my-5 py-3 text-center">
                @guest
                    <div class="col-md-6 mx-auto">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-5 bg-primary text-white">
                                <h3 class="mb-4">Mulai Sekarang</h3>
                                <p class="mb-4">Masuk atau daftar untuk mulai menggunakan layanan perpustakaan digital LABOON</p>
                                <div class="d-grid gap-3">
                                    <a href="{{ route('login') }}" class="btn btn-light btn-lg fw-bold">
                                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                                    </a>
                                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                                        <i class="fas fa-user-plus me-2"></i>Daftar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-6 mx-auto">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-5 bg-primary text-white">
                                <h3 class="mb-4">Selamat Datang, {{ Auth::user()->nama }}</h3>
                                <p class="mb-4">Akses dashboard untuk mengelola peminjaman buku Anda</p>
                                <div class="d-grid">
                                    @if(Auth::user()->role === 'admin')
                                        <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-lg fw-bold">
                                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin
                                        </a>
                                    @else
                                        <a href="{{ route('home') }}" class="btn btn-light btn-lg fw-bold">
                                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
            
            <div class="my-5 py-3 text-center">
                <div class="wave-animation">
                    <i class="fas fa-water text-primary opacity-25 fa-2x mx-2" style="transform: translateY(0px);"></i>
                    <i class="fas fa-water text-primary opacity-50 fa-3x mx-2" style="transform: translateY(5px);"></i>
                    <i class="fas fa-water text-primary opacity-75 fa-4x mx-2" style="transform: translateY(10px);"></i>
                    <i class="fas fa-water text-primary fa-5x mx-2" style="transform: translateY(15px);"></i>
                    <i class="fas fa-water text-primary opacity-75 fa-4x mx-2" style="transform: translateY(10px);"></i>
                    <i class="fas fa-water text-primary opacity-50 fa-3x mx-2" style="transform: translateY(5px);"></i>
                    <i class="fas fa-water text-primary opacity-25 fa-2x mx-2" style="transform: translateY(0px);"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .wave-animation i {
        animation: wave 3s infinite ease-in-out;
    }
    
    .wave-animation i:nth-child(2) {
        animation-delay: 0.2s;
    }
    
    .wave-animation i:nth-child(3) {
        animation-delay: 0.4s;
    }
    
    .wave-animation i:nth-child(4) {
        animation-delay: 0.6s;
    }
    
    .wave-animation i:nth-child(5) {
        animation-delay: 0.8s;
    }
    
    .wave-animation i:nth-child(6) {
        animation-delay: 1s;
    }
    
    .wave-animation i:nth-child(7) {
        animation-delay: 1.2s;
    }
    
    @keyframes wave {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-15px);
        }
    }
</style>
@endsection
