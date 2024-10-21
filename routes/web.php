<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavorateController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

//home
Route::get('/', [HomeController::class, 'home']);
Route::get('/logout/{id}', [AuthController::class, 'logout'])->name('logout');
Route::get('/get-cities/{stateId}', [ProfileController::class, 'getCities']);
Route::get('view/{id}', [UploadController::class, 'show']);
Route::get('oldpaper', [FileController::class, 'old_paper'])->name('oldpaper');
Route::get('notes', [FileController::class, 'notes'])->name('notes');
Route::get('allpdf', [FileController::class, 'allpdf'])->name('allpdf');
Route::get('profile/{username}', [ProfileController::class, 'profile'])->name('profile');
Route::get('allfiles/{id}', [ProfileController::class, 'allfiles'])->name('allfiles');
Route::get('oldpapers/{id}', [ProfileController::class, 'old_paper'])->name('oldpapers');
Route::get('noteses/{id}', [ProfileController::class, 'notes'])->name('noteses');
Route::get('allpdfs/{id}', [ProfileController::class, 'allpdf'])->name('allpdfs');
Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::middleware(['user'])->group(function () {
    Route::get('editprofile/{id}', [ProfileController::class, 'update_profile']);
    Route::post('updateprofile/{id}', [ProfileController::class, 'updateprofile'])->name('updateprofile');
    Route::get('/search-colleges', [UploadController::class, 'search']);
    Route::get('upload/file/', [UploadController::class, 'upload_file'])->name('upload.file');
    Route::post('upload/files/{id}', [UploadController::class, 'uploadfile'])->name('upload.files');
    Route::get('edit/uploadfile/{id}', [UploadController::class, 'edit_upload_file'])->name('edit.upload.file');
    Route::post('update/uploadfiles/{id}', [UploadController::class, 'edituploadfile'])->name('update.upload.files');
    Route::get('delete/uploadfile/{id}', [UploadController::class, 'deleteuploadfile'])->name('delete.upload.file');
    Route::get('/get-subjects/{courseId}', [UploadController::class, 'getSubjects']);
    Route::get('favorate/{id}', [ProfileController::class, 'favorite'])->name('favorites');
    Route::post('/add-favorite', [FavorateController::class, 'addFavorite'])->name('add.favorite');
    Route::post('/remove-favorite', [FavorateController::class, 'removeFavorite'])->name('remove.favorite');
});

Route::middleware(['notify'])->group(function () {
    Route::get('/registerlogin', [AuthController::class, 'registerlogin'])->name('registerlogin');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/clear-notification', [AuthController::class, 'clearNotification']);

});

//google
Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);
