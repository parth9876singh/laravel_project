<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::where('user_id', (string) auth()->id())->first();
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $rules = [
            'company_name' => 'required|string|max:100',
            'tagline'      => 'nullable|string|max:200',
            'description'  => 'nullable|string|max:2000',
            'industry'     => 'nullable|in:FinTech,HealthTech,EdTech,AgriTech,E-Commerce,AI/ML,CleanEnergy,Logistics,SaaS,Other',
            'location'     => 'nullable|string|max:100',
            'website'      => 'nullable|url|max:255',
            'tags'         => 'nullable|string',
        ];

        if (auth()->user()->role === 'startup') {
            $rules['stage']          = 'nullable|in:Idea,MVP,Early Stage,Growth,Scaling';
            $rules['funding_needed'] = 'nullable|string|max:100';
            $rules['team_size']      = 'nullable|integer|min:1|max:100000';
        }

        $request->validate($rules);

        $data = $request->only([
            'company_name', 'tagline', 'description', 'industry',
            'location', 'website',
        ]);

        if (auth()->user()->role === 'startup') {
            $data['stage']          = $request->stage;
            $data['funding_needed'] = $request->funding_needed;
            $data['team_size']      = $request->team_size ? (int) $request->team_size : null;
        }

        // Convert comma-separated tags to array
        if ($request->filled('tags')) {
            $data['tags'] = array_values(array_filter(
                array_map('trim', explode(',', $request->tags))
            ));
        } else {
            $data['tags'] = [];
        }

        $data['user_id'] = (string) auth()->id();

        Profile::updateOrCreate(
            ['user_id' => (string) auth()->id()],
            $data
        );

        return back()->with('success', 'Profile saved successfully!');
    }
}
