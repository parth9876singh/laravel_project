@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<section class="section">
    <div class="container">
        <div class="page-header">
            <div>
                <h1>Your Profile</h1>
                <p style="color:var(--text-secondary);margin-top:4px;">
                    {{ auth()->user()->role === 'startup' ? '🚀 Startup Profile' : '🏢 Corporate Profile' }}
                </p>
            </div>
            <a href="/dashboard" class="btn btn-outline btn-sm" id="back-dashboard">← Dashboard</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success" id="profile-success">{{ session('success') }}</div>
        @endif

        <div class="profile-form-card">
            <form action="/profile" method="POST" id="profile-form">
                @csrf

                <div class="form-section">
                    <h2 class="form-section-title">Company Information</h2>

                    <div class="form-group">
                        <label for="company_name">Company Name <span class="required">*</span></label>
                        <input type="text" name="company_name" id="company_name"
                            value="{{ old('company_name', $profile?->company_name) }}"
                            placeholder="e.g. AgroSense AI">
                        @error('company_name')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="tagline">Tagline</label>
                        <input type="text" name="tagline" id="tagline"
                            value="{{ old('tagline', $profile?->tagline) }}"
                            placeholder="One line that captures your mission">
                        @error('tagline')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description"
                            placeholder="Tell your story — what problem are you solving and how?">{{ old('description', $profile?->description) }}</textarea>
                        @error('description')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="industry">Industry</label>
                            <select name="industry" id="industry">
                                <option value="">— Select industry —</option>
                                @foreach(['FinTech','HealthTech','EdTech','AgriTech','E-Commerce','AI/ML','CleanEnergy','Logistics','SaaS','Other'] as $ind)
                                    <option value="{{ $ind }}"
                                        {{ old('industry', $profile?->industry) === $ind ? 'selected' : '' }}>
                                        {{ $ind }}
                                    </option>
                                @endforeach
                            </select>
                            @error('industry')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location"
                                value="{{ old('location', $profile?->location) }}"
                                placeholder="e.g. Bengaluru, Karnataka">
                            @error('location')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="website">Website URL</label>
                        <input type="url" name="website" id="website"
                            value="{{ old('website', $profile?->website) }}"
                            placeholder="https://yourcompany.com">
                        @error('website')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="tags">Tags <small>(comma-separated)</small></label>
                        <input type="text" name="tags" id="tags"
                            value="{{ old('tags', $profile?->tags ? implode(', ', $profile->tags) : '') }}"
                            placeholder="AI, SaaS, B2B, Mobile">
                        @error('tags')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Startup-only fields --}}
                @if(auth()->user()->role === 'startup')
                <div class="form-section">
                    <h2 class="form-section-title">Startup Details</h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="stage">Stage</label>
                            <select name="stage" id="stage">
                                <option value="">— Select stage —</option>
                                @foreach(['Idea','MVP','Early Stage','Growth','Scaling'] as $stg)
                                    <option value="{{ $stg }}"
                                        {{ old('stage', $profile?->stage) === $stg ? 'selected' : '' }}>
                                        {{ $stg }}
                                    </option>
                                @endforeach
                            </select>
                            @error('stage')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label for="team_size">Team Size</label>
                            <input type="number" name="team_size" id="team_size"
                                value="{{ old('team_size', $profile?->team_size) }}"
                                placeholder="e.g. 8" min="1">
                            @error('team_size')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="funding_needed">Funding Needed</label>
                        <input type="text" name="funding_needed" id="funding_needed"
                            value="{{ old('funding_needed', $profile?->funding_needed) }}"
                            placeholder="e.g. ₹2 Crore">
                        @error('funding_needed')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                </div>
                @endif

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" id="btn-save-profile">
                        Save Profile ✓
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
