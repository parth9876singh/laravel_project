@extends('layouts.app')

@section('title', 'Login')

@section('content')
<section class="auth-section">
    <div class="container">
        <div class="auth-card">
            <div class="auth-header">
                <a href="/" class="auth-logo">AntiGravity ⚡</a>
                <h1>Welcome back</h1>
                <p>Sign in to continue building connections.</p>
            </div>

            {{-- Demo Credentials Box --}}
            <div class="alert alert-info" id="demo-hint">
                <strong>🎯 Try the demo</strong><br>
                <span class="demo-row">🚀 Startup: <code>startup@demo.com</code></span>
                <span class="demo-row">🏢 Corporate: <code>corporate@demo.com</code></span>
                <span class="demo-row">🔑 Password: <code>password</code></span>
            </div>

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert alert-error" id="login-errors">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="/login" method="POST" id="login-form">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        placeholder="startup@demo.com" autocomplete="email">
                    @error('email')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password"
                        placeholder="••••••••" autocomplete="current-password">
                    @error('password')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-primary btn-full" id="btn-login">
                    Sign In →
                </button>
            </form>

            <div class="auth-footer">
                Don't have an account? <a href="/register" id="link-register">Create one free</a>
            </div>
        </div>
    </div>
</section>
@endsection
