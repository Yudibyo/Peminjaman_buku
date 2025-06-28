@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-6 position-relative">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePassword('password', this)">
                                    <i class="fas fa-eye" id="icon-password"></i>
                                </span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="captcha" class="col-md-4 col-form-label text-md-end">{{ __('Captcha') }}</label>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <div class="captcha-image">
                                        {!! captcha_img('flat') !!}
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" id="reload-captcha">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                                <input id="captcha" type="text" class="form-control @error('captcha') is-invalid @enderror" name="captcha" placeholder="Masukkan kode captcha" required>
                                @error('captcha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.captcha-image {
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    padding: 2px;
    background: white;
}

.captcha-image img {
    border-radius: 0.25rem;
}

#reload-captcha {
    height: 38px;
    width: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.375rem;
}

#reload-captcha:hover {
    background-color: #6c757d;
    color: white;
}
</style>
@endsection

@push('scripts')
<script>
function attachReloadCaptcha() {
    document.getElementById('reload-captcha').onclick = function() {
        fetch('/reload-captcha')
            .then(res => res.json())
            .then(data => {
                document.querySelector('.captcha-image').innerHTML = data.captcha;
            });
    }
}
attachReloadCaptcha();

function togglePassword(id, el) {
    const input = document.getElementById(id);
    const icon = el.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endpush 