<?php

namespace App\Http\Controllers;

use App\Models\BCID;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($handle)
    {
        // Find the citizen by handle, or fail if not found
        $citizen = BCID::where('handle', strtolower($handle))->firstOrFail();

        return view('profile.show', compact('citizen'));
    }
}