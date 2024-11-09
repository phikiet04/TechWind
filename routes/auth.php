<!-- // routes/auth.php -->
<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Route cho xác thực email
Route::middleware('auth')->group(function () {
Route::get('/email/verify', function () {
return view('auth.verify');
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
$request->fulfill();
return redirect( '/home'); // Thay đổi để redirect về trang chính
})->middleware('signed')->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
$request->user()->sendEmailVerificationNotification();
return back()->with('message', 'Verification link sent!');
})->middleware('throttle:6,1')->name('verification.resend');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

