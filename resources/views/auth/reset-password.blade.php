@extends('layouts.general')

@section('title', 'Restablecer Contraseña')

@section('extra-css')
    <!-- Aquí puedes agregar CSS adicional específico de esta página si es necesario -->
@endsection

@section('extra-js')
@endsection

@section('content')
    <div class="content">
        <div class="card-body">
            <form method="POST" action="{{ route('password.store') }}" novalidate>
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-group my-3 mt-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" class="form-control rounded-pill @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email', $request->email) }}" required readonly>
                    @error('email')
                        <span class="invalid-feedback email-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group my-3 mt-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" class="form-control rounded-pill @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback password-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group my-3 mt-3">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" class="form-control rounded-pill @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" required autocomplete="new-password">
                    @error('password_confirmation')
                        <span class="invalid-feedback passwordRepetida-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="form-group my-3 mt-3">
                    <button type="submit" class="btn button">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
