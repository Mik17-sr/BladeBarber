<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Admin — BladeBarber</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/BladeBarber/public/css/admin-dash.css">
</head>

<body>

  <div class="bg-scene">
    <div class="bg-grain"></div>
    <div class="bg-glow bg-glow--1"></div>
    <div class="bg-glow bg-glow--2"></div>
  </div>

  <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

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
        <div class="logo-text">BladeBarber</div>
        <div class="logo-role">Admin</div>
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

      <div class="nav-label">Cuenta</div>
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
          <polyline points="17 21 17 13 7 13 7 21" />
          <polyline points="7 3 7 8 15 8" />
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
        Lista de Barberos
        <span class="nav-badge">4</span>
      </button>
      <button class="nav-item" onclick="showPanel('barber-register')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
          <circle cx="9" cy="7" r="4" />
          <line x1="19" y1="8" x2="19" y2="14" />
          <line x1="22" y1="11" x2="16" y2="11" />
        </svg>
        Registrar Barbero
      </button>
      <hr style="margin:25px 0; opacity:.2;">


      <div class="nav-label">Agenda</div>
      <button class="nav-item" onclick="showPanel('agenda')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="4" width="18" height="18" rx="2" />
          <line x1="16" y1="2" x2="16" y2="6" />
          <line x1="8" y1="2" x2="8" y2="6" />
          <line x1="3" y1="10" x2="21" y2="10" />
        </svg>
        Ver Agenda
      </button>
      <button class="nav-item" onclick="showPanel('schedule')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10" />
          <polyline points="12 6 12 12 16 14" />
        </svg>
        Asignar Horario
      </button>

      <div class="nav-label">Barbería</div>
      <button class="nav-item" onclick="showPanel('barberia')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
          <polyline points="9 22 9 12 15 12 15 22" />
        </svg>
        Estado Barbería
      </button>
    </nav>

    <div class="sidebar-foot">
      <div class="avatar-sm">A</div>
      <div class="foot-info">
        <div class="foot-name">{{ auth()->user()->name ?? 'Admin' }}</div>
        <div class="foot-role">ADMINISTRADOR</div>
      </div>
      <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button class="logout-btn" type="submit" title="Cerrar sesión">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            <polyline points="16 17 21 12 16 7" />
            <line x1="21" y1="12" x2="9" y2="12" />
          </svg>
        </button>
      </form>
    </div>
  </aside>
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
        <button class="icon-btn" title="Notificaciones">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
          </svg>
        </button>
        <button class="icon-btn" title="Configuración">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="3" />
            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z" />
          </svg>
        </button>
      </div>
    </div>

    <div class="content">
      <div class="panel active" id="panel-welcome">
        <div class="welcome-banner">
          <div class="welcome-tag">Panel de Administración</div>
          <div class="welcome-title">Bienvenido,<br>{{ auth()->user()->name ?? 'Admin' }}</div>
          <div class="welcome-sub">Gestiona tu barbería desde aquí.</div>
          <div class="welcome-time">
            <div class="time" id="clock">--:--</div>
            <div class="date" id="dateStr">--</div>
          </div>
        </div>
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-icon stat-icon--gold">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
              </svg>
            </div>
            <div class="stat-val">4</div>
            <div class="stat-lbl">Barberos Activos</div>
            <div class="stat-delta delta-up">↑ 1 este mes</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon stat-icon--green">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <line x1="16" y1="2" x2="16" y2="6" />
                <line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
              </svg>
            </div>
            <div class="stat-val">12</div>
            <div class="stat-lbl">Citas Hoy</div>
            <div class="stat-delta delta-up">↑ 3 vs ayer</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon stat-icon--blue">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="8" r="4" />
                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
              </svg>
            </div>
            <div class="stat-val">87</div>
            <div class="stat-lbl">Clientes Totales</div>
            <div class="stat-delta delta-up">↑ 5 esta semana</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon stat-icon--red">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="1" x2="12" y2="23" />
                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
              </svg>
            </div>
            <div class="stat-val">$2.4M</div>
            <div class="stat-lbl">Ingresos Mes</div>
            <div class="stat-delta delta-dn">↓ 8% vs anterior</div>
          </div>
        </div>
        <div class="two-col">
          <div class="card">
            <div class="card-hd"><span class="card-hd-title">Estado Barbería</span></div>
            <div class="card-body">
              <div class="shop-status shop-status--open" id="welcomeShopStatus">
                <div class="status-dot status-dot--open"></div>
                <span class="status-text status-text--open">ABIERTA</span>
                <span class="status-sub">Desde las 8:00 AM</span>
              </div>
              <button class="toggle-btn toggle-btn--close" id="welcomeToggleBtn" onclick="toggleShop()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="3" width="18" height="18" rx="2" />
                  <line x1="9" y1="9" x2="15" y2="15" />
                  <line x1="15" y1="9" x2="9" y2="15" />
                </svg>
                Cerrar Barbería
              </button>
            </div>
          </div>
          <div class="card">
            <div class="card-hd"><span class="card-hd-title">Próximas Citas</span></div>
            <div class="card-body">
              <div class="list-item">
                <div class="li-avatar">C</div>
                <div class="li-info">
                  <div class="li-name">Carlos Ruiz</div>
                  <div class="li-sub">10:00 AM — Corte + Barba</div>
                </div>
                <span class="badge badge-gold">Hoy</span>
              </div>
              <div class="list-item">
                <div class="li-avatar">M</div>
                <div class="li-info">
                  <div class="li-name">Miguel Torres</div>
                  <div class="li-sub">11:30 AM — Corte Clásico</div>
                </div>
                <span class="badge badge-gold">Hoy</span>
              </div>
              <div class="list-item">
                <div class="li-avatar">J</div>
                <div class="li-info">
                  <div class="li-name">Juan López</div>
                  <div class="li-sub">2:00 PM — Diseño</div>
                </div>
                <span class="badge badge-gold">Hoy</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel" id="panel-profile-view">
        <div class="profile-hero">
          <div class="avatar-lg">
            A
            <div class="avatar-overlay">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                <circle cx="12" cy="13" r="4" />
              </svg>
            </div>
          </div>
          <div class="profile-info">
            <div class="profile-name">{{ auth()->user()->name ?? 'Administrador' }}</div>
            <div class="profile-email">{{ auth()->user()->email ?? 'admin@barberos.com' }}</div>
            <div class="profile-tags">
              <span class="profile-tag">Administrador</span>
              <span class="profile-tag">BarberOS</span>
              <span class="profile-tag">Activo</span>
            </div>
          </div>
        </div>
        <div class="two-col">
          <div class="card">
            <div class="card-hd"><span class="card-hd-title">Información Personal</span></div>
            <div class="card-body">
              <div class="list-item">
                <div class="li-info">
                  <div class="li-name">Nombre</div>
                  <div class="li-sub">{{ auth()->user()->name ?? 'Admin User' }}</div>
                </div>
              </div>
              <div class="list-item">
                <div class="li-info">
                  <div class="li-name">Correo</div>
                  <div class="li-sub">{{ auth()->user()->email ?? 'admin@barberos.com' }}</div>
                </div>
              </div>
              <div class="list-item">
                <div class="li-info">
                  <div class="li-name">Teléfono</div>
                  <div class="li-sub">{{ auth()->user()->phone ?? '+57 300 000 0000' }}</div>
                </div>
              </div>
              <div class="list-item">
                <div class="li-info">
                  <div class="li-name">Miembro desde</div>
                  <div class="li-sub">{{ auth()->user()?->created_at?->format('d M Y') ?? 'Enero 2024' }}</div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-hd"><span class="card-hd-title">Acciones Rápidas</span></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:10px;padding-top:20px;">
              <button class="btn-gold" onclick="showPanel('profile-edit')" style="width:100%;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Editar Perfil
              </button>
              <button class="btn-outline" onclick="showPanel('change-pass')" style="width:100%;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="11" width="18" height="11" rx="2" />
                  <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
                Cambiar Contraseña
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- ===== EDITAR PERFIL ===== -->
      <div class="panel" id="panel-profile-edit">
        <div class="profile-hero" style="margin-bottom:24px;">
          <div class="avatar-lg" onclick="document.getElementById('avatarInput').click()">
            A
            <div class="avatar-overlay">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                <circle cx="12" cy="13" r="4" />
              </svg>
            </div>
            <input type="file" id="avatarInput" accept="image/*" style="display:none" onchange="previewAvatar(event)">
          </div>
          <div class="profile-info">
            <div class="profile-name">Editar Perfil</div>
            <div class="profile-email">Haz clic en la foto para cambiarla</div>
          </div>
        </div>
        <div class="card" style="margin-bottom:16px;">
          <div class="card-hd"><span class="card-hd-title">Datos Personales</span></div>
          <div class="card-body">
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
              @csrf @method('PUT')
              <div class="form-grid" style="gap:16px;">
                <div class="field-wrap">
                  <label class="field-lbl">Nombre</label>
                  <div class="field-box"><input type="text" name="name" value="{{ auth()->user()?->name }}" placeholder="Tu nombre completo"></div>
                </div>
                <div class="field-wrap">
                  <label class="field-lbl">Correo Electrónico</label>
                  <div class="field-box"><input type="email" name="email" value="{{ auth()->user()?->email }}" placeholder="correo@ejemplo.com"></div>
                </div>
                <div class="field-wrap">
                  <label class="field-lbl">Teléfono</label>
                  <div class="field-box"><input type="tel" name="phone" value="{{ auth()->user()?->phone }}" placeholder="+57 300 000 0000"></div>
                </div>
                <div class="field-wrap">
                  <label class="field-lbl">Ciudad</label>
                  <div class="field-box"><input type="text" name="city" value="{{ auth()->user()?->city }}" placeholder="Bogotá"></div>
                </div>
                <div class="field-wrap form-full">
                  <label class="field-lbl">Descripción</label>
                  <textarea class="field-ta" name="bio" placeholder="Cuéntanos sobre ti...">{{ auth()->user()?->bio }}</textarea>
                </div>
                <div class="field-wrap form-full">
                  <label class="field-lbl">Foto de Perfil</label>
                  <div class="field-box"><input type="file" name="avatar" accept="image/*"></div>
                </div>
              </div>
              <div class="form-actions" style="margin-top:20px;">
                <button type="submit" class="btn-gold">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                    <polyline points="17 21 17 13 7 13 7 21" />
                    <polyline points="7 3 7 8 15 8" />
                  </svg>
                  Guardar Cambios
                </button>
                <button type="button" class="btn-outline" onclick="showPanel('profile-view')">Cancelar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- ===== CAMBIAR CONTRASEÑA ===== -->
      <div class="panel" id="panel-change-pass">
        <div class="card" style="max-width:480px;margin:0 auto;">
          <div class="card-hd">
            <span class="card-hd-title">Cambiar Contraseña</span>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.password.change') }}" method="POST">
              @csrf @method('PUT')
              <div style="display:flex;flex-direction:column;gap:14px;">
                <div class="field-wrap">
                  <label class="field-lbl">Contraseña Actual</label>
                  <div class="field-box">
                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <rect x="3" y="11" width="18" height="11" rx="2" />
                      <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                    <input type="password" name="current_password" placeholder="••••••••" id="cp1">
                    <button type="button" class="eye-btn" onclick="togglePwd('cp1',this)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                      </svg></button>
                  </div>
                </div>
                <div class="field-wrap">
                  <label class="field-lbl">Nueva Contraseña</label>
                  <div class="field-box">
                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <rect x="3" y="11" width="18" height="11" rx="2" />
                      <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                    <input type="password" name="password" placeholder="••••••••" id="cp2" oninput="checkStrength(this.value)">
                    <button type="button" class="eye-btn" onclick="togglePwd('cp2',this)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                      </svg></button>
                  </div>
                  <div class="strength-bar">
                    <div class="strength-fill" id="strBar"></div>
                  </div>
                  <div class="strength-text" id="strText"></div>
                </div>
                <div class="field-wrap">
                  <label class="field-lbl">Confirmar Contraseña</label>
                  <div class="field-box">
                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <rect x="3" y="11" width="18" height="11" rx="2" />
                      <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                    <input type="password" name="password_confirmation" placeholder="••••••••" id="cp3" oninput="checkMatch()">
                    <button type="button" class="eye-btn" onclick="togglePwd('cp3',this)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                      </svg></button>
                  </div>
                  <div class="match-msg" id="matchMsg"></div>
                </div>
                <button type="submit" class="btn-gold" style="margin-top:4px;">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4" />
                  </svg>
                  Actualizar Contraseña
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- ===== MURO ===== -->
      <div class="panel" id="panel-posts-wall">
        <div style="margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;">
          <div>
            <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Muro de Publicaciones</div>
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
              <div class="li-avatar">{{ substr($post->user->name, 0, 1) }}</div>
              <div class="post-meta">
                <div class="post-author">{{ $post->user->name }}</div>
                <div class="post-time">{{ $post->created_at->diffForHumans() }}</div>
              </div>
              <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                @csrf @method('DELETE')
                <button class="post-del" type="submit" title="Eliminar">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6l-1 14H6L5 6" />
                    <path d="M10 11v6M14 11v6" />
                    <path d="M9 6V4h6v2" />
                  </svg>
                </button>
              </form>
            </div>
            @if($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" alt="Post" class="post-img">
            @endif
            <div class="post-body">
              <p class="post-text">{{ $post->content }}</p>
            </div>
            <div class="post-footer">
              <button class="post-action"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                </svg>{{ $post->likes_count ?? 0 }}</button>
              <button class="post-action"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                </svg>{{ $post->comments_count ?? 0 }}</button>
            </div>
          </div>
          @empty
          <!-- Demo post -->
          <div class="post-card">
            <div class="post-head">
              <div class="li-avatar">A</div>
              <div class="post-meta">
                <div class="post-author">Admin</div>
                <div class="post-time">hace 2 horas</div>
              </div>
            </div>
            <div class="post-body">
              <p class="post-text">¡Bienvenidos a BarberOS! Estamos listos para atenderte con los mejores barberos de la ciudad. Reserva tu cita hoy.</p>
            </div>
            <div class="post-footer">
              <button class="post-action"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                </svg>24</button>
              <button class="post-action"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                </svg>8</button>
            </div>
          </div>
          @endforelse
        </div>
      </div>

      <!-- ===== NUEVA PUBLICACIÓN ===== -->
      <div class="panel" id="panel-post-create">
        <div style="margin-bottom:20px;">
          <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Nueva Publicación</div>
          <div style="font-size:13px;color:var(--muted2);">Comparte contenido con tu comunidad</div>
        </div>
        <div class="card" style="max-width:600px;">
          <div class="card-body" style="padding:24px;">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div style="display:flex;flex-direction:column;gap:16px;">
                <div class="field-wrap">
                  <label class="field-lbl">Contenido</label>
                  <textarea class="field-ta" name="content" placeholder="¿Qué quieres compartir hoy?" style="min-height:120px;"></textarea>
                </div>
                <div class="field-wrap">
                  <label class="field-lbl">Imagen (opcional)</label>
                  <label class="upload-btn" style="height:48px;border-radius:var(--radius);justify-content:center;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <rect x="3" y="3" width="18" height="18" rx="2" />
                      <circle cx="8.5" cy="8.5" r="1.5" />
                      <polyline points="21 15 16 10 5 21" />
                    </svg>
                    Seleccionar imagen
                    <input type="file" name="image" accept="image/*" onchange="previewPost(event)">
                  </label>
                  <div class="post-preview-img" id="postPreview"><img id="postPreviewImg" src="" alt="Preview"></div>
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn-gold">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <line x1="22" y1="2" x2="11" y2="13" />
                      <polygon points="22 2 15 22 11 13 2 9 22 2" />
                    </svg>
                    Publicar
                  </button>
                  <button type="button" class="btn-outline" onclick="showPanel('posts-wall')">Cancelar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- ===== LISTA BARBEROS ===== -->
      <div class="panel" id="panel-barbers-list">
        <div class="barbers-controls">
          <div style="flex:1;">
            <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Barberos</div>
            <div style="font-size:13px;color:var(--muted2);">Gestiona el equipo de tu barbería</div>
          </div>
          <div class="search-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8" />
              <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
            <input type="text" placeholder="Buscar barbero...">
          </div>
          <button class="btn-gold" onclick="showPanel('barber-register')">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="12" y1="5" x2="12" y2="19" />
              <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Registrar
          </button>
        </div>
        <div class="barbers-grid">
          @forelse($barbers ?? [] as $barber)
          <div class="barber-card">
            <div class="barber-card-top">
              <div class="barber-avatar">
                @if($barber->avatar)<img src="{{ asset('storage/'.$barber->avatar) }}" alt="">@else{{ substr($barber->name,0,1) }}@endif
              </div>
              <div>
                <div class="barber-name">{{ $barber->name }}</div>
                <div class="barber-spec">{{ $barber->specialty ?? 'Barbero' }}</div>
                <span class="badge {{ $barber->active ? 'badge--green' : 'badge--red' }}">{{ $barber->active ? 'Activo' : 'Inactivo' }}</span>
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
            <div class="barber-actions">
              <form action="{{ route('admin.barbers.toggle', $barber->id) }}" method="POST" style="flex:1;">
                @csrf @method('PATCH')
                <button type="submit" class="barber-toggle {{ $barber->active ? 'barber-toggle--active' : 'barber-toggle--inactive' }}" style="width:100%;">
                  {{ $barber->active ? 'Desactivar' : 'Activar' }}
                </button>
              </form>
              <button class="barber-edit" onclick="showPanel('barber-register')" title="Editar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
              </button>
            </div>
          </div>
          @empty
          <!-- Demo cards -->
          @foreach([['Pedro Gómez','Fade & Barba','Activo',true,28,'4.9'],['Luis Mora','Clásico','Activo',true,15,'4.7'],['Andrés Cruz','Diseño','Inactivo',false,5,'4.5'],['Camilo R','Moderno','Activo',true,32,'5.0']] as $b)
          <div class="barber-card">
            <div class="barber-card-top">
              <div class="barber-avatar">{{ substr($b[0],0,1) }}</div>
              <div>
                <div class="barber-name">{{ $b[0] }}</div>
                <div class="barber-spec">{{ $b[1] }}</div>
                <span class="badge {{ $b[3] ? 'badge--green' : 'badge--red' }}">{{ $b[2] }}</span>
              </div>
            </div>
            <div class="barber-stats">
              <div class="barber-stat">
                <div class="barber-stat-val">{{ $b[4] }}</div>
                <div class="barber-stat-lbl">Citas</div>
              </div>
              <div class="barber-stat">
                <div class="barber-stat-val">{{ $b[5] }}</div>
                <div class="barber-stat-lbl">Rating</div>
              </div>
            </div>
            <div class="barber-actions">
              <button class="barber-toggle {{ $b[3] ? 'barber-toggle--active' : 'barber-toggle--inactive' }}" style="flex:1;">{{ $b[3] ? 'Desactivar' : 'Activar' }}</button>
              <button class="barber-edit"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg></button>
            </div>
          </div>
          @endforeach
          @endforelse
        </div>
      </div>
      <div class="panel" id="panel-barber-register">
        <div style="margin-bottom:20px;">
          <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Registrar Barbero</div>
          <div style="font-size:13px;color:var(--muted2);">Agrega un nuevo integrante al equipo</div>
        </div>
        <div class="reg-form">
          <div class="reg-form-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <line x1="19" y1="8" x2="19" y2="14" />
              <line x1="22" y1="11" x2="16" y2="11" />
            </svg>
            Información del Barbero
          </div>
          @if ($errors->any())
          <div style="
          background:#2a0f12;
          color:#ffb3b3;
          padding:15px;
          border-radius:12px;
          margin-bottom:20px;">
              <ul style="margin:0;padding-left:18px;">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
          <form action="{{ route('admin.barbers.store') }}" method="POST">
            @csrf

            <div class="form-grid" style="gap:14px;">

              <div class="field-wrap">
                <label class="field-lbl">Nombre Completo</label>
                <div class="field-box">
                  <input
                    type="text"
                    name="nombre"
                    value="{{ old('nombre') }}"
                    required
                    placeholder="Nombre del barbero">
                </div>
              </div>


              <div class="field-wrap">
                <label class="field-lbl">Correo Electrónico</label>
                <div class="field-box">
                  <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    placeholder="correo@ejemplo.com">
                </div>
              </div>
              <div class="field-wrap">
                <label class="field-lbl">Usuario</label>
                <div class="field-box">
                  <input
                    type="text"
                    name="usuario"
                    value="{{ old('usuario') }}"
                    required
                    placeholder="usuario_login">
                </div>
              </div>


              <div class="field-wrap">
                <label class="field-lbl">Teléfono</label>
                <div class="field-box">
                  <input
                    type="text"
                    name="telefono"
                    value="{{ old('telefono') }}"
                    placeholder="3001234567">
                </div>
              </div>


              <div class="field-wrap">
                <label class="field-lbl">Contraseña</label>
                <div class="field-box">
                  <input
                    type="password"
                    name="contrasena"
                    required
                    placeholder="********">
                </div>
              </div>


              <div class="field-wrap form-full">
                <label class="field-lbl">Descripción</label>
                <textarea
                  class="field-ta"
                  name="bio"
                  placeholder="Experiencia del barbero">
        </textarea>
              </div>
            </div>
            <input type="hidden" name="rol" value="barbero">
            <input type="hidden" name="estado" value="1">
            <hr style="margin:25px 0;opacity:.2">
            <h3>Horario semanal</h3>
            <div class="hours-grid">
              @foreach(['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'] as $dia)
              <div class="hour-day">
                <div class="hour-label">{{ $dia }}</div>
                <input
                  type="time"
                  name="horarios[{{ $dia }}][inicio]"
                  value="08:00"
                  class="hour-input">
                <input
                  type="time"
                  name="horarios[{{ $dia }}][fin]"
                  value="18:00"
                  class="hour-input">
                <label>
                  <input
                    type="checkbox"
                    name="horarios[{{ $dia }}][activo]"
                    checked>
                  Activo
                </label>
              </div>
              @endforeach
            </div>
            <div class="form-actions" style="margin-top:20px;">
              <button type="submit" class="btn-gold">
                Registrar Barbero
              </button>
              <button
                type="button"
                class="btn-outline"
                onclick="showPanel('barbers-list')">
                Cancelar
              </button>
            </div>
          </form>
          @if ($errors->any())
          <script>
          document.addEventListener('DOMContentLoaded', function(){
            showPanel('barber-register');
          });
          </script>
          @endif
        </div>
      </div>

      <!-- ===== AGENDA ===== -->
      <div class="panel" id="panel-agenda">
        <div class="agenda-controls">
          <div style="flex:1;">
            <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Agenda Semanal</div>
            <div style="font-size:13px;color:var(--muted2);">Citas y disponibilidad por barbero</div>
          </div>
          <div class="week-nav">
            <button class="week-nav-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6" />
              </svg></button>
            <span class="week-label" id="weekLabel">Esta semana</span>
            <button class="week-nav-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="9 18 15 12 9 6" />
              </svg></button>
          </div>
        </div>
        <div class="schedule-grid">
          @foreach(['Lun','Mar','Mié','Jue','Vie','Sáb','Dom'] as $i => $day)
          <div class="day-col {{ $i == 2 ? 'today' : '' }}">
            <div class="day-hd">
              <div class="day-name">{{ $day }}</div>
              <div class="day-num">{{ 14 + $i }}</div>
            </div>
            @if($i == 0)<div class="slot slot--booked">
              <div class="slot-time">9:00</div>
              <div class="slot-name">Carlos R.</div>
            </div>
            <div class="slot slot--avail">
              <div class="slot-time">11:00</div>
              <div class="slot-name">Libre</div>
            </div>@endif
            @if($i == 1)<div class="slot slot--booked">
              <div class="slot-time">10:00</div>
              <div class="slot-name">Miguel T.</div>
            </div>@endif
            @if($i == 2)<div class="slot slot--booked">
              <div class="slot-time">9:00</div>
              <div class="slot-name">Juan L.</div>
            </div>
            <div class="slot slot--booked">
              <div class="slot-time">14:00</div>
              <div class="slot-name">Ana M.</div>
            </div>
            <div class="slot slot--avail">
              <div class="slot-time">16:00</div>
              <div class="slot-name">Libre</div>
            </div>@endif
            @if($i == 4)<div class="slot slot--booked">
              <div class="slot-time">11:00</div>
              <div class="slot-name">Pedro G.</div>
            </div>
            <div class="slot slot--avail">
              <div class="slot-time">15:00</div>
              <div class="slot-name">Libre</div>
            </div>@endif
            @if($i == 5)<div class="slot slot--booked">
              <div class="slot-time">9:00</div>
              <div class="slot-name">Luis M.</div>
            </div>
            <div class="slot slot--booked">
              <div class="slot-time">10:30</div>
              <div class="slot-name">Andrés C.</div>
            </div>
            <div class="slot slot--booked">
              <div class="slot-time">12:00</div>
              <div class="slot-name">Camilo R.</div>
            </div>@endif
          </div>
          @endforeach
        </div>
        <div style="font-family:'Bebas Neue',sans-serif;font-size:18px;letter-spacing:1px;margin-bottom:14px;">Citas del Día</div>
        <div class="appt-list">
          @forelse($todayAppointments ?? [] as $appt)
          <div class="appt-item">
            <div class="appt-time">{{ $appt->time }}</div>
            <div class="appt-info">
              <div class="appt-client">{{ $appt->client->name }}</div>
              <div class="appt-service">{{ $appt->service }}</div>
              <div class="appt-barber">Barbero: {{ $appt->barber->name }}</div>
            </div>
            <div class="appt-dur">{{ $appt->duration }} min<br><span class="badge badge--green">Confirmado</span></div>
          </div>
          @empty
          @foreach([['09:00','Carlos Ruiz','Corte + Barba','Pedro G.','60'],['10:00','Miguel Torres','Corte Clásico','Luis M.','45'],['11:30','Juan López','Diseño','Andrés C.','75'],['14:00','Ana Martínez','Coloración','Camilo R.','90'],['15:30','Pedro Sánchez','Fade','Pedro G.','50']] as $a)
          <div class="appt-item">
            <div class="appt-time">{{ $a[0] }}</div>
            <div class="appt-info">
              <div class="appt-client">{{ $a[1] }}</div>
              <div class="appt-service">{{ $a[2] }}</div>
              <div class="appt-barber">Barbero: {{ $a[3] }}</div>
            </div>
            <div class="appt-dur">{{ $a[4] }} min<br><span class="badge badge--green">Confirmado</span></div>
          </div>
          @endforeach
          @endforelse
        </div>
      </div>

      <!-- ===== ASIGNAR HORARIO ===== -->
      <div class="panel" id="panel-schedule">
        <div style="margin-bottom:20px;">
          <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Asignar Horario</div>
          <div style="font-size:13px;color:var(--muted2);">Define la disponibilidad semanal por barbero</div>
        </div>
        <div class="schedule-assign">
          <form action="{{ route('admin.schedule.update') }}" method="POST">
            @csrf @method('PUT')
            <div class="field-wrap" style="max-width:280px;margin-bottom:20px;">
              <label class="field-lbl">Barbero</label>
              <div class="field-box">
                <select name="barber_id" style="width:100%;">
                  <option value="">Seleccionar barbero...</option>
                  @foreach($barbers ?? [] as $b)
                  <option value="{{ $b->id }}">{{ $b->name }}</option>
                  @endforeach
                  <option>Pedro Gómez</option>
                  <option>Luis Mora</option>
                  <option>Andrés Cruz</option>
                  <option>Camilo R.</option>
                </select>
              </div>
            </div>
            <div class="hours-grid">
              @foreach(['Lun','Mar','Mié','Jue','Vie','Sáb','Dom'] as $day)
              <div class="hour-day">
                <div class="hour-label">{{ $day }}</div>
                <input type="time" class="hour-input" name="hours[{{ $day }}][start]" value="08:00">
                <input type="time" class="hour-input" name="hours[{{ $day }}][end]" value="18:00">
                <label style="display:flex;align-items:center;gap:4px;font-size:10px;color:var(--muted);justify-content:center;margin-top:4px;">
                  <input type="checkbox" name="hours[{{ $day }}][active]" checked style="accent-color:var(--gold);"> Activo
                </label>
              </div>
              @endforeach
            </div>
            <div class="form-actions" style="margin-top:20px;">
              <button type="submit" class="btn-gold">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                  <polyline points="17 21 17 13 7 13 7 21" />
                  <polyline points="7 3 7 8 15 8" />
                </svg>
                Guardar Horario
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- ===== BARBERÍA ===== -->
      <div class="panel" id="panel-barberia">
        <div style="margin-bottom:24px;">
          <div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Estado de la Barbería</div>
          <div style="font-size:13px;color:var(--muted2);">Controla la apertura y cierre de tu local</div>
        </div>
        <div class="two-col">
          <div class="card">
            <div class="card-hd"><span class="card-hd-title">Estado Actual</span></div>
            <div class="card-body">
              <div class="shop-status shop-status--open" id="barberiaStatus">
                <div class="status-dot status-dot--open"></div>
                <div>
                  <div class="status-text status-text--open">BARBERÍA ABIERTA</div>
                  <div style="font-size:11px;color:var(--muted);">Abierta desde las 8:00 AM</div>
                </div>
              </div>
              <div style="display:flex;gap:10px;margin-top:16px;">
                <form action="{{ route('admin.barberia.toggle') }}" method="POST" style="flex:1;">
                  @csrf @method('PATCH')
                  <input type="hidden" name="status" value="closed">
                  <button type="submit" class="toggle-btn toggle-btn--close" style="width:100%;" id="closeBtn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <rect x="3" y="3" width="18" height="18" rx="2" />
                      <line x1="9" y1="9" x2="15" y2="15" />
                      <line x1="15" y1="9" x2="9" y2="15" />
                    </svg>
                    Cerrar Barbería
                  </button>
                </form>
                <form action="{{ route('admin.barberia.toggle') }}" method="POST" style="flex:1;">
                  @csrf @method('PATCH')
                  <input type="hidden" name="status" value="open">
                  <button type="submit" class="toggle-btn toggle-btn--open" style="width:100%;" id="openBtn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    </svg>
                    Abrir Barbería
                  </button>
                </form>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-hd"><span class="card-hd-title">Horario General</span></div>
            <div class="card-body">
              @foreach([['Lunes – Viernes','8:00 AM – 8:00 PM'],['Sábado','9:00 AM – 6:00 PM'],['Domingo','Cerrado']] as $h)
              <div class="list-item">
                <div class="li-info">
                  <div class="li-name">{{ $h[0] }}</div>
                  <div class="li-sub">{{ $h[1] }}</div>
                </div>
                @if($h[1] == 'Cerrado')<span class="badge badge--red">Cerrado</span>@else<span class="badge badge--green">Abierto</span>@endif
              </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="card" style="margin-top:20px;">
          <div class="card-hd"><span class="card-hd-title">Información de la Barbería</span></div>
          <div class="card-body">
            <form action="{{ route('admin.barberia.update') }}" method="POST">
              @csrf @method('PUT')
              <div class="form-grid" style="gap:14px;">
                <div class="field-wrap">
                  <label class="field-lbl">Nombre</label>
                  <div class="field-box"><input type="text" name="nombre" value="{{ $barberia->name ?? 'BladeBarber Premium' }}" placeholder="Barberia"></div>
                </div>
                <div class="field-wrap">
                  <label class="field-lbl">Teléfono</label>
                  <div class="field-box"><input type="tel" name="telefono" value="{{ $barberia->phone ?? '' }}" placeholder="+57 300 000 0000"></div>
                </div>
                <div class="field-wrap form-full">
                  <label class="field-lbl">Dirección</label>
                  <div class="field-box"><input type="text" name="address" value="{{ $barberia->address ?? '' }}" placeholder="Calle 123 # 45-67, Bogotá"></div>
                </div>
              </div>
              <div class="form-actions" style="margin-top:16px;">
                <button type="submit" class="btn-gold">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                    <polyline points="17 21 17 13 7 13 7 21" />
                    <polyline points="7 3 7 8 15 8" />
                  </svg>
                  Guardar Información
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="/BladeBarber/public/js/admin-dash.js"></script>
</body>

</html>