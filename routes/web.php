<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarberoController;
use App\Http\Controllers\CitaController;

/*
|--------------------------------------------------------------------------
| Autenticación
|--------------------------------------------------------------------------
*/
Route::get('/login',      [AuthController::class, 'mostrar'])->name('login');
Route::post('/login',     [AuthController::class, 'login']);
Route::post('/registro',  [AuthController::class, 'registro']);
Route::post('/recuperar', [AuthController::class, 'recuperar']);

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Reset de contraseña
|--------------------------------------------------------------------------
*/
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset_password', ['token' => $token]);
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
        ? redirect()->route('login')->with('reg_success', 'Contraseña restablecida.')
        : back()->withErrors(['email' => __($status)]);
})->name('password.update');

/*
|--------------------------------------------------------------------------
| Dashboards
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard_admin',
        [AdminController::class, 'index']
    )->name('dashboard.admin');

});

Route::middleware(['auth', 'role:barbero'])->group(function () {

    Route::get('/dashboard_barbero',
        [BarberoController::class, 'dashboard']
    )->name('dashboard.barbero');

});

Route::middleware(['auth', 'role:cliente'])->group(function () {

    Route::get('/dashboard_cliente', [ClienteController::class, 'dashboard'])
        ->name('dashboard.cliente');

    Route::get('/barbero/{id}/disponibilidad', [CitaController::class, 'disponibilidad'])
        ->name('barbero.disponibilidad');

    Route::post('/citas', [CitaController::class, 'store'])
        ->name('citas.store');
});
/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Perfil
    Route::put('/profile/update',
        [AdminController::class, 'updateProfile']
    )->name('profile.update');

    Route::put('/password/update',
        [AdminController::class, 'updatePassword']
    )->name('password.change');

    // Publicaciones
    Route::post('/posts/store',
        [AdminController::class, 'storePost']
    )->name('posts.store');

    Route::delete('/posts/{id}',
        [AdminController::class, 'destroyPost']
    )->name('posts.destroy');

    // Barberos
    Route::post('/barbers/store',
        [AdminController::class, 'storeBarber']
    )->name('barbers.store');

    Route::patch('/barbers/{id}/toggle',
        [AdminController::class, 'toggleBarber']
    )->name('barbers.toggle');

    // Horario
    Route::put('/schedule/update',
        [AdminController::class, 'updateSchedule']
    )->name('schedule.update');

    Route::patch('/barberia/toggle',
        [AdminController::class, 'toggleBarberia']
    )->name('barberia.toggle');

    Route::put('/barberia/update',
        [AdminController::class, 'updateBarberia']
    )->name('barberia.update');

    Route::put('/posts/{id}', [AdminController::class, 'updatePost'])->name('posts.update');

    Route::post('/services/store',
        [AdminController::class, 'storeService']
    )->name('services.store');

    Route::delete('/services/{id}',
        [AdminController::class, 'destroyService']
    )->name('services.destroy');
});

/*
|--------------------------------------------------------------------------
| Barbero
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:barbero'])
    ->prefix('barber')
    ->name('barber.')
    ->group(function () {

    Route::put('/profile/update',
        [BarberoController::class, 'updateProfile']
    )->name('profile.update');

    Route::put('/password/update',
        [BarberoController::class, 'updatePassword']
    )->name('password.update');

    Route::post('/posts/store',
        [BarberoController::class, 'storePost']
    )->name('posts.store');

    Route::delete('/posts/{id}',
        [BarberoController::class, 'destroyPost']
    )->name('posts.destroy');


    Route::get('/agenda', [BarberoController::class, 'agenda'])
            ->name('agenda');

    Route::patch('/citas/{idCita}/estado', [BarberoController::class, 'updateEstado'])
            ->name('citas.estado');

    Route::delete('/citas/{idCita}', [BarberoController::class, 'cancelar'])
            ->name('citas.cancelar');

    Route::get('/atender', [BarberoController::class, 'atenderPanel'])->name('atender');
    Route::post('/atender/{id}', [BarberoController::class, 'completarCita'])->name('atender.completar');
});

Route::get('/citas/horas-ocupadas', [CitaController::class, 'horasOcupadas'])
    ->name('citas.horasOcupadas')
    ->middleware('auth');