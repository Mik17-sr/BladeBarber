<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, viewport-fit=cover">
  <title>BladeBarber · Restablecer contraseña</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/BladeBarber/public/css/login.css">
</head>
<body>
<div class="bg-scene">
  <div class="bg-grain"></div>
  <div class="bg-glow bg-glow--1"></div>
  <div class="bg-glow bg-glow--2"></div>
</div>
<div class="stage">
  <main class="card-wrap">
    <div class="auth-card active">
      <div class="card-head">
        <div class="card-logo">
          <svg viewBox="0 0 32 32" fill="none">
            <path d="M8 6 L24 26 M24 6 L8 26" stroke="#0E0E0E" stroke-width="2.5" stroke-linecap="round"/>
            <circle cx="8"  cy="6"  r="4" fill="#0E0E0E"/>
            <circle cx="24" cy="6"  r="4" fill="#0E0E0E"/>
            <circle cx="16" cy="16" r="2.5" fill="#C9A84C"/>
          </svg>
        </div>
        <h2 class="card-title">Nueva contraseña</h2>
        <p class="card-sub">Ingresa tu nueva contraseña</p>
      </div>

      @if($errors->any())
        <div class="feedback feedback--err">{{ $errors->first() }}</div>
      @endif

      <form class="auth-form" method="POST" action="{{ url('/reset-password') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="field-wrap">
          <label class="field-lbl" for="email">Correo electrónico</label>
          <div class="field-box">
            <svg class="field-icon" viewBox="0 0 20 20" fill="none">
              <rect x="2" y="5" width="16" height="11" rx="2" stroke="currentColor" stroke-width="1.3"/>
              <path d="M2 7l8 5 8-5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
            </svg>
            <input type="email" id="email" name="email"
              value="{{ request('email') }}"
              placeholder="tucorreo@ejemplo.com" required>
          </div>
        </div>

        <div class="field-wrap">
          <label class="field-lbl" for="password">Nueva contraseña</label>
          <div class="field-box">
            <svg class="field-icon" viewBox="0 0 20 20" fill="none">
              <rect x="4" y="9" width="12" height="9" rx="2" stroke="currentColor" stroke-width="1.3"/>
              <path d="M7 9V7a3 3 0 016 0v2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
              <circle cx="10" cy="13.5" r="1.2" fill="currentColor"/>
            </svg>
            <input type="password" id="password" name="password"
              placeholder="mínimo 6 caracteres" required>
          </div>
        </div>

        <div class="field-wrap">
          <label class="field-lbl" for="password_confirmation">Confirmar contraseña</label>
          <div class="field-box">
            <svg class="field-icon" viewBox="0 0 20 20" fill="none">
              <rect x="4" y="9" width="12" height="9" rx="2" stroke="currentColor" stroke-width="1.3"/>
              <path d="M7 9V7a3 3 0 016 0v2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
              <circle cx="10" cy="13.5" r="1.2" fill="currentColor"/>
            </svg>
            <input type="password" id="password_confirmation" name="password_confirmation"
              placeholder="repite tu contraseña" required>
          </div>
        </div>

        <button type="submit" class="btn-primary">
          <span>Restablecer contraseña</span>
          <svg viewBox="0 0 20 20" fill="none">
            <path d="M4 10h12M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </form>
    </div>
  </main>
</div>
<script src="/BladeBarber/public/js/login.js"></script>
</body>
</html>