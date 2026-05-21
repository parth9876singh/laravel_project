<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class StartupController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all startup users
        $startupUsers = User::where('role', 'startup')->get();

        // Get all startup user IDs
        $startupIds = $startupUsers->map(fn($u) => (string) $u->_id)->toArray();

        // Fetch profiles for all startups
        $profilesQuery = Profile::whereIn('user_id', $startupIds);

        // Apply industry filter
        if ($request->filled('industry')) {
            $profilesQuery->where('industry', $request->industry);
        }

        // Apply search filter
        if ($request->filled('search')) {
            $term = $request->search;
            $profilesQuery->where(function ($q) use ($term) {
                $q->where('company_name', 'regex', '/' . preg_quote($term, '/') . '/i')
                  ->orWhere('description', 'regex', '/' . preg_quote($term, '/') . '/i')
                  ->orWhere('tagline', 'regex', '/' . preg_quote($term, '/') . '/i');
            });
        }

        $profiles = $profilesQuery->get();

        // Map profiles to their users
        $startups = $profiles->map(function ($profile) use ($startupUsers) {
            $user = $startupUsers->firstWhere('_id', $profile->user_id) 
                  ?? $startupUsers->first(fn($u) => (string)$u->_id === $profile->user_id);
            if (!$user) return null;
            $user->profileData = $profile;
            return $user;
        })->filter()->values();

        $industries = ['FinTech','HealthTech','EdTech','AgriTech','E-Commerce','AI/ML','CleanEnergy','Logistics','SaaS','Other'];

        return view('startups.index', compact('startups', 'industries'));
    }

    public function show(string $id)
    {
        $startup = User::where('role', 'startup')->find($id);
        if (!$startup) {
            abort(404, 'Startup not found.');
        }

        $profile = Profile::where('user_id', $id)->first();
        return view('startups.show', compact('startup', 'profile'));
    }
}
