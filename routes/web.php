<?php

use App\Http\Controllers\IdentityController;
use App\Http\Controllers\TreasuryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Change .php to ::class here
    Route::post('/identity/claim', [IdentityController::class, 'claimHandle'])->name('identity.claim');
});

Route::get('/treasury', [TreasuryController::class, 'index'])->name('treasury');

// This allows for URLs like 127.0.0.1:8000/u/adex
Route::get('/u/{handle}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/feed', function () {
    return view('feed');
})->name('feed');

Route::get('/agent/logs', function () {
    return view('agent-logs');
})->name('agent.logs');
