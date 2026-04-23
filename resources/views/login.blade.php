<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, viewport-fit=cover">
  <title>BladeBarber · Acceso</title>
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
  <aside class="brand-col">
    <div class="brand-logo">
      <svg viewBox="0 0 40 40" fill="none">
        <path d="M10 8 L30 32 M30 8 L10 32" stroke="#0E0E0E" stroke-width="3" stroke-linecap="round"/>
        <circle cx="10" cy="8"  r="5" fill="#0E0E0E"/>
        <circle cx="30" cy="8"  r="5" fill="#0E0E0E"/>
        <circle cx="20" cy="20" r="3.5" fill="#C9A84C"/>
      </svg>
    </div>
    <h1 class="brand-name">BladeBarber</h1>
    <p class="brand-tagline">Tu barbería digital</p>
    <ul class="brand-features">
      <li><span class="feat-dot"></span>Reservas en segundos</li>
      <li><span class="feat-dot"></span>Programa de puntos</li>
      <li><span class="feat-dot"></span>Panel para barberos</li>
      <li><span class="feat-dot"></span>Control total del negocio</li>
    </ul>
    <div class="brand-deco">
      <svg viewBox="0 0 200 200" fill="none" preserveAspectRatio="xMidYMid meet">
        <circle cx="100" cy="100" r="90" stroke="rgba(201,168,76,0.12)" stroke-width="1"/>
        <circle cx="100" cy="100" r="65" stroke="rgba(201,168,76,0.08)" stroke-width="1"/>
        <circle cx="100" cy="100" r="40" stroke="rgba(201,168,76,0.05)" stroke-width="1"/>
        <path d="M50 50 L150 150 M150 50 L50 150" stroke="rgba(201,168,76,0.15)" stroke-width="1.5" stroke-linecap="round"/>
        <circle cx="50"  cy="50"  r="7" fill="rgba(201,168,76,0.25)"/>
        <circle cx="150" cy="50"  r="7" fill="rgba(201,168,76,0.25)"/>
        <circle cx="100" cy="100" r="5" fill="rgba(201,168,76,0.5)"/>
      </svg>
    </div>
  </aside>
  <main class="card-wrap">

    {{-- PANEL LOGIN --}}
    <div id="panelLogin" class="auth-card {{ $active_panel === 'login' ? 'active' : '' }}">
      <div class="card-head">
        <div class="card-logo">
          <svg viewBox="0 0 32 32" fill="none">
            <path d="M8 6 L24 26 M24 6 L8 26" stroke="#0E0E0E" stroke-width="2.5" stroke-linecap="round"/>
            <circle cx="8"  cy="6"  r="4" fill="#0E0E0E"/>
            <circle cx="24" cy="6"  r="4" fill="#0E0E0E"/>
            <circle cx="16" cy="16" r="2.5" fill="#C9A84C"/>
          </svg>
        </div>
        <h2 class="card-title">Bienvenido</h2>
        <p class="card-sub">Ingresa tus credenciales para continuar</p>
      </div>

      @if($reg_success)
        <div class="feedback feedback--ok">{{ $reg_success }}</div>
      @endif
      @if($login_error)
        <div class="feedback feedback--err">{{ $login_error }}</div>
      @endif

      <form class="auth-form" method="POST" action="/BladeBarber/public/login">
        @csrf
        <div class="field-wrap">
          <label class="field-lbl" for="loginUser">Usuario</label>
          <div class="field-box">
            <svg class="field-icon" viewBox="0 0 20 20" fill="none">
              <circle cx="10" cy="7" r="3.5" stroke="currentColor" stroke-width="1.3"/>
              <path d="M3 17c0-3.866 3.134-7 7-7s7 3.134 7 7" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
            </svg>
            <input type="text" id="loginUser" name="usuario"
              placeholder="tuusuario"
              value="{{ old('usuario') }}"
              autocomplete="username" required>
          </div>
        </div>
        <div class="field-wrap">
          <label class="field-lbl" for="loginPass">Contraseña</label>
          <div class="field-box">
            <svg class="field-icon" viewBox="0 0 20 20" fill="none">
              <rect x="4" y="9" width="12" height="9" rx="2" stroke="currentColor" stroke-width="1.3"/>
              <path d="M7 9V7a3 3 0 016 0v2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
              <circle cx="10" cy="13.5" r="1.2" fill="currentColor"/>
            </svg>
            <input type="password" id="loginPass" name="password"
              placeholder="••••••••"
              autocomplete="current-password" required>
            <button type="button" class="eye-btn" data-target="loginPass" aria-label="Mostrar contraseña">
              <svg class="eye-open" viewBox="0 0 20 20" fill="none">
                <path d="M2 10s3-6 8-6 8 6 8 6-3 6-8 6-8-6-8-6z" stroke="currentColor" stroke-width="1.3"/>
                <circle cx="10" cy="10" r="2.5" stroke="currentColor" stroke-width="1.3"/>
              </svg>
              <svg class="eye-shut" viewBox="0 0 20 20" fill="none" style="display:none">
                <path d="M3 3l14 14M8.5 8.7A2.5 2.5 0 0013 12M5.5 6.1C3.8 7.3 2 10 2 10s3 6 8 6c1.5 0 2.9-.4 4-1.1M9 4.1C9.3 4 9.6 4 10 4c5 0 8 6 8 6s-.8 1.6-2.3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
              </svg>
            </button>
          </div>
        </div>
        <button type="submit" class="btn-primary">
          <span>Iniciar sesión</span>
          <svg viewBox="0 0 20 20" fill="none">
            <path d="M4 10h12M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </form>

      <div class="auth-links">
        <button class="link-btn" data-show="panelForgot">¿Olvidaste tu contraseña?</button>
        <span class="link-sep">·</span>
        <button class="link-btn" data-show="panelRegister">Crear cuenta</button>
      </div>
    </div>

    <div id="panelRegister" class="auth-card {{ $active_panel === 'registro' ? 'active' : '' }}">
      <div class="card-head">
        <div class="card-logo">
          <svg viewBox="0 0 32 32" fill="none">
            <path d="M8 6 L24 26 M24 6 L8 26" stroke="#0E0E0E" stroke-width="2.5" stroke-linecap="round"/>
            <circle cx="8"  cy="6"  r="4" fill="#0E0E0E"/>
            <circle cx="24" cy="6"  r="4" fill="#0E0E0E"/>
            <circle cx="16" cy="16" r="2.5" fill="#C9A84C"/>
          </svg>
        </div>
        <h2 class="card-title">Crear cuenta</h2>
        <p class="card-sub">Únete a BladeBarber como cliente</p>
      </div>

      @if($reg_error)
        <div class="feedback feedback--err">{{ $reg_error }}</div>
      @endif

      <form class="auth-form" method="POST" action="/BladeBarber/public/registro">
        @csrf
        <div class="field-wrap">
          <label class="field-lbl" for="regNombre">Nombre completo</label>
          <div class="field-box">
            <svg class="field-icon" viewBox="0 0 20 20" fill="none">
              <circle cx="10" cy="7" r="3.5" stroke="currentColor" stroke-width="1.3"/>
              <path d="M3 17c0-3.866 3.134-7 7-7s7 3.134 7 7" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
            </svg>
            <input type="text" id="regNombre" name="nombre"
              placeholder="Carlos Méndez"
              value="{{ old('nombre') }}"
              autocomplete="name" required>
          </div>
        </div>
        <div class="field-wrap">
          <label class="field-lbl" for="regUser">Nombre de usuario</label>
          <div class="field-box">
            <svg class="field-icon" viewBox="0 0 20 20" fill="none">
              <circle cx="10" cy="7" r="3.5" stroke="currentColor" stroke-width="1.3"/>
              <path d="M3 17c0-3.866 3.134-7 7-7s7 3.134 7 7" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
            </svg>
            <input type="text" id="regUser" name="usuario"
              placeholder="tuusuario"
              value="{{ old('usuario') }}"
              autocomplete="username" required>
          </div>
        </div>
        <div class="field-wrap">
          <label class="field-lbl" for="regPhone">Teléfono</label>
          <div class="field-box">
            <svg class="field-icon" viewBox="0 0 20 20" fill="none">
              <path d="M4 4h3l2 2h4l2-2h3v12h-3l-2-2h-4l-2 2H4V4z" stroke="currentColor" stroke-width="1.3" fill="none"/>
              <path d="M7 7h6M7 10h6M7 13h3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
            </svg>
            <input type="tel" id="regPhone" name="telefono"
              placeholder="+57 300 000 000"
              value="{{ old('telefono') }}"
              autocomplete="tel" required>
          </div>
        </div>
        <div class="field-wrap">
          <label class="field-lbl" for="regEmail">Correo electrónico</label>
          <div class="field-box">
            <svg class="field-icon" viewBox="0 0 20 20" fill="none">
              <rect x="2" y="5" width="16" height="11" rx="2" stroke="currentColor" stroke-width="1.3"/>
              <path d="M2 7l8 5 8-5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
            </svg>
            <input type="email" id="regEmail" name="email"
              placeholder="correo@ejemplo.com"
              value="{{ old('email') }}"
              autocomplete="email" required>
          </div>
        </div>
        <div class="field-wrap">
          <label class="field-lbl" for="regPass">Contraseña</label>
          <div class="field-box">
            <svg class="field-icon" viewBox="0 0 20 20" fill="none">
              <rect x="4" y="9" width="12" height="9" rx="2" stroke="currentColor" stroke-width="1.3"/>
              <path d="M7 9V7a3 3 0 016 0v2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
              <circle cx="10" cy="13.5" r="1.2" fill="currentColor"/>
            </svg>
            <input type="password" id="regPass" name="password"
              placeholder="mínimo 6 caracteres" required>
            <button type="button" class="eye-btn" data-target="regPass" aria-label="Mostrar contraseña">
              <svg class="eye-open" viewBox="0 0 20 20" fill="none">
                <path d="M2 10s3-6 8-6 8 6 8 6-3 6-8 6-8-6-8-6z" stroke="currentColor" stroke-width="1.3"/>
                <circle cx="10" cy="10" r="2.5" stroke="currentColor" stroke-width="1.3"/>
              </svg>
              <svg class="eye-shut" viewBox="0 0 20 20" fill="none" style="display:none">
                <path d="M3 3l14 14M8.5 8.7A2.5 2.5 0 0013 12M5.5 6.1C3.8 7.3 2 10 2 10s3 6 8 6c1.5 0 2.9-.4 4-1.1M9 4.1C9.3 4 9.6 4 10 4c5 0 8 6 8 6s-.8 1.6-2.3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
              </svg>
            </button>
          </div>
          <div class="strength-bar"><div id="strengthFill" class="strength-fill"></div></div>
          <div id="strengthText" class="strength-text"></div>
        </div>
        <div class="field-wrap">
          <label class="field-lbl" for="regConfirm">Confirmar contraseña</label>
          <div class="field-box">
            <svg class="field-icon" viewBox="0 0 20 20" fill="none">
              <rect x="4" y="9" width="12" height="9" rx="2" stroke="currentColor" stroke-width="1.3"/>
              <path d="M7 9V7a3 3 0 016 0v2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
              <path d="M8 14l1.5 1.5L13 12" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <input type="password" id="regConfirm" name="confirmar"
              placeholder="repite tu contraseña" required>
          </div>
          <div id="matchMsg" class="match-msg"></div>
        </div>
        <button type="submit" class="btn-primary">
          <span>Registrarme</span>
          <svg viewBox="0 0 20 20" fill="none">
            <path d="M10 3v14M3 10h14" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
          </svg>
        </button>
      </form>

      <div class="auth-links">
        <button class="link-btn" data-show="panelLogin">← Volver al inicio de sesión</button>
      </div>
    </div>

    {{-- PANEL FORGOT --}}
    <div id="panelForgot" class="auth-card {{ $active_panel === 'forgot' ? 'active' : '' }}">
      <div class="card-head">
        <div class="card-logo">
          <svg viewBox="0 0 32 32" fill="none">
            <path d="M8 6 L24 26 M24 6 L8 26" stroke="#0E0E0E" stroke-width="2.5" stroke-linecap="round"/>
            <circle cx="8"  cy="6"  r="4" fill="#0E0E0E"/>
            <circle cx="24" cy="6"  r="4" fill="#0E0E0E"/>
            <circle cx="16" cy="16" r="2.5" fill="#C9A84C"/>
          </svg>
        </div>
        <h2 class="card-title">Recuperar acceso</h2>
        <p class="card-sub">Te enviaremos un enlace a tu correo</p>
      </div>

      @if($forgot_msg)
        <div class="feedback {{ str_contains($forgot_msg, 'recibirás') ? 'feedback--ok' : 'feedback--err' }}">
          {{ $forgot_msg }}
        </div>
      @endif

      <form class="auth-form" method="POST" action="/BladeBarber/public/recuperar">
        @csrf
        <div class="field-wrap">
          <label class="field-lbl" for="forgotEmail">Correo registrado</label>
          <div class="field-box">
            <svg class="field-icon" viewBox="0 0 20 20" fill="none">
              <rect x="2" y="5" width="16" height="11" rx="2" stroke="currentColor" stroke-width="1.3"/>
              <path d="M2 7l8 5 8-5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
            </svg>
            <input type="email" id="forgotEmail" name="correo_recuperar"
              placeholder="tucorreo@ejemplo.com"
              value="{{ old('correo_recuperar') }}"
              autocomplete="email" required>
          </div>
        </div>
        <button type="submit" class="btn-primary">
          <span>Enviar enlace</span>
          <svg viewBox="0 0 20 20" fill="none">
            <path d="M2 10l7-7 1.5 1.5L5.5 9.5H18v1H5.5l5 5L9 17z" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            <path d="M3 10l15-7-7 15-2-6z" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
          </svg>
        </button>
      </form>

      <div class="auth-links">
        <button class="link-btn" data-show="panelLogin">← Volver al inicio de sesión</button>
      </div>
    </div>

  </main>
</div>
<script src="/BladeBarber/public/js/login.js"></script>
</body>
</html>