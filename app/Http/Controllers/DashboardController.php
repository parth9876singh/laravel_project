<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\Profile;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $userId = (string) $user->_id;

        if ($user->role === 'startup') {
            $interests = Interest::where('startup_id', $userId)->orderBy('created_at', 'desc')->get();

            // Enrich each interest with corporate user + profile
            $interests = $interests->map(function ($interest) {
                $corporate = User::find($interest->corporate_id);
                $interest->corporateUser    = $corporate;
                $interest->corporateProfile = $interest->getCorporateProfile();
                return $interest;
            });

            $stats = [
                'total'    => $interests->count(),
                'pending'  => $interests->where('status', 'pending')->count(),
                'accepted' => $interests->where('status', 'accepted')->count(),
                'rejected' => $interests->where('status', 'rejected')->count(),
            ];

            return view('dashboard.index', compact('interests', 'stats'));
        }

        // Corporate role
        $interests = Interest::where('corporate_id', $userId)->orderBy('created_at', 'desc')->get();

        $interests = $interests->map(function ($interest) {
            $startup = User::find($interest->startup_id);
            $interest->startupUser    = $startup;
            $interest->startupProfile = $interest->getStartupProfile();
            return $interest;
        });

        $stats = [
            'total'    => $interests->count(),
            'pending'  => $interests->where('status', 'pending')->count(),
            'accepted' => $interests->where('status', 'accepted')->count(),
            'rejected' => $interests->where('status', 'rejected')->count(),
        ];

        return view('dashboard.index', compact('interests', 'stats'));
    }
}
