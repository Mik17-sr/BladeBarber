<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Barbero — BladeBarber</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="/BladeBarber/public/css/barber-dash.css">
</head>

<body>
  <div class="bg-scene">
    <div class="bg-grain"></div>
    <div class="bg-glow bg-glow--1"></div>
    <div class="bg-glow bg-glow--2"></div>
  </div>
  <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

  <!-- SIDEBAR -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-head">
      <div class="logo-box">
        <svg viewBox="0 0 24 24" fill="none" stroke="#0E0E0E" stroke-width="2.2">
          <path d="M3 6h18M3 12h18M3 18h18" />
          <circle cx="8" cy="6" r="2" fill="#0E0E0E" stroke="none" />
          <circle cx="16" cy="12" r="2" fill="#0E0E0E" stroke="none" />
          <circle cx="8" cy="18" r="2" fill="#0E0E0E" stroke="none" />
        </svg>
      </div>
      <div>
        <div class="logo-text">BarberOS</div>
        <div class="logo-role">Barbero</div>
      </div>
    </div>
    <nav class="nav-section">
      <div class="nav-label">Principal</div>
      <button class="nav-item active" onclick="showPanel('welcome')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="3" width="7" height="7" rx="1" />
          <rect x="14" y="3" width="7" height="7" rx="1" />
          <rect x="3" y="14" width="7" height="7" rx="1" />
          <rect x="14" y="14" width="7" height="7" rx="1" />
        </svg>
        Bienvenida
      </button>
      <div class="nav-label">Perfil</div>
      <button class="nav-item" onclick="showPanel('profile-view')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="8" r="4" />
          <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
        </svg>
        Ver Perfil
      </button>
      <button class="nav-item" onclick="showPanel('profile-edit')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
          <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
        </svg>
        Editar Perfil
      </button>
      <button class="nav-item" onclick="showPanel('change-pass')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="11" width="18" height="11" rx="2" />
          <path d="M7 11V7a5 5 0 0 1 10 0v4" />
        </svg>
        Cambiar Contraseña
      </button>
      <div class="nav-label">Publicaciones</div>
      <button class="nav-item" onclick="showPanel('posts-wall')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10l6 6v8a2 2 0 0 1-2 2z" />
        </svg>
        Muro
      </button>
      <button class="nav-item" onclick="showPanel('post-create')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10" />
          <line x1="12" y1="8" x2="12" y2="16" />
          <line x1="8" y1="12" x2="16" y2="12" />
        </svg>
        Nueva Publicación
      </button>
      <div class="nav-label">Barberos</div>
      <button class="nav-item" onclick="showPanel('barbers-list')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
          <circle cx="9" cy="7" r="4" />
          <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
          <path d="M16 3.13a4 4 0 0 1 0 7.75" />
        </svg>
        Equipo
        <span class="nav-badge">4</span>
      </button>
      <div class="nav-label">Agenda</div>
      <button class="nav-item" onclick="showPanel('agenda')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="4" width="18" height="18" rx="2" />
          <line x1="16" y1="2" x2="16" y2="6" />
          <line x1="8" y1="2" x2="8" y2="6" />
          <line x1="3" y1="10" x2="21" y2="10" />
        </svg>
        Mi Agenda
        <span class="nav-badge">5</span>
      </button>
      <button class="nav-item" onclick="showPanel('my-schedule')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10" />
          <polyline points="12 6 12 12 16 14" />
        </svg>
        Mi Horario
      </button>
      <div class="nav-label">Barbería</div>
      <button class="nav-item" onclick="showPanel('barberia')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
        </svg>
        Estado Local
      </button>
      <button class="nav-item" onclick="showPanel('atender')">
        Atender Citas
      </button>
      <button class="nav-item" onclick="showPanel('fila-barbero')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="8" y1="6" x2="21" y2="6" />
          <line x1="8" y1="12" x2="21" y2="12" />
          <line x1="8" y1="18" x2="21" y2="18" />
          <line x1="3" y1="6" x2="3.01" y2="6" />
          <line x1="3" y1="12" x2="3.01" y2="12" />
          <line x1="3" y1="18" x2="3.01" y2="18" />
        </svg>
        Fila de Espera
        <span class="nav-badge nav-badge--pulse">
          {{ $filaCount ?? 0 }}
        </span>
      </button>
      <div class="nav-label">Servicios</div>

      <button class="nav-item" onclick="showPanel('service-register')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M20 7L10 17l-5-5" />
        </svg>
        Registrar Servicio
      </button>
      <button class="nav-item" onclick="showPanel('services-list')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        Ver Servicios
      </button>
      <div class="nav-label">Control de Horas y Descansos</div>
      <button class="nav-item" onclick="showPanel('almuerzo')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="3" width="7" height="7" rx="1" />
          <rect x="14" y="3" width="7" height="7" rx="1" />
          <rect x="3" y="14" width="7" height="7" rx="1" />
          <rect x="14" y="14" width="7" height="7" rx="1" />
        </svg>
        Almuerzo
      </button>
      <button class="nav-item" onclick="showPanel('novedades')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="3" width="7" height="7" rx="1" />
          <rect x="14" y="3" width="7" height="7" rx="1" />
          <rect x="3" y="14" width="7" height="7" rx="1" />
          <rect x="14" y="14" width="7" height="7" rx="1" />
        </svg>
        Novedades
      </button>
    </nav>
    <div class="sidebar-foot">
      <div class="avatar-sm">@if(auth()->user()->foto)
        <img src="{{ asset('storage/' . auth()->user()->foto) }}"
          style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
        @else
        {{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}
        @endif
      </div>
      <div class="foot-info">
        <div class="foot-name">{{ auth()->user()->nombre ?? 'Barbero' }}</div>
        <div class="foot-role">BARBERO</div>
      </div>
      <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button class="logout-btn" type="submit">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            <polyline points="16 17 21 12 16 7" />
            <line x1="21" y1="12" x2="9" y2="12" />
          </svg>
        </button>
      </form>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main">
    <div class="topbar">
      <button class="mob-menu-btn" onclick="openSidebar()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="3" y1="6" x2="21" y2="6" />
          <line x1="3" y1="12" x2="21" y2="12" />
          <line x1="3" y1="18" x2="21" y2="18" />
        </svg>
      </button>
      <span class="topbar-title" id="topbarTitle">Bienvenida</span>
      <div class="topbar-actions">
        <button class="icon-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
          </svg></button>
      </div>
    </div>
    <div class="content">
      <!-- WELCOME -->
      <div class="panel active" id="panel-welcome">
        <div class="welcome-banner">
          <div class="welcome-tag">Panel del Barbero</div>
          <div class="welcome-title">Hola,<br>{{ auth()->user()->nombre ?? 'Barbero' }}</div>
          <div class="welcome-sub">
            Tienes <strong style="color:var(--gold);">{{ $totalCitasHoy }}
              {{ $totalCitasHoy === 1 ? 'cita' : 'citas' }}</strong> programadas para hoy.
          </div>
          <div class="welcome-time">
            <div class="time" id="clock">--:--</div>
            <div class="date" id="dateStr">--</div>
          </div>
        </div>
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-icon stat-icon--gold">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <line x1="16" y1="2" x2="16" y2="6" />
                <line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
              </svg>
            </div>
            <div class="stat-val">{{ $totalCitasHoy }}</div>
            <div class="stat-lbl">Citas Hoy</div>
            <div class="stat-delta delta-up">{{ $totalCitasHoy > 0 ? '↑ Activo' : 'Sin citas' }}</div>
          </div>
          <div class="welcome-sub">
            Tienes
            <strong style="color:var(--gold);">{{ $totalCitasHoy }}
              {{ $totalCitasHoy === 1 ? 'cita' : 'citas' }}</strong>
            programadas para hoy.
          </div>

          {{-- 1C · Card "Mis Próximas Citas" (reemplaza el @foreach hardcoded de la card) --}}
          <div class="card">
            <div class="card-hd"><span class="card-hd-title">Mis Próximas Citas</span></div>
            <div class="card-body">
              @forelse($citasHoy->take(3) as $cita)
              <div class="list-item">
                <div class="li-avatar">
                  {{ strtoupper(substr($cita->cliente->nombre ?? '?', 0, 1)) }}
                </div>
                <div class="li-info">
                  <div class="li-name">{{ $cita->cliente->nombre ?? 'Cliente' }}</div>
                  <div class="li-sub">
                    {{ $cita->servicios->pluck('nombre')->join(', ') ?: '—' }}
                  </div>
                </div>
                <span class="badge badge--gold">
                  {{ \Carbon\Carbon::parse($cita->hora_cita)->format('H:i') }}
                </span>
              </div>
              @empty
              <div style="text-align:center;padding:24px;color:var(--muted);font-size:13px;">
                No tienes citas para hoy.
              </div>
              @endforelse
            </div>
          </div>
        </div>
      </div>

      <!-- VER PERFIL -->
      <div class="panel" id="panel-profile-view">
        <div class="profile-hero">
          <div class="avatar-lg">{{ substr(auth()->user()->nombre ?? 'B', 0, 1) }}
            <div class="avatar-overlay"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                <circle cx="12" cy="13" r="4" />
              </svg></div>
          </div>
          <div class="profile-info">
            <div class="profile-name">{{ auth()->user()->nombre ?? 'Barbero' }}</div>
            <div class="profile-email">{{ auth()->user()->email ?? 'barbero@barberos.com' }}</div>
            <div class="profile-tags"><span class="profile-tag">Barbero</span><span
                class="profile-tag">{{ auth()->user()->specialty ?? 'Fade & Barba' }}</span><span
                class="profile-tag">Activo</span></div>
          </div>
        </div>
        <div class="two-col">
          <div class="card">
            <div class="card-hd"><span class="card-hd-title">Información</span></div>
            <div class="card-body">
              <div class="list-item">
                <div class="li-info">
                  <div class="li-name">Nombre</div>
                  <div class="li-sub">{{ auth()->user()->nombre }}</div>
                </div>
              </div>
              <div class="list-item">
                <div class="li-info">
                  <div class="li-name">Correo</div>
                  <div class="li-sub">{{ auth()->user()->email }}</div>
                </div>
              </div>
              <div class="list-item">
                <div class="li-info">
                  <div class="li-name">Especialidad</div>
                  <div class="li-sub">{{ auth()->user()->specialty ?? 'Fade & Barba' }}</div>
                </div>
              </div>
              <div class="list-item">
                <div class="li-info">
                  <div class="li-name">Teléfono</div>
                  <div class="li-sub">{{ auth()->user()->phone ?? '+57 300 000 0000' }}</div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-hd"><span class="card-hd-title">Acciones</span></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:10px;padding-top:20px;">
              <button class="btn-gold" onclick="showPanel('profile-edit')" style="width:100%;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Editar Perfil
              </button>
              <button class="btn-outline" onclick="showPanel('change-pass')" style="width:100%;">Cambiar
                Contraseña</button>
            </div>
          </div>
        </div>
      </div>

      <!-- EDITAR PERFIL -->
      <div class="panel" id="panel-profile-edit">
        <div class="profile-hero" style="margin-bottom:24px;">
          <div class="avatar-lg" onclick="document.getElementById('avatarInput').click()">
            @if(auth()->user()->foto)
            <img src="{{ asset('storage/' . auth()->user()->foto) }}"
              style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
            @else
            {{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}
            @endif
            <div class="avatar-overlay"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                <circle cx="12" cy="13" r="4" />
              </svg></div>
            <input type="file" id="avatarInput" accept="image/*" style="display:none" onchange="previewAvatar(event)">
          </div>
          <div class="profile-info">
            <div class="profile-name">Editar Perfil</div>
            <div class="profile-email">Toca la foto para cambiarla</div>
          </div>
        </div>
        <div class="card">
          <div class="card-hd"><span class="card-hd-title">Datos Personales</span></div>
          <div class="card-body">
            <form action="{{ route('barber.profile.update') }}" method="POST" enctype="multipart/form-data">
              @csrf @method('PUT')
              <div class="form-grid" style="gap:16px;">
                <div class="field-wrap"><label class="field-lbl">Nombre</label>
                  <div class="field-box"><input type="text" name="name" value="{{ auth()->user()->nombre }}"
                      placeholder="Tu nombre completo"></div>
                </div>
                <div class="field-wrap"><label class="field-lbl">Correo</label>
                  <div class="field-box"><input type="email" name="email" value="{{ auth()->user()->email }}"></div>
                </div>
                <div class="field-wrap"><label class="field-lbl">Teléfono</label>
                  <div class="field-box"><input type="tel" name="phone" value="{{ auth()->user()->phone }}"
                      placeholder="+57 300 000 0000"></div>
                </div>
                <div class="field-wrap"><label class="field-lbl">Especialidad</label>
                  <div class="field-box"><select name="specialty">
                      <option>Fade & Barba</option>
                      <option>Corte Clásico</option>
                      <option>Diseño y Coloración</option>
                      <option>Moderno</option>
                    </select></div>
                </div>
                <div class="field-wrap form-full"><label class="field-lbl">Descripción</label><textarea class="field-ta"
                    name="bio" placeholder="Tu experiencia y habilidades...">{{ auth()->user()->bio }}</textarea></div>
                <div class="field-wrap form-full"><label class="field-lbl">Foto de Perfil</label>
                  <div class="field-box"><input type="file" name="avatar" accept="image/*"></div>
                </div>
              </div>
              <div class="form-actions" style="margin-top:20px;">
                <button type="submit" class="btn-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                    <polyline points="17 21 17 13 7 13 7 21" />
                  </svg>Guardar</button>
                <button type="button" class="btn-outline" onclick="showPanel('profile-view')">Cancelar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- CAMBIAR CONTRASEÑA -->
      <div class="panel" id="panel-change-pass">
        <div class="card" style="max-width:480px;margin:0 auto;">
          <div class="card-hd"><span class="card-hd-title">Cambiar Contraseña</span></div>
          <div class="card-body">
            <form action="{{ route('barber.password.update') }}" method="POST">
              @csrf @method('PUT')
              <div style="display:flex;flex-direction:column;gap:14px;">
                <div class="field-wrap"><label class="field-lbl">Contraseña Actual</label>
                  <div class="field-box"><svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                      stroke-width="2">
                      <rect x="3" y="11" width="18" height="11" rx="2" />
                      <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg><input type="password" name="current_password" placeholder="••••••••" id="cp1"><button
                      type="button" class="eye-btn" onclick="togglePwd('cp1')"><svg viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                      </svg></button></div>
                </div>
                <div class="field-wrap"><label class="field-lbl">Nueva Contraseña</label>
                  <div class="field-box"><svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                      stroke-width="2">
                      <rect x="3" y="11" width="18" height="11" rx="2" />
                      <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg><input type="password" name="password" placeholder="••••••••" id="cp2"
                      oninput="checkStrength(this.value)"><button type="button" class="eye-btn"
                      onclick="togglePwd('cp2')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                      </svg></button></div>
                  <div class="strength-bar">
                    <div class="strength-fill" id="strBar"></div>
                  </div>
                  <div class="strength-text" id="strText"></div>
                </div>
                <div class="field-wrap"><label class="field-lbl">Confirmar</label>
                  <div class="field-box"><svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                      stroke-width="2">
                      <rect x="3" y="11" width="18" height="11" rx="2" />
                      <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg><input type="password" name="password_confirmation" placeholder="••••••••" id="cp3"
                      oninput="checkMatch()"><button type="button" class="eye-btn" onclick="togglePwd('cp3')"><svg
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                      </svg></button></div>
                  <div class="match-msg" id="matchMsg"></div>
                </div>
                <button type="submit" class="btn-gold">Actualizar Contraseña</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- MURO -->
      <div class="panel" id="panel-posts-wall">
        <div style="margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;">
          <div>
            <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Muro de Publicaciones
            </div>
            <div style="font-size:13px;color:var(--muted2);">Últimas publicaciones de la barbería</div>
          </div>
          <button class="btn-gold" onclick="showPanel('post-create')">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10" />
              <line x1="12" y1="8" x2="12" y2="16" />
              <line x1="8" y1="12" x2="16" y2="12" />
            </svg>
            Publicar
          </button>
        </div>
        <div class="posts-list">
          @forelse($posts ?? [] as $post)
          <div class="post-card">
            <div class="post-head">
              <div class="li-avatar">
                {{ strtoupper(substr($post->muro->usuario->nombre ?? 'A', 0, 1)) }}
              </div>
              <div class="post-meta">
                <div class="post-author">{{ $post->muro->usuario->nombre ?? 'Admin' }}</div>
                <div class="post-time">{{ \Carbon\Carbon::parse($post->fecha)->diffForHumans() }}</div>
              </div>

              {{-- Botones editar y eliminar --}}
              <div style="display:flex;gap:8px;margin-left:auto;">
                @php
                $miMuro = auth()->user()->muro?->id_muro;
                @endphp
                @if($post->id_muro === $miMuro)

                {{-- Editar --}}
                <button type="button" title="Editar"
                  onclick='abrirEditar({{ $post->id_publicacion }}, @json($post->contenido))'
                  style="background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);
               border-radius:8px;padding:6px 10px;cursor:pointer;color:var(--gold);
               display:flex;align-items:center;gap:6px;font-size:12px;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                  </svg>
                  Editar
                </button>

                {{-- Eliminar --}}
                <form action="{{ route('posts.destroy', $post->id_publicacion) }}" method="POST">
                  @csrf @method('DELETE')
                  <button class="post-del" type="submit" title="Eliminar"
                    onclick="return confirm('¿Eliminar esta publicación?')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="3 6 5 6 21 6" />
                      <path d="M19 6l-1 14H6L5 6" />
                      <path d="M10 11v6M14 11v6" />
                      <path d="M9 6V4h6v2" />
                    </svg>
                  </button>
                </form>

                @endif
              </div>
            </div>

            {{-- Imágenes de la publicación --}}
            @foreach($post->imagenes as $img)
            <img src="{{ asset('storage/' . $img->imagen) }}" alt="Imagen" class="post-img">
            @endforeach

            <div class="post-body">
              <p class="post-text">{{ $post->contenido }}</p>
            </div>

            <div class="post-footer">
              <button class="post-action">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path
                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                </svg> 0
              </button>
              <button class="post-action">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                </svg> 0
              </button>
            </div>
          </div>
          @empty

          @endforelse
        </div>
      </div>
      <div id="modalEditar" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.75);
              z-index:9999;align-items:center;justify-content:center;">
        <div style="background:var(--surface);border-radius:16px;padding:28px;
                    width:100%;max-width:500px;margin:0 16px;
                    border:1px solid rgba(255,255,255,.08);box-shadow:0 20px 60px rgba(0,0,0,.5);">

          <div style="font-family:'Bebas Neue',sans-serif;font-size:20px;
                        letter-spacing:2px;margin-bottom:16px;color:var(--gold);">
            Editar Publicación
          </div>

          <form id="formEditar" method="POST">
            @csrf
            @method('PUT')
            <div class="field-wrap" style="margin-bottom:16px;">
              <label class="field-lbl">Contenido</label>
              <textarea id="editContenido" name="contenido" class="field-ta"
                style="min-height:120px;width:100%;"></textarea>
            </div>
            <div style="display:flex;gap:10px;justify-content:flex-end;">
              <button type="button" class="btn-outline" onclick="cerrarEditar()">Cancelar</button>
              <button type="submit" class="btn-gold">Guardar</button>
            </div>
          </form>
        </div>
      </div>

      <!-- NUEVA PUBLICACIÓN -->
      <div class="panel" id="panel-post-create">
        <div style="margin-bottom:20px;">
          <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Nueva Publicación</div>
        </div>
        <div class="card" style="max-width:600px;">
          <div class="card-body" style="padding:24px;">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div style="display:flex;flex-direction:column;gap:16px;">
                <div class="field-wrap"><label class="field-lbl">Contenido</label><textarea class="field-ta"
                    name="content" placeholder="¿Qué quieres compartir?" style="min-height:120px;"></textarea></div>
                <div class="field-wrap">
                  <label class="field-lbl">Imagen (opcional)</label>
                  <label class="upload-btn" style="height:48px;border-radius:var(--radius);justify-content:center;"><svg
                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <rect x="3" y="3" width="18" height="18" rx="2" />
                      <circle cx="8.5" cy="8.5" r="1.5" />
                      <polyline points="21 15 16 10 5 21" />
                    </svg>Seleccionar imagen<input type="file" name="image" accept="image/*"
                      onchange="previewPost(event)"></label>
                  <div class="post-preview-img" id="postPreview"><img id="postPreviewImg" src="" alt=""></div>
                </div>
                <div class="form-actions"><button type="submit" class="btn-gold"><svg viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2">
                      <line x1="22" y1="2" x2="11" y2="13" />
                      <polygon points="22 2 15 22 11 13 2 9 22 2" />
                    </svg>Publicar</button><button type="button" class="btn-outline"
                    onclick="showPanel('posts-wall')">Cancelar</button></div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- LISTA BARBEROS (solo lectura para barbero) -->
      <div class="panel" id="panel-barbers-list">
        <div
          style="margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
          <div>
            <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Equipo de Barberos
            </div>
            <div style="font-size:13px;color:var(--muted2);">Conoce a tus compañeros</div>
          </div>
          <div class="search-box" style="max-width:240px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="2">
              <circle cx="11" cy="11" r="8" />
              <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg><input type="text" placeholder="Buscar..."></div>
        </div>
        <div class="barbers-grid">
          @forelse($barbers ?? [] as $barber)
          <div class="barber-card">
            <div class="barber-card-top">
              <div class="barber-avatar">@if($barber->avatar)<img src="{{ asset('storage/' . $barber->avatar) }}"
                  alt="">@else{{ substr($barber->nombre, 0, 1) }}@endif</div>
              <div>
                <div class="barber-name">{{ $barber->nombre }}</div>
                <div class="barber-spec">{{ $barber->specialty ?? 'Barbero' }}</div><span
                  class="badge {{ $barber->active ? 'badge--green' : 'badge--red' }}">{{ $barber->active ? 'Activo' : 'Inactivo' }}</span>
              </div>
            </div>
            <div class="barber-stats">
              <div class="barber-stat">
                <div class="barber-stat-val">{{ $barber->appointments_count ?? 0 }}</div>
                <div class="barber-stat-lbl">Citas</div>
              </div>
              <div class="barber-stat">
                <div class="barber-stat-val">{{ $barber->rating ?? '5.0' }}</div>
                <div class="barber-stat-lbl">Rating</div>
              </div>
            </div>
          </div>
          @empty
          @foreach([['Pedro G.', 'Fade & Barba', true, 28, '4.9'], ['Luis M.', 'Clásico', true, 15, '4.7'], ['Andrés C.', 'Diseño', false, 5, '4.5'], ['Camilo R.', 'Moderno', true, 32, '5.0']] as $b)
          <div class="barber-card">
            <div class="barber-card-top">
              <div class="barber-avatar">{{ substr($b[0], 0, 1) }}</div>
              <div>
                <div class="barber-name">{{ $b[0] }}</div>
                <div class="barber-spec">{{ $b[1] }}</div><span
                  class="badge {{ $b[2] ? 'badge--green' : 'badge--red' }}">{{ $b[2] ? 'Activo' : 'Inactivo' }}</span>
              </div>
            </div>
            <div class="barber-stats">
              <div class="barber-stat">
                <div class="barber-stat-val">{{ $b[3] }}</div>
                <div class="barber-stat-lbl">Citas</div>
              </div>
              <div class="barber-stat">
                <div class="barber-stat-val">{{ $b[4] }}</div>
                <div class="barber-stat-lbl">Rating</div>
              </div>
            </div>
          </div>
          @endforeach
          @endforelse
        </div>
      </div>

      <!-- MI AGENDA -->
      <div class="panel" id="panel-agenda">

        {{-- Encabezado --}}
        <div class="agenda-controls" style="flex-wrap:wrap;gap:12px;margin-bottom:20px;">
          <div style="flex:1;min-width:180px;">
            <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Mi Agenda</div>
            <div style="font-size:13px;color:var(--muted2);">
              Semana del {{ $inicioSemana->format('d M') }} al {{ $finSemana->format('d M Y') }}
            </div>
          </div>

          {{-- Filtro por fecha --}}
          <form method="GET" action="{{ route('barber.agenda') }}"
            style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
            <div class="field-box" style="width:auto;">
              <input type="hidden" name="panel" value="agenda">
              <input type="date" name="fecha" value="{{ $fechaFiltro->toDateString() }}"
                style="background:transparent;border:none;color:var(--text);font-size:13px;outline:none;">
            </div>
            <button type="submit" class="btn-gold" style="height:36px;padding:0 14px;font-size:12px;">
              Filtrar
            </button>
          </form>

          {{-- Navegación semana --}}
          <div class="week-nav">
            <a href="{{ route('barber.agenda', [
  'semana' => $inicioSemana->copy()->subWeek()->toDateString(),
  'panel' => 'agenda'
]) }}" class="week-nav-btn">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6" />
              </svg>
            </a>
            <span class="week-label">
              {{ $inicioSemana->isSameWeek(now()) ? 'Esta semana' : $inicioSemana->format('d M') }}
            </span>
            <a href="{{ route('barber.agenda', [
  'semana' => $inicioSemana->copy()->addWeek()->toDateString(),
  'panel' => 'agenda'
]) }}" class="week-nav-btn">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="9 18 15 12 9 6" />
              </svg>
            </a>
          </div>
        </div>

        {{-- Grid semanal --}}
        <div class="schedule-grid">
          @php
          $diasSemana = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
          @endphp

          @foreach($diasSemana as $i => $nombreDia)
          @php
          $fecha = $inicioSemana->copy()->addDays($i);
          $fechaKey = $fecha->toDateString();
          $esHoy = $fecha->isToday();
          $citasDia = $citasSemana[$fechaKey] ?? collect();
          @endphp

          <div class="day-col {{ $esHoy ? 'today' : '' }}">
            <div class="day-hd">
              <div class="day-name">{{ $nombreDia }}</div>
              <div class="day-num">{{ $fecha->day }}</div>
            </div>

            @forelse($citasDia as $cita)
            @php
            $badgeClass = match (strtolower($cita->estado)) {
            'confirmada' => 'slot--booked',
            'cancelada' => 'slot--cancel',
            default => 'slot--pending',
            };
            @endphp
            <div class="slot {{ $badgeClass }}" title="{{ $cita->cliente->nombre ?? '' }} — {{ $cita->estado }}">
              <div class="slot-time">
                {{ \Carbon\Carbon::parse($cita->hora_cita)->format('H:i') }}
              </div>
              <div class="slot-name">
                {{ \Illuminate\Support\Str::words($cita->cliente->nombre ?? '?', 1, '') }}
              </div>
            </div>
            @empty
            {{-- Día sin citas: no muestra nada (columna vacía) --}}
            @endforelse
          </div>
          @endforeach
        </div>

        {{-- ─── Lista detallada del día filtrado ─── --}}
        <div style="font-family:'Bebas Neue',sans-serif;font-size:18px;letter-spacing:1px;
              margin:24px 0 14px;">
          Citas del {{ $fechaFiltro->isoFormat('dddd D [de] MMMM') }}
        </div>

        @if(session('success'))
        <div style="background:rgba(80,200,120,0.1);border:1px solid var(--green);
                              border-radius:8px;padding:10px 14px;font-size:13px;
                              color:var(--green);margin-bottom:14px;">
          {{ session('success') }}
        </div>
        @endif

        <div class="appt-list">
          @forelse($citasDelDia as $cita)
          <div class="appt-item">

            {{-- Hora --}}
            <div class="appt-time">
              {{ \Carbon\Carbon::parse($cita->hora_cita)->format('H:i') }}
            </div>

            {{-- Cliente + servicios --}}
            <div class="appt-info">
              <div class="appt-client">{{ $cita->cliente->nombre ?? 'Cliente' }}</div>
              <div class="appt-service">
                {{ $cita->servicios->pluck('nombre')->join(', ') ?: '—' }}
              </div>
            </div>

            {{-- Estado badge --}}
            <div class="appt-dur" style="display:flex;flex-direction:column;align-items:flex-end;gap:6px;">
              @php
              $estadoClass = match (strtolower($cita->estado)) {
              'confirmada' => 'badge--green',
              'cancelada' => 'badge--red',
              default => 'badge--gold', // pendiente
              };
              @endphp
              <span class="badge {{ $estadoClass }}">{{ ucfirst($cita->estado) }}</span>

              {{-- Acciones --}}
              @if(strtolower($cita->estado) !== 'cancelada')
              <div style="display:flex;gap:6px;flex-wrap:wrap;justify-content:flex-end;">
                <button type="button"
                  class="btn-outline"
                  style="height:28px;padding:0 10px;font-size:11px;"
                  onclick="abrirModalReprogramar(
                    '{{ $cita->id_cita }}',
                    '{{ addslashes($cita->cliente->nombre ?? 'Cliente') }}',
                    '{{ \Carbon\Carbon::parse($cita->hora_cita)->format('Y-m-d\TH:i') }}',
                    '{{ route('barber.citas.reprogramar', $cita->id_cita) }}'
                  )">
                  Reprogramar
                </button>
                {{-- Confirmar --}}
                @if(strtolower($cita->estado) === 'pendiente')
                <form method="POST" action="{{ route('barber.citas.estado', $cita->id_cita) }}">
                  @csrf @method('PATCH')
                  <input type="hidden" name="estado" value="Confirmada">
                  <button type="submit" class="btn-gold" style="height:28px;padding:0 10px;font-size:11px;">
                    Confirmar
                  </button>
                </form>
                @endif

                {{-- Cancelar --}}
                <form method="POST" action="{{ route('barber.citas.cancelar', $cita->id_cita) }}"
                  onsubmit="return confirm('¿Cancelar esta cita?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn-outline" style="height:28px;padding:0 10px;font-size:11px;
                                                           border-color:var(--red,#e55);color:var(--red,#e55);">
                    Cancelar
                  </button>
                </form>

              </div>
              @endif
            </div>

          </div>
          @empty
          <div style="text-align:center;padding:32px;color:var(--muted);font-size:13px;">
            No hay citas para este día.
          </div>
          @endforelse
        </div>

      </div>

      <!-- MI HORARIO -->
      <div class="panel" id="panel-my-schedule">
        <div style="margin-bottom:20px;">
          <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Mi Horario</div>
          <div style="font-size:13px;color:var(--muted2);">Consulta tu disponibilidad semanal</div>
        </div>
        <div class="my-schedule">
          <div class="card-hd-title">Horario Asignado por el Admin</div>
          <div class="hours-grid">
            @foreach(['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'] as $day)
            <div class="hour-day">
              <div class="hour-label">{{ $day }}</div>
              <div
                style="background:var(--surface3);border-radius:8px;padding:6px;text-align:center;font-size:11px;color:var(--gold);">
                08:00</div>
              <div
                style="background:var(--surface3);border-radius:8px;padding:6px;text-align:center;font-size:11px;color:var(--muted2);">
                18:00</div>
              <div style="font-size:10px;color:var(--green);text-align:center;margin-top:2px;">✓ Activo</div>
            </div>
            @endforeach
          </div>
          <div
            style="margin-top:16px;padding:12px;background:rgba(201,168,76,0.05);border:0.5px dashed rgba(201,168,76,0.25);border-radius:10px;font-size:12px;color:var(--muted);text-align:center;">
            Para modificar tu horario, contacta al administrador.
          </div>
        </div>
      </div>

      <!-- ESTADO LOCAL (lectura) -->
      <div class="panel" id="panel-barberia">
        <div style="margin-bottom:20px;">
          <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Estado del Local</div>
          <div style="font-size:13px;color:var(--muted2);">Información del estado actual de la barbería</div>
        </div>
        <div class="card" style="max-width:500px;">
          <div class="card-hd"><span class="card-hd-title">Estado Actual</span></div>
          <div class="card-body">
            <div class="shop-status shop-status--open">
              <div class="status-dot status-dot--open"></div>
              <div>
                <div class="status-text--open" style="font-size:15px;">BARBERÍA ABIERTA</div>
                <div style="font-size:12px;color:var(--muted);">Desde las 8:00 AM • Cierra 8:00 PM</div>
              </div>
            </div>
            <div style="margin-top:16px;display:flex;flex-direction:column;gap:10px;">
              @foreach([['Lunes – Viernes', '8:00 AM – 8:00 PM'], ['Sábado', '9:00 AM – 6:00 PM'], ['Domingo', 'Cerrado']] as $h)
              <div class="list-item">
                <div class="li-info">
                  <div class="li-name">{{ $h[0] }}</div>
                  <div class="li-sub">{{ $h[1] }}</div>
                </div>@if($h[1] == 'Cerrado')<span class="badge badge--red">Cerrado</span>@else<span
                  class="badge badge--green">Abierto</span>@endif
              </div>
              @endforeach
            </div>
            <div
              style="margin-top:14px;padding:10px 14px;background:rgba(74,144,226,0.06);border:0.5px solid rgba(74,144,226,0.2);border-radius:10px;font-size:12px;color:var(--blue);text-align:center;">
              Solo el administrador puede abrir o cerrar la barbería.
            </div>
          </div>
        </div>
      </div>
      <div class="panel" id="panel-atender">

        <div style="margin-bottom:20px;">
          <div style="font-family:'Bebas Neue';font-size:24px;">Atender Citas</div>
          <div style="font-size:13px;color:var(--muted2);">
            Citas confirmadas del día
          </div>
        </div>

        <div class="appt-list">
          @forelse($citasSinAtender as $cita)
          @php
          $total = $cita->servicios->sum('precio');
          @endphp

          <div class="appt-item">

            <div class="appt-time">
              {{ \Carbon\Carbon::parse($cita->hora_cita)->format('H:i') }}
            </div>

            <div class="appt-info">
              <div class="appt-client">{{ $cita->cliente->nombre }}</div>
              <div class="appt-service">
                {{ $cita->servicios->pluck('nombre')->join(', ') }}
              </div>
            </div>

            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:6px;">

              <div style="font-weight:bold;color:var(--gold);">
                ${{ number_format($total, 0) }}
              </div>

              <form method="POST" action="{{ route('barber.atender.completar', $cita->id_cita) }}">
                @csrf

                <select name="metodo" style="margin-bottom:6px;">
                  <option value="Efectivo">Efectivo</option>
                  <option value="Tarjeta">Tarjeta</option>
                  <option value="Transferencia">Transferencia</option>
                </select>

                <button type="submit" class="btn-gold" style="height:30px;font-size:12px;">
                  Atender y cobrar
                </button>
              </form>

            </div>

          </div>

          @empty
          <div style="text-align:center;padding:30px;color:var(--muted);">
            No hay citas para atender
          </div>
          @endforelse
        </div>

      </div>
      <div class="panel" id="panel-fila-barbero">
        <div style="margin-bottom:20px;">
          <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">
            Fila de Espera
          </div>
          <div style="font-size:13px;color:var(--muted2);">
            Gestiona los turnos y registra la atención
          </div>
        </div>

        @if(session('success'))
        <div style="background:rgba(80,200,120,0.1);border:1px solid var(--green);
                border-radius:8px;padding:10px 14px;font-size:13px;
                color:var(--green);margin-bottom:14px;">
          {{ session('success') }}
        </div>
        @endif

        @php
        $filaActiva = \App\Models\ConfiguracionFila::vigente();
        $turnos = \App\Models\FilaEspera::with(['cliente.usuario','servicios'])
        ->whereIn('estado',['esperando','asignado','en_atencion'])
        ->orderBy('posicion')->get();
        @endphp

        @if(!$filaActiva)
        <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);
                border-radius:12px;padding:24px;text-align:center;color:var(--muted2);margin-bottom:20px;">
          La fila de espera no está activa en este momento.
        </div>
        @endif

        <div class="appt-list">
          @forelse($turnos as $turno)
          @php $total = $turno->servicios->sum('precio'); @endphp

          <div class="appt-item">

            {{-- Posición --}}
            <div class="appt-time" style="font-family:'Bebas Neue';font-size:24px;color:var(--gold);min-width:36px;">
              #{{ $turno->posicion }}
            </div>

            {{-- Info cliente --}}
            <div class="appt-info">
              <div class="appt-client">{{ $turno->cliente->usuario->nombre ?? '—' }}</div>
              <div class="appt-service">
                {{ $turno->servicios->pluck('nombre')->join(', ') }}
              </div>
              <div style="font-size:11px;color:var(--muted2);margin-top:2px;">
                Esperando desde {{ $turno->created_at->format('H:i') }}
              </div>
            </div>

            {{-- Acciones según estado --}}
            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:6px;">

              <span class="badge {{ match($turno->estado) {
                    'en_atencion' => 'badge--green',
                    'asignado'    => 'badge-gold',
                    default       => 'badge--gold'
                } }}">{{ ucfirst(str_replace('_',' ',$turno->estado)) }}</span>

              <div style="font-size:12px;color:var(--gold);">
                ${{ number_format($total, 0, ',', '.') }}
              </div>

              <div style="display:flex;gap:6px;flex-wrap:wrap;justify-content:flex-end;">

                {{-- Iniciar atención --}}
                @if(in_array($turno->estado, ['esperando','asignado']))
                <form method="POST" action="{{ route('barber.fila.iniciar', $turno->id_turno) }}">
                  @csrf
                  <button type="submit" class="btn-gold" style="height:30px;padding:0 12px;font-size:12px;">
                    Iniciar
                  </button>
                </form>
                @endif

                {{-- Finalizar + pago --}}
                @if($turno->estado === 'en_atencion')
                <form method="POST" action="{{ route('barber.fila.finalizar', $turno->id_turno) }}"
                  style="display:flex;gap:6px;align-items:center;flex-wrap:wrap;">
                  @csrf
                  <select name="metodo_pago"
                    style="height:30px;font-size:12px;background:var(--surface3);
                                   border:1px solid var(--border2);border-radius:8px;
                                   color:var(--text);padding:0 8px;">
                    <option value="Efectivo">Efectivo</option>
                    <option value="Tarjeta">Tarjeta</option>
                    <option value="Transferencia">Transferencia</option>
                  </select>
                  <button type="submit" class="btn-gold" style="height:30px;padding:0 12px;font-size:12px;">
                    Finalizar y cobrar
                  </button>
                </form>
                @endif

                {{-- Cancelar (no se presentó) --}}
                @if($turno->estado !== 'en_atencion')
                <form method="POST" action="{{ route('barber.fila.cancelar', $turno->id_turno) }}"
                  onsubmit="return confirm('¿Marcar como no presentado?')">
                  @csrf
                  <button type="submit" class="btn-outline"
                    style="height:30px;padding:0 10px;font-size:11px;
                                   border-color:rgba(239,68,68,.4);color:#f87171;">
                    No se presentó
                  </button>
                </form>
                @endif

              </div>
            </div>
          </div>
          @empty
          <div style="text-align:center;padding:40px;color:var(--muted);font-size:13px;">
            La fila está vacía en este momento.
          </div>
          @endforelse
        </div>
      </div>
      <div class="panel" id="panel-services-list">

        <div style="margin-bottom:20px;">
          <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">
            Servicios de la Barbería
          </div>
          <div style="font-size:13px;color:var(--muted2);">
            Lista de servicios disponibles
          </div>
        </div>

        <div class="card">
          <div class="card-body" style="padding:24px;">
            @forelse($servicios ?? [] as $servicio)
            <div class="list-item" style="align-items:flex-start; gap:14px;">
              <div class="li-avatar">
                {{ substr($servicio->nombre, 0, 1) }}
              </div>
              <div class="li-info" style="flex:1;">
                <div class="li-name">
                  {{ $servicio->nombre }}
                </div>
                <div class="li-sub">
                  {{ $servicio->descripcion }}
                </div>
                <div style="margin-top:6px; font-size:12px; color:var(--muted2); display:flex; gap:10px;">
                  <span>{{ $servicio->duracion }} min</span>
                  <span>${{ number_format($servicio->precio, 0, ',', '.') }}</span>
                </div>
              </div>
              {{-- acciones --}}
              <div style="display:flex;flex-direction:column;gap:6px;">
                <button class="btn-outline" style="padding:6px 10px;font-size:12px;">
                  Editar
                </button>
                <form action="{{ route('admin.services.destroy', $servicio->id_servicio) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn-outline" style="padding:6px 10px;font-size:12px;color:#ff5c5c;">
                    Eliminar
                  </button>
                </form>
              </div>
            </div>
            <hr style="opacity:.1;margin:12px 0;">
            @empty
            <div style="text-align:center;color:var(--muted2);padding:20px;">
              No hay servicios registrados aún
            </div>
            @endforelse
          </div>
        </div>
      </div>
      <div class="panel" id="panel-service-register">
        <div style="margin-bottom:20px;">
          <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">
            Registrar Servicio
          </div>
          <div style="font-size:13px;color:var(--muted2);">
            Crea un nuevo servicio para la barbería
          </div>
        </div>

        <div class="card" style="max-width:600px;">
          <div class="card-body" style="padding:24px;">

            <form action="{{ route('barber.services.store') }}" method="POST">
              @csrf

              <div class="form-grid" style="gap:16px;">

                {{-- Nombre --}}
                <div class="field-wrap">
                  <label class="field-lbl">Nombre del Servicio</label>
                  <div class="field-box">
                    <input type="text" name="nombre" placeholder="Ej: Corte + Barba" required>
                  </div>
                </div>

                {{-- Precio --}}
                <div class="field-wrap">
                  <label class="field-lbl">Precio</label>
                  <div class="field-box">
                    <input type="number" name="precio" placeholder="Ej: 25000" required>
                  </div>
                </div>

                {{-- Duración --}}
                <div class="field-wrap">
                  <label class="field-lbl">Duración (minutos)</label>
                  <div class="field-box">
                    <input type="number" name="duracion" placeholder="Ej: 45" required>
                  </div>
                </div>

                {{-- Descripción --}}
                <div class="field-wrap form-full">
                  <label class="field-lbl">Descripción</label>
                  <textarea class="field-ta" name="descripcion" placeholder="Detalles del servicio..."></textarea>
                </div>

              </div>

              <div class="form-actions" style="margin-top:20px;">
                <button type="submit" class="btn-gold">
                  Guardar Servicio
                </button>

                <button type="button" class="btn-outline"
                  onclick="showPanel('welcome')">
                  Cancelar
                </button>
              </div>

            </form>

          </div>
        </div>
      </div>
      <div class="panel" id="panel-almuerzo">
        <div style="margin-bottom:20px;">
          <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">
            Bloque de Almuerzo
          </div>
          <div style="font-size:13px;color:var(--muted2);">
            Reserva tu hora de comida (12:00 – 14:00)
          </div>
        </div>
        @if(session('success'))
        <div style="background:rgba(80,200,120,0.1);border:1px solid var(--green);
              border-radius:8px;padding:10px 14px;font-size:13px;
              color:var(--green);margin-bottom:14px;">
          {{ session('success') }}
        </div>
        @endif
        @if(isset($bloqueHoy) && $bloqueHoy)
        <div style="background:rgba(201,168,76,0.08);border:1px solid rgba(201,168,76,0.3);
              border-radius:12px;padding:16px 20px;margin-bottom:20px;
              display:flex;align-items:center;gap:14px;">
          <svg viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="2" width="22" height="22">
            <circle cx="12" cy="12" r="10" />
            <polyline points="12 6 12 12 16 14" />
          </svg>
          <div>
            <div style="font-size:13px;color:var(--gold);font-weight:500;">Almuerzo registrado hoy</div>
            <div style="font-size:12px;color:var(--muted2);">
              {{ $bloqueHoy->hora_inicio }} – {{ $bloqueHoy->hora_fin }}
              @if($bloqueHoy->automatico)
              <span style="margin-left:6px;background:rgba(201,168,76,0.15);
                       color:var(--gold);font-size:10px;padding:2px 6px;border-radius:20px;">
                Asignado automáticamente
              </span>
              @endif
            </div>
          </div>
        </div>
        @endif
        <div class="card" style="max-width:480px;">
          <div class="card-hd"><span class="card-hd-title">Seleccionar bloque</span></div>
          <div class="card-body" style="padding:24px;">
            <form action="{{ route('barber.almuerzo.store') }}" method="POST"
              style="display:flex;flex-direction:column;gap:16px;">
              @csrf
              <div class="field-wrap">
                <label class="field-lbl">Fecha</label>
                <div class="field-box">
                  <input type="date" name="fecha"
                    value="{{ today()->toDateString() }}"
                    min="{{ today()->toDateString() }}"
                    required>
                </div>
              </div>

              {{-- Selector visual de horario — Criterio 1 --}}
              <div class="field-wrap">
                <label class="field-lbl">Hora de almuerzo</label>
                <div style="display:flex;gap:10px;margin-top:6px;">

                  <label style="flex:1;cursor:pointer;">
                    <input type="radio" name="hora_inicio" value="12:00" required
                      style="display:none;" id="bloque12"
                      onchange="marcarBloque(this)">
                    <div class="bloque-option" id="opt-12"
                      style="border:1px solid var(--border2);border-radius:10px;
                       padding:14px;text-align:center;transition:all .2s;">
                      <div style="font-family:'Bebas Neue';font-size:20px;letter-spacing:1px;">
                        12:00
                      </div>
                      <div style="font-size:11px;color:var(--muted2);">hasta 13:00</div>
                    </div>
                  </label>

                  <label style="flex:1;cursor:pointer;">
                    <input type="radio" name="hora_inicio" value="13:00"
                      style="display:none;" id="bloque13"
                      onchange="marcarBloque(this)">
                    <div class="bloque-option" id="opt-13"
                      style="border:1px solid var(--border2);border-radius:10px;
                       padding:14px;text-align:center;transition:all .2s;">
                      <div style="font-family:'Bebas Neue';font-size:20px;letter-spacing:1px;">
                        13:00
                      </div>
                      <div style="font-size:11px;color:var(--muted2);">hasta 14:00</div>
                    </div>
                  </label>

                </div>
                @error('hora_inicio')
                <div style="font-size:11px;color:var(--red,#e55);margin-top:4px;">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="form-actions">
                <button type="submit" class="btn-gold">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" width="15" height="15">
                    <polyline points="20 6 9 17 4 12" />
                  </svg>
                  Guardar bloque
                </button>
              </div>

            </form>
          </div>
        </div>
      </div>
      <div class="panel" id="panel-novedades">
        <div style="margin-bottom:20px;">
          <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">
            Novedades de Disponibilidad
          </div>
          <div style="font-size:13px;color:var(--muted2);">
            Registra inasistencias o cancelaciones anticipadas
          </div>
        </div>

        @if(session('success'))
        <div style="background:rgba(80,200,120,0.1);border:1px solid var(--green);
              border-radius:8px;padding:10px 14px;font-size:13px;
              color:var(--green);margin-bottom:14px;">
          {{ session('success') }}
        </div>
        @endif
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start;flex-wrap:wrap;">
          <div class="card" style="min-width:280px;">
            <div class="card-hd"><span class="card-hd-title">Nueva novedad</span></div>
            <div class="card-body" style="padding:24px;">
              <form action="{{ route('barber.novedades.store') }}" method="POST"
                style="display:flex;flex-direction:column;gap:14px;">
                @csrf
                <div class="field-wrap">
                  <label class="field-lbl">Fecha afectada</label>
                  <div class="field-box">
                    <input type="date" name="fecha"
                      value="{{ today()->toDateString() }}" required>
                  </div>
                </div>
                <div class="field-wrap">
                  <label class="field-lbl">Tipo de novedad</label>
                  <div class="field-box">
                    <select name="tipo" required onchange="toggleHoraAfectada(this.value)">
                      <option value="">Seleccionar…</option>
                      <option value="inasistencia">Inasistencia (día completo)</option>
                      <option value="cancelacion_anticipada">Cancelación anticipada</option>
                      <option value="otro">Otro</option>
                    </select>
                  </div>
                </div>
                <div class="field-wrap" id="wrap-hora-afectada" style="display:none;">
                  <label class="field-lbl">Hora de la cita a cancelar</label>
                  <div class="field-box">
                    <input type="time" name="hora_afectada" step="1800">
                  </div>
                  <div style="font-size:11px;color:var(--muted2);margin-top:4px;">
                    La cita de esa hora se cancelará automáticamente.
                  </div>
                </div>
                <div class="field-wrap">
                  <label class="field-lbl">Motivo <span style="color:var(--red,#e55);">*</span></label>
                  <textarea class="field-ta" name="motivo" required
                    placeholder="Describe el motivo de la inasistencia o cancelación…"
                    style="min-height:100px;"></textarea>
                  @error('motivo')
                  <div style="font-size:11px;color:var(--red,#e55);margin-top:4px;">
                    {{ $message }}
                  </div>
                  @enderror
                </div>

                <div class="form-actions">
                  <button type="submit" class="btn-gold">Registrar novedad</button>
                </div>

              </form>
            </div>
          </div>
          <div class="card" style="min-width:280px;">
            <div class="card-hd"><span class="card-hd-title">Mis novedades recientes</span></div>
            <div class="card-body" style="padding:16px;">
              @forelse($novedades ?? [] as $nov)
              <div class="list-item" style="align-items:flex-start;gap:12px;">
                <div class="li-info" style="flex:1;">
                  <div class="li-name">
                    {{ $nov->etiquetaTipo() }}
                    <span style="font-size:11px;color:var(--muted2);margin-left:6px;">
                      {{ \Carbon\Carbon::parse($nov->fecha)->format('d/m/Y') }}
                      @if($nov->hora_afectada)
                      · {{ $nov->hora_afectada }}
                      @endif
                    </span>
                  </div>
                  <div class="li-sub">{{ $nov->motivo }}</div>
                </div>

                {{-- Estado badge — Criterio 5: refleja aprobación en tiempo real --}}
                @php
                $badgeNov = match($nov->estado) {
                'aprobada' => 'badge--green',
                'rechazada' => 'badge--red',
                default => 'badge--gold',
                };
                @endphp
                <span class="badge {{ $badgeNov }}" style="flex-shrink:0;">
                  {{ ucfirst($nov->estado) }}
                </span>
              </div>
              <hr style="opacity:.08;margin:8px 0;">
              @empty
              <div style="text-align:center;padding:20px;color:var(--muted2);font-size:13px;">
                No hay novedades registradas.
              </div>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-backdrop" id="modalReprogramar" style="
  display:none;position:fixed;inset:0;z-index:1000;
  background:rgba(0,0,0,.72);backdrop-filter:blur(4px);
  align-items:center;justify-content:center;">

    <div style="
    background:var(--surface2,#1a1a1a);border:1px solid rgba(255,255,255,.08);
    border-radius:16px;width:min(480px,92vw);padding:28px 28px 24px;
    box-shadow:0 24px 64px rgba(0,0,0,.5);position:relative;">

      {{-- Encabezado --}}
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:22px;">
        <div>
          <div style="font-family:'Bebas Neue',sans-serif;font-size:22px;letter-spacing:2px;color:var(--text,#fff);">
            Reprogramar Cita
          </div>
          <div style="font-size:12px;color:var(--muted2,#888);margin-top:2px;" id="repro-cliente-label">
            <!-- Se rellena por JS -->
          </div>
        </div>
        <button onclick="cerrarModalReprogramar()"
          style="background:none;border:none;cursor:pointer;color:var(--muted2,#888);padding:4px;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
          </svg>
        </button>
      </div>

      {{-- Formulario --}}
      {{--
      RUTA SUGERIDA (definir en routes/web.php):
        Route::patch('/barber/citas/{id}/reprogramar', [BarberController::class, 'reprogramarCita'])
             ->name('barber.citas.reprogramar');
    --}}
      <form id="formReprogramar"
        method="POST"
        action="" {{-- se actualiza por JS con la URL correcta --}}
        style="display:flex;flex-direction:column;gap:16px;">
        @csrf
        @method('PATCH')

        {{-- CRITERIO 3 — Nuevo horario --}}
        <div class="field-wrap">
          <label class="field-lbl">Nueva fecha y hora</label>
          <div class="field-box">
            <input type="datetime-local" name="nueva_hora"
              id="repro-nueva-hora" required
              style="background:transparent;border:none;color:var(--text,#fff);
                   font-size:13px;outline:none;width:100%;">
          </div>
        </div>

        {{-- CRITERIO 5 — Motivo (trazabilidad) --}}
        <div class="field-wrap">
          <label class="field-lbl">Motivo de la reprogramación</label>
          <textarea class="field-ta" name="motivo_reprogramacion"
            id="repro-motivo"
            placeholder="Ej: Emergencia personal, problema con el local, etc."
            required
            style="min-height:90px;"></textarea>
        </div>

        {{-- Campo oculto: id de la cita --}}
        <input type="hidden" name="id_cita" id="repro-id-cita">

        <div class="form-actions" style="margin-top:4px;">
          <button type="submit" class="btn-gold">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
              <rect x="3" y="4" width="18" height="18" rx="2" />
              <line x1="16" y1="2" x2="16" y2="6" />
              <line x1="8" y1="2" x2="8" y2="6" />
              <line x1="3" y1="10" x2="21" y2="10" />
            </svg>
            Confirmar cambio
          </button>
          <button type="button" class="btn-outline" onclick="cerrarModalReprogramar()">
            Cancelar
          </button>
        </div>
      </form>

    </div>
  </div>
  <script src="/BladeBarber/public/js/barber-dash.js"></script>
</body>

</html>