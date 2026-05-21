<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AntiGravity — The platform connecting innovative startups with corporates ready to invest, partner, and grow.">
    <title>@yield('title', 'AntiGravity') — Connecting Startups & Corporates</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <!-- ───── NAVBAR ───── -->
    <nav class="navbar" id="main-navbar">
        <div class="container navbar-inner">
            <a href="/" class="navbar-brand">AntiGravity ⚡</a>

            <button class="navbar-toggle" id="navbar-toggle" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>

            <div class="navbar-links" id="navbar-links">
                @guest
                    <a href="/login" class="btn btn-outline btn-sm" id="nav-login">Login</a>
                    <a href="/register" class="btn btn-primary btn-sm" id="nav-register">Register</a>
                @else
                    <span class="nav-greeting">Hi, {{ auth()->user()->name }}</span>
                    <span class="badge badge-role {{ auth()->user()->role === 'startup' ? 'badge-startup' : 'badge-corporate' }}">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                    <a href="/profile/edit" class="nav-link" id="nav-profile">My Profile</a>
                    <a href="/dashboard" class="nav-link" id="nav-dashboard">Dashboard</a>
                    @if(auth()->user()->role === 'corporate')
                        <a href="/startups" class="nav-link" id="nav-startups">Discover</a>
                    @endif
                    <form action="/logout" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="btn btn-outline btn-sm" id="nav-logout">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <!-- ───── FLASH MESSAGES ───── -->
    @if(session('success'))
        <div class="toast toast-success" id="flash-success">
            <span class="toast-icon">✓</span>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="toast toast-error" id="flash-error">
            <span class="toast-icon">✕</span>
            {{ session('error') }}
        </div>
    @endif

    <!-- ───── PAGE CONTENT ───── -->
    <main>
        @yield('content')
    </main>

    <!-- ───── FOOTER ───── -->
    <footer class="footer">
        <div class="container">
            <p class="footer-brand">AntiGravity ⚡</p>
            <p class="footer-tagline">Connecting the builders of tomorrow with those who fund them.</p>
            <p class="footer-copy">© 2024 AntiGravity. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Mobile navbar toggle
        document.getElementById('navbar-toggle').addEventListener('click', function() {
            document.getElementById('navbar-links').classList.toggle('open');
        });

        // Auto-dismiss flash toasts after 4 seconds
        setTimeout(function() {
            var toasts = document.querySelectorAll('.toast');
            toasts.forEach(function(t) {
                t.style.opacity = '0';
                t.style.transform = 'translateY(-16px)';
                setTimeout(function() { t.remove(); }, 400);
            });
        }, 4000);

        // Interest form toggles
        document.querySelectorAll('.btn-interest-toggle').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var card = this.closest('.startup-card');
                var form = card.querySelector('.interest-form');
                var isOpen = card.classList.contains('open');
                // Close all others
                document.querySelectorAll('.startup-card.open').forEach(function(c) {
                    c.classList.remove('open');
                    c.querySelector('.interest-form').style.display = 'none';
                });
                if (!isOpen) {
                    card.classList.add('open');
                    form.style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>
