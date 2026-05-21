@extends('layouts.app')

@section('title', 'Discover Startups')

@section('content')
<section class="section">
    <div class="container">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h1>Discover Startups</h1>
                <p style="color:var(--text-secondary);margin-top:4px;">
                    {{ $startups->count() }} {{ $startups->count() === 1 ? 'startup' : 'startups' }} found
                </p>
            </div>
        </div>

        {{-- Filter Bar --}}
        <form action="/startups" method="GET" class="filter-bar" id="filter-form">
            <div class="filter-group">
                <select name="industry" id="filter-industry" class="filter-select">
                    <option value="">All Industries</option>
                    @foreach($industries as $ind)
                        <option value="{{ $ind }}" {{ request('industry') === $ind ? 'selected' : '' }}>
                            {{ $ind }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group filter-search">
                <input type="text" name="search" id="filter-search" class="filter-input"
                    value="{{ request('search') }}"
                    placeholder="Search by name, description…">
            </div>
            <button type="submit" class="btn btn-primary btn-sm" id="btn-search">Search</button>
            @if(request('industry') || request('search'))
                <a href="/startups" class="btn btn-outline btn-sm" id="btn-clear">Clear</a>
            @endif
        </form>

        {{-- Grid --}}
        @if($startups->isEmpty())
            <div class="empty-state" id="no-startups">
                <div class="empty-icon">🔍</div>
                <h3>No startups found</h3>
                <p>Try adjusting your filters or search term.</p>
                <a href="/startups" class="btn btn-outline" style="margin-top:16px">Browse all startups</a>
            </div>
        @else
            <div class="startup-grid">
                @foreach($startups as $startup)
                    @php $prof = $startup->profileData; @endphp
                    <div class="startup-card card" id="startup-{{ $startup->_id }}">
                        <div class="startup-card-header">
                            <div>
                                <h3 class="startup-name">{{ $prof?->company_name ?? $startup->name }}</h3>
                                @if($prof?->tagline)
                                    <p class="startup-tagline">{{ $prof->tagline }}</p>
                                @endif
                            </div>
                            <div class="startup-badges">
                                @if($prof?->industry)
                                    <span class="badge badge-industry">{{ $prof->industry }}</span>
                                @endif
                                @if($prof?->stage)
                                    <span class="badge badge-stage">{{ $prof->stage }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="startup-card-body">
                            @if($prof?->description)
                                <p class="startup-desc">
                                    {{ Str::limit($prof->description, 130) }}
                                </p>
                            @endif

                            <div class="startup-meta">
                                @if($prof?->location)
                                    <span class="meta-item">📍 {{ $prof->location }}</span>
                                @endif
                                @if($prof?->team_size)
                                    <span class="meta-item">👥 {{ $prof->team_size }} people</span>
                                @endif
                                @if($prof?->funding_needed)
                                    <span class="meta-item">💰 {{ $prof->funding_needed }}</span>
                                @endif
                            </div>

                            @if(!empty($prof?->tags))
                                <div class="tag-list">
                                    @foreach($prof->tags as $tag)
                                        <span class="tag">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="startup-card-footer">
                            @if($prof?->website)
                                <a href="{{ $prof->website }}" target="_blank" rel="noopener" class="btn btn-outline btn-sm" id="site-{{ $startup->_id }}">
                                    Visit Site ↗
                                </a>
                            @endif
                            <button type="button" class="btn btn-primary btn-sm btn-interest-toggle" id="interest-toggle-{{ $startup->_id }}">
                                Send Interest ✉
                            </button>
                        </div>

                        {{-- Interest Form (hidden by default) --}}
                        <div class="interest-form" style="display:none;" id="interest-form-{{ $startup->_id }}">
                            <form action="/interests/{{ $startup->_id }}" method="POST">
                                @csrf
                                <div class="form-group" style="margin-bottom:12px;">
                                    <label for="message-{{ $startup->_id }}">Your Message</label>
                                    <textarea name="message" id="message-{{ $startup->_id }}"
                                        placeholder="Introduce yourself and explain why you're interested in this startup…"
                                        style="min-height:80px;"></textarea>
                                </div>
                                <div style="display:flex;gap:8px;">
                                    <button type="submit" class="btn btn-primary btn-sm" id="submit-interest-{{ $startup->_id }}">
                                        Send Interest ✓
                                    </button>
                                    <button type="button" class="btn btn-outline btn-sm btn-interest-close" id="close-interest-{{ $startup->_id }}">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<script>
    // Close button
    document.querySelectorAll('.btn-interest-close').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var card = this.closest('.startup-card');
            card.classList.remove('open');
            card.querySelector('.interest-form').style.display = 'none';
        });
    });
</script>
@endsection
