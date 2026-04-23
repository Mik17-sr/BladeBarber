<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

Route::get('/login',     [AuthController::class, 'mostrar'])->name('login');
Route::post('/login',    [AuthController::class, 'login']);
Route::post('/registro', [AuthController::class, 'registro']);
Route::post('/recuperar',[AuthController::class, 'recuperar']);
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::view('/dashboard_admin', 'dashboard_admin')
    ->middleware('auth')
    ->name('dashboard.admin');

Route::view('/dashboard_barbero', 'dashboard_barbero')
    ->middleware('auth')  
    ->name('dashboard.barbero');

Route::view('/dashboard_cliente', 'dashboard_cliente')
    ->middleware('auth')  
    ->name('dashboard.cliente');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');


 Route::post('/reset-password', function (Request $request) {
    $status = Password::broker()->reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'contrasena' => Hash::make($password)
            ])->save();
            event(new \Illuminate\Auth\Events\PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('reg_success', 'Contraseña restablecida. Ya puedes iniciar sesión.')
        : back()->withErrors(['email' => __($status)]);
})->name('password.update');


Route::prefix('admin')->name('admin.')->group(function () {

    Route::put('/profile/update',
        [AdminController::class,'updateProfile']
    )->name('profile.update');

    Route::put('/password/update',
    [AdminController::class,'updatePassword']
    )->name('password.change');

    Route::post('/posts/store',
        [AdminController::class,'storePost']
    )->name('posts.store');

    Route::delete('/posts/{id}',
        [AdminController::class,'destroyPost']
    )->name('posts.destroy');

    Route::post('/barbers/store',
        [AdminController::class,'storeBarber']
    )->name('barbers.store');

    Route::patch('/barbers/{id}/toggle',
        [AdminController::class,'toggleBarber']
    )->name('barbers.toggle');

    Route::put('/schedule/update',
        [AdminController::class,'updateSchedule']
    )->name('schedule.update');

    Route::patch('/barberia/toggle',
        [AdminController::class,'toggleBarberia']
    )->name('barberia.toggle');

    Route::put('/barberia/update',
        [AdminController::class,'updateBarberia']
    )->name('barberia.update');
});