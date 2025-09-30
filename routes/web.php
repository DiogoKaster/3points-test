<?php

declare(strict_types=1);

use App\Http\Controllers\CommunityController;
use Illuminate\Support\Facades\Route;

Route::get('/', static fn () => view('home'));
Route::get('/communities', [CommunityController::class, 'index'])->name('communities.index');
