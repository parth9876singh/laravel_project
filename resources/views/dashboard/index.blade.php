@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="section">
    <div class="container">

        <div class="page-header">
            <div>
                <h1>
                    {{ auth()->user()->role === 'startup' ? '🚀 Startup Dashboard' : '🏢 Corporate Dashboard' }}
                </h1>
                <p style="color:var(--text-secondary);margin-top:4px;">
                    Welcome back, {{ auth()->user()->name }}
                </p>
            </div>
            <div style="display:flex;gap:10px;align-items:center;">
                <a href="/profile/edit" class="btn btn-outline btn-sm" id="btn-edit-profile">Edit Profile</a>
                @if(auth()->user()->role === 'corporate')
                    <a href="/startups" class="btn btn-primary btn-sm" id="btn-discover">Discover Startups →</a>
                @endif
            </div>
        </div>

        {{-- Stats Row --}}
        <div class="stats-row" id="dashboard-stats">
            <div class="stat-card" id="stat-total">
                <div class="stat-number">{{ $stats['total'] }}</div>
                <div class="stat-label">
                    {{ auth()->user()->role === 'startup' ? 'Interests Received' : 'Interests Sent' }}
                </div>
            </div>
            <div class="stat-card stat-card-pending" id="stat-pending">
                <div class="stat-number">{{ $stats['pending'] }}</div>
                <div class="stat-label">Pending</div>
            </div>
            <div class="stat-card stat-card-accepted" id="stat-accepted">
                <div class="stat-number">{{ $stats['accepted'] }}</div>
                <div class="stat-label">Accepted</div>
            </div>
            <div class="stat-card stat-card-rejected" id="stat-rejected">
                <div class="stat-number">{{ $stats['rejected'] }}</div>
                <div class="stat-label">Rejected</div>
            </div>
        </div>

        {{-- ─── STARTUP VIEW ─── --}}
        @if(auth()->user()->role === 'startup')
            <div class="section-subheader" id="interests-section">
                <h2>Interests Received</h2>
                <p>Corporates who want to connect with you.</p>
            </div>

            @if($interests->isEmpty())
                <div class="empty-state" id="no-interests-startup">
                    <div class="empty-icon">📬</div>
                    <h3>No interests yet</h3>
                    <p>Complete your profile to attract corporates. Make it compelling!</p>
                    <a href="/profile/edit" class="btn btn-primary" style="margin-top:16px">Complete Profile</a>
                </div>
            @else
                <div class="interests-list" id="interests-list-startup">
                    @foreach($interests as $interest)
                        <div class="interest-card" id="interest-{{ $interest->_id }}">
                            <div class="interest-card-body">
                                <div class="interest-card-top">
                                    <div class="interest-who">
                                        <div class="interest-avatar">{{ strtoupper(substr($interest->corporateProfile?->company_name ?? 'C', 0, 1)) }}</div>
                                        <div>
                                            <h3>{{ $interest->corporateProfile?->company_name ?? ($interest->corporateUser?->name ?? 'Unknown Corporate') }}</h3>
                                            @if($interest->corporateProfile?->tagline)
                                                <p class="interest-sub">{{ $interest->corporateProfile->tagline }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="badge badge-{{ $interest->status }}" id="status-{{ $interest->_id }}">
                                        {{ ucfirst($interest->status) }}
                                    </span>
                                </div>

                                <div class="interest-message">
                                    "{{ $interest->message }}"
                                </div>

                                <div class="interest-meta">
                                    @if($interest->corporateProfile?->location)
                                        <span>📍 {{ $interest->corporateProfile->location }}</span>
                                    @endif
                                    <span>📅 {{ $interest->created_at ? $interest->created_at->format('d M Y') : 'N/A' }}</span>
                                </div>
                            </div>

                            @if($interest->status === 'pending')
                                <div class="interest-card-actions">
                                    <form action="/interests/{{ $interest->_id }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="btn btn-success btn-sm" id="accept-{{ $interest->_id }}">
                                            ✓ Accept
                                        </button>
                                    </form>
                                    <form action="/interests/{{ $interest->_id }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-danger btn-sm" id="reject-{{ $interest->_id }}">
                                            ✕ Decline
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

        {{-- ─── CORPORATE VIEW ─── --}}
        @else
            <div class="section-subheader" id="sent-section">
                <h2>Interests Sent</h2>
                <p>Startups you have reached out to.</p>
            </div>

            @if($interests->isEmpty())
                <div class="empty-state" id="no-interests-corporate">
                    <div class="empty-icon">🚀</div>
                    <h3>You haven't reached out to anyone yet</h3>
                    <p>Discover startups and send your first interest today.</p>
                    <a href="/startups" class="btn btn-primary" style="margin-top:16px">Discover Startups →</a>
                </div>
            @else
                <div class="interests-list" id="interests-list-corporate">
                    @foreach($interests as $interest)
                        <div class="interest-card" id="interest-{{ $interest->_id }}">
                            <div class="interest-card-body">
                                <div class="interest-card-top">
                                    <div class="interest-who">
                                        <div class="interest-avatar">{{ strtoupper(substr($interest->startupProfile?->company_name ?? 'S', 0, 1)) }}</div>
                                        <div>
                                            <h3>{{ $interest->startupProfile?->company_name ?? ($interest->startupUser?->name ?? 'Unknown Startup') }}</h3>
                                            <div style="display:flex;gap:6px;margin-top:4px;">
                                                @if($interest->startupProfile?->industry)
                                                    <span class="badge badge-industry">{{ $interest->startupProfile->industry }}</span>
                                                @endif
                                                @if($interest->startupProfile?->stage)
                                                    <span class="badge badge-stage">{{ $interest->startupProfile->stage }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <span class="badge badge-{{ $interest->status }}" id="status-{{ $interest->_id }}">
                                        {{ ucfirst($interest->status) }}
                                    </span>
                                </div>

                                <div class="interest-message">
                                    "{{ $interest->message }}"
                                </div>

                                <div class="interest-meta">
                                    @if($interest->startupProfile?->location)
                                        <span>📍 {{ $interest->startupProfile->location }}</span>
                                    @endif
                                    <span>📅 {{ $interest->created_at ? $interest->created_at->format('d M Y') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif

    </div>
</section>
@endsection
