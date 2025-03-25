<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\Auth\AuthController;
  
Route::get('/', function () {
    return view('welcome');
});
  
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login/call',[AuthController::class,'callBackLogin'])->name('callBackLogin');

Route::get('/accounts', [AuthController::class, 'accounts'])->name('accounts');
