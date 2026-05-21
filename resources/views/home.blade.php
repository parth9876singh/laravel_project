@extends('layouts.app')

@section('title', 'Home')

@section('content')

<!-- ───── HERO ───── -->
<section class="hero">
    <div class="container hero-inner">
        <div class="hero-badge">🚀 India's #1 Startup-Corporate Network</div>
        <h1>Where <span>Startups</span><br>Meet Corporates</h1>
        <p class="hero-sub">AntiGravity connects innovative startups with the corporates ready to invest, partner, and grow. No gatekeepers. No cold emails. Just real connections.</p>
        <div class="btn-group">
            <a href="/register?role=startup" class="btn btn-primary" id="hero-join-startup">Join as Startup →</a>
            <a href="/register?role=corporate" class="btn btn-outline" id="hero-join-corporate">Join as Corporate</a>
        </div>
        <div class="hero-stats">
            <div class="hero-stat">
                <strong>200+</strong>
                <span>Startups</span>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <strong>50+</strong>
                <span>Corporates</span>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <strong>120+</strong>
                <span>Connections</span>
            </div>
        </div>
    </div>
</section>

<!-- ───── FEATURES ───── -->
<section class="section section-features">
    <div class="container">
        <div class="section-header">
            <h2>Everything you need to connect</h2>
            <p>A streamlined platform built for India's startup ecosystem.</p>
        </div>
        <div class="grid-3">
            <div class="card feature-card" id="feature-profile">
                <div class="card-icon">📋</div>
                <h3>Post Your Profile</h3>
                <p>Create a compelling profile that showcases your vision, traction, and team. Make investors come to you.</p>
            </div>
            <div class="card feature-card" id="feature-browse">
                <div class="card-icon">🔍</div>
                <h3>Browse Opportunities</h3>
                <p>Corporates can discover startups filtered by industry, stage, and location. Find your next investment in minutes.</p>
            </div>
            <div class="card feature-card" id="feature-connect">
                <div class="card-icon">🤝</div>
                <h3>Connect &amp; Grow</h3>
                <p>Send interest directly to startups you believe in. No cold emails — a warm, curated introduction every time.</p>
            </div>
        </div>
    </div>
</section>

<!-- ───── HOW IT WORKS ───── -->
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <h2>How AntiGravity works</h2>
            <p>Three simple steps to your next big partnership.</p>
        </div>
        <div class="steps-row">
            <div class="step-item">
                <div class="step-number">01</div>
                <h3>Create your account</h3>
                <p>Register as a Startup or Corporate in under 2 minutes. No credit card required.</p>
            </div>
            <div class="step-arrow">→</div>
            <div class="step-item">
                <div class="step-number">02</div>
                <h3>Build your profile</h3>
                <p>Fill in your company details, industry, stage, and what you're looking for.</p>
            </div>
            <div class="step-arrow">→</div>
            <div class="step-item">
                <div class="step-number">03</div>
                <h3>Start connecting</h3>
                <p>Corporates send interest. Startups accept or decline. It's that simple.</p>
            </div>
        </div>
    </div>
</section>

<!-- ───── STATS ───── -->
<section class="section section-stats">
    <div class="container">
        <div class="stats-grid">
            <div class="big-stat" id="stat-startups">
                <div class="big-stat-number">200+</div>
                <div class="big-stat-label">Startups on platform</div>
            </div>
            <div class="big-stat" id="stat-corporates">
                <div class="big-stat-number">50+</div>
                <div class="big-stat-label">Corporates investing</div>
            </div>
            <div class="big-stat" id="stat-connections">
                <div class="big-stat-number">120+</div>
                <div class="big-stat-label">Connections made</div>
            </div>
            <div class="big-stat" id="stat-funded">
                <div class="big-stat-number">₹45Cr+</div>
                <div class="big-stat-label">Funding facilitated</div>
            </div>
        </div>
    </div>
</section>

<!-- ───── CTA ───── -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-card">
            <h2>Ready to launch your next chapter?</h2>
            <p>Join thousands of startups and corporates already on AntiGravity.</p>
            <div class="btn-group">
                <a href="/register?role=startup" class="btn btn-primary" id="cta-startup">Get Started as Startup</a>
                <a href="/register?role=corporate" class="btn btn-outline-white" id="cta-corporate">Join as Corporate</a>
            </div>
        </div>
    </div>
</section>

@endsection
