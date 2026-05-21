<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    public function store(Request $request, string $startupId)
    {
        $request->validate([
            'message' => 'required|string|min:10|max:500',
        ]);

        $alreadySent = Interest::where('corporate_id', (string) auth()->id())
            ->where('startup_id', $startupId)
            ->exists();

        if ($alreadySent) {
            return back()->with('error', 'You have already sent interest to this startup.');
        }

        Interest::create([
            'corporate_id' => (string) auth()->id(),
            'startup_id'   => $startupId,
            'message'      => $request->message,
            'status'       => 'pending',
        ]);

        return back()->with('success', 'Interest sent successfully! The startup will be notified.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $startupId = (string) auth()->id();

        $interest = Interest::where('_id', $id)
            ->where('startup_id', $startupId)
            ->first();

        if (!$interest) {
            return back()->with('error', 'Interest not found or you do not have permission to update it.');
        }

        $interest->status = $request->status;
        $interest->save();

        $msg = $request->status === 'accepted'
            ? 'Interest accepted! The corporate will be notified.'
            : 'Interest declined.';

        return back()->with('success', $msg);
    }
}
