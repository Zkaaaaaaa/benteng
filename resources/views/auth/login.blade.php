@extends('layouts.auth-login')

@section('content')
    <div class="admin-login-card">
        <div class="admin-login-brand">
            <img src="{{ stored_asset($logo ?? 'assets/images/logo.png') }}" alt="Benteng" class="admin-login-logo">
            <p class="admin-login-heading">Admin Panel</p>
        </div>

        @if (session('status'))
            <div class="admin-login-alert" role="alert">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="admin-login-alert" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <div class="admin-login-field">
                <label class="admin-login-label" for="email">Email</label>
                <input
                    id="email"
                    class="admin-login-input"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="admin@example.com">
                @error('email')
                    <p class="admin-login-field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="admin-login-field">
                <label class="admin-login-label" for="password">Password</label>
                <input
                    id="password"
                    class="admin-login-input"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••">
                @error('password')
                    <p class="admin-login-field-error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="admin-login-submit">Login</button>
        </form>
    </div>
@endsection
