<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangayIDController;
use App\Http\Controllers\ComplaintCategoryController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ComplaintLocationController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ResetPasswordController;
use App\Models\User;
use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(function () {

  // Welcome page
  Route::view('/', 'pages.welcome')->name('welcome');
  Route::post('/feedbackQuest', [FeedbackController::class, 'sendQuest'])->name('sendQuest');

  // Signup
  Route::get('/signup', [AuthController::class, 'index'])->name('signup');
  // Route::view('/signup', 'auth.signup')->name('signup');
  Route::post('/signup', [AuthController::class, 'signup']);

  // Login
  Route::view('/login', 'auth.login')->name('login');
  Route::post('/login', [AuthController::class, 'login']);

  // Forgot Password
  Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
  Route::post('/forgot-password', [ResetPasswordController::class, 'passwordEmail'])->name('password.email');
  Route::get('/reset-password/{token}', [ResetPasswordController::class, 'passwordReset'])->name('password.reset');
  Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');
});


// Admin Verifies User
Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
  $user = User::findOrFail($id);

  if (sha1($user->email) !== $hash) {
    abort(403, "Unauthorized action.");
  }

  $user->update(['email_verified_at' => now()]);
  return redirect('/')->with('message', 'User has been verified.');
})->name('verification.verify');



Route::middleware('auth')->group(function () {
  // Dashboard
  Route::get('/dashboard', [ComplaintController::class, 'index'])->name('landing');
  Route::post('/dashboard/create', [ComplaintController::class, 'store']);
  Route::delete('/complaints/{complaint}', [ComplaintController::class, 'destroy'])->name('complaints.destroy');
  Route::put('/complaints/{complaint}', [ComplaintController::class, 'update'])->name('complaints.update');

  // Resend Verification Email
  Route::post('/email/resend', [AuthController::class, 'resendVerificationEmail'])->name('verification.resend');

  // All Complaints
  Route::get('/complaints', [ComplaintController::class, 'allComplaints'])->name('allComplaints');
  Route::post('/complaints/create', [ComplaintController::class, 'storeAllComplaint']);
  Route::delete('/complaint/{complaint}', [ComplaintController::class, 'destroyAllComplaint'])->name('allComplaints.destroy');
  Route::put('/complaint/{complaint}', [ComplaintController::class, 'updateAllComplaint'])->name('allComplaints.update');

  //Logout
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

  // Profile 
  Route::get('/profile', [AuthController::class, 'user'])->name('profile');
  Route::put('/profile/update', [AuthController::class, 'update'])->name('profile.update');

  // Provide Feedback 
  Route::view('/provideFeedback', 'pages.provideFeedback')->name('provideFeedback');
  Route::post('/provideFeedback/create', [FeedbackController::class, 'store']);

  // Feedbacks
  Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks');
  Route::delete('/feedbacks/{feedback}', [FeedbackController::class, 'destroy'])->name('feedbacks.destroy');

  // Barangay Data
  Route::get('/barangayData', [ComplaintCategoryController::class, 'index'])->name('barangayData');
  Route::post('/barangayData/createCategory', [ComplaintCategoryController::class, 'store']);
  Route::delete('/barangayData/{complaintCategory}', [ComplaintCategoryController::class, 'destroy'])->name('barangayData.destroy');
  Route::put('/barangayData/{complaintCategory}', [ComplaintCategoryController::class, 'update'])->name('barangayData.update');


  Route::post('/barangayData/createLocation', [ComplaintLocationController::class, 'store']);
  Route::delete('/barangayData/deleteLocation/{complaintLocation}', [ComplaintLocationController::class, 'destroy'])->name('barangayData.destroyLocation');
  Route::put('/barangayData/updateLocation/{complaintLocation}', [ComplaintLocationController::class, 'update'])->name('barangayData.updateLocation');

  Route::put('/barangayData/update/{id}', [BarangayIDController::class, 'update'])->name('barangayData.updateBarangayID');

  // Camera
  Route::get('/capture', function () {
    return view('capture');
  });
  Route::post('/upload-image', [ImageController::class, 'store'])->name('upload.image');
});
