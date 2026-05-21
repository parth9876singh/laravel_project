@extends('layouts.app')

@section('title', 'Register')

@section('content')
<section class="auth-section">
    <div class="container">
        <div class="auth-card">
            <div class="auth-header">
                <a href="/" class="auth-logo">AntiGravity ⚡</a>
                <h1>Create your account</h1>
                <p>Join India's fastest-growing startup-corporate network.</p>
            </div>

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert alert-error" id="validation-errors">
                    <ul style="margin:0;padding-left:20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/register" method="POST" id="register-form">
                @csrf

                <div class="role-selector" id="role-selector">
                    <label class="role-option {{ old('role', request('role')) === 'startup' ? 'active' : '' }}" id="role-startup-label">
                        <input type="radio" name="role" value="startup"
                            {{ old('role', request('role')) === 'startup' ? 'checked' : '' }}
                            id="role-startup">
                        <span class="role-icon">🚀</span>
                        <strong>Startup</strong>
                        <span class="role-desc">I'm building something</span>
                    </label>
                    <label class="role-option {{ old('role', request('role')) === 'corporate' ? 'active' : '' }}" id="role-corporate-label">
                        <input type="radio" name="role" value="corporate"
                            {{ old('role', request('role')) === 'corporate' ? 'checked' : '' }}
                            id="role-corporate">
                        <span class="role-icon">🏢</span>
                        <strong>Corporate</strong>
                        <span class="role-desc">I'm investing & partnering</span>
                    </label>
                </div>
                @error('role')
                    <div class="field-error">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        placeholder="Arjun Sharma" autocomplete="name">
                    @error('name')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        placeholder="you@startup.com" autocomplete="email">
                    @error('email')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password"
                            placeholder="Min. 6 characters" autocomplete="new-password">
                        @error('password')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Repeat password" autocomplete="new-password">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-full" id="btn-register">
                    Create Account →
                </button>
            </form>

            <div class="auth-footer">
                Already have an account? <a href="/login" id="link-login">Sign in</a>
            </div>
        </div>
    </div>
</section>

<script>
    // Role selector active state
    document.querySelectorAll('.role-option input').forEach(function(radio) {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.role-option').forEach(function(el) {
                el.classList.remove('active');
            });
            this.closest('.role-option').classList.add('active');
        });
    });
</script>
@endsection
