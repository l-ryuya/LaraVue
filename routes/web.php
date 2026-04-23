<?php

use App\Jobs\TestMailJob;
use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::post('send-mail', function () {
        $users = User::limit(1000)->get();

        foreach ($users as $user) {
            // $cc = User::limit(10)->where('id', '!=', $user->id)->get()->pluck('email')->toArray();
            TestMailJob::dispatch($user);
        }
    })->name('send-mail');
});

require __DIR__.'/settings.php';
