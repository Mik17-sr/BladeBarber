<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Espacio — BladeBarber Cliente</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/BladeBarber/public/css/cliente-dash.css">
</head>

<body>

    <div class="bg-scene">
        <div class="bg-grain"></div>
        <div class="bg-glow bg-glow--1"></div>
        <div class="bg-glow bg-glow--2"></div>
        <div class="bg-glow bg-glow--3"></div>
    </div>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-head">
            <div class="logo-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2">
                    <path d="M3 6h18M3 12h18M3 18h18" />
                    <circle cx="8" cy="6" r="2" fill="#fff" stroke="none" />
                    <circle cx="16" cy="12" r="2" fill="#fff" stroke="none" />
                    <circle cx="8" cy="18" r="2" fill="#fff" stroke="none" />
                </svg>
            </div>
            <div>
                <div class="logo-text">BladeBarber</div>
                <div class="logo-role">Cliente</div>
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
                Inicio
            </button>

            <div class="nav-label">Mi Cuenta</div>
            <button class="nav-item" onclick="showPanel('profile-view')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                </svg>
                Mi Perfil
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
                Contraseña
            </button>

            <div class="nav-label">Barbería</div>
            @if($filaActiva)
            <button class="nav-item" onclick="showPanel('agenda')" disabled style="pointer-events:none;opacity:0.6;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
                Agendar Cita
            </button>
            @else
            <button class="nav-item" onclick="showPanel('agenda')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
                Agendar Cita
            </button>
            @endif
            <button class="nav-item" onclick="showPanel('mis-citas')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                    <line x1="9" y1="13" x2="15" y2="13" />
                    <line x1="9" y1="17" x2="12" y2="17" />
                </svg>
                Mis Citas
                <span class="nav-badge">2</span>
            </button>
            <button class="nav-item" onclick="showPanel('fila')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="8" y1="6" x2="21" y2="6" />
                    <line x1="8" y1="12" x2="21" y2="12" />
                    <line x1="8" y1="18" x2="21" y2="18" />
                    <line x1="3" y1="6" x2="3.01" y2="6" />
                    <line x1="3" y1="12" x2="3.01" y2="12" />
                    <line x1="3" y1="18" x2="3.01" y2="18" />
                </svg>
                Fila de Espera
                <span class="nav-badge nav-badge--pulse">3</span>
            </button>
            <button class="nav-item" onclick="showPanel('barberos')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
                Nuestros Barberos
            </button>

            <div class="nav-label">Comunidad</div>
            <button class="nav-item" onclick="showPanel('muro')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10l6 6v8a2 2 0 0 1-2 2z" />
                    <polyline points="17 21 17 13 7 13 7 21" />
                    <polyline points="7 3 7 8 15 8" />
                </svg>
                Muro
            </button>
            <button class="nav-item" onclick="showPanel('publicar')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="16" />
                    <line x1="8" y1="12" x2="16" y2="12" />
                </svg>
                Publicar
            </button>
        </nav>

        <div class="sidebar-foot">
            <div class="avatar-sm">
                @if(auth()->user()->foto)
                <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                    style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                @else
                {{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}
                @endif
            </div>
            <div class="foot-info">
                <div class="foot-name">{{ auth()->user()->nombre ?? 'Cliente' }}</div>
                <div class="foot-role">Cliente</div>
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
            <span class="topbar-title" id="topbarTitle">Inicio</span>
            <div class="topbar-actions">
                <button class="icon-btn" title="Notificaciones" onclick="showPanel('fila')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                        <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                    </svg>
                    <span class="notif-dot"></span>
                </button>
                <button class="icon-btn" title="Agendar" onclick="showPanel('agenda')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="content">

            <!-- ===== INICIO ===== -->
            <div class="panel active" id="panel-welcome">
                <div class="welcome-banner">
                    <div class="welcome-tag">Tu Espacio en BladeBarber</div>
                    <div class="welcome-title">Hola,<br> {{ auth()->user()->nombre ?? 'Cliente' }}</div>
                    <div class="welcome-sub">Bienvenido de vuelta. ¿Listo para tu próximo corte?</div>
                    <div class="welcome-time">
                        <div class="time" id="clock">--:--</div>
                        <div class="date" id="dateStr">--</div>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon stat-icon--violet">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                        </div>
                        <div class="stat-val">2</div>
                        <div class="stat-lbl">Citas Próximas</div>
                        <div class="stat-delta delta-up">↑ Próxima mañana</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon stat-icon--green">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 11 12 14 22 4" />
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                            </svg>
                        </div>
                        <div class="stat-val">14</div>
                        <div class="stat-lbl">Citas Totales</div>
                        <div class="stat-delta delta-up">↑ Cliente frecuente</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon stat-icon--amber">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="8" y1="6" x2="21" y2="6" />
                                <line x1="8" y1="12" x2="21" y2="12" />
                                <line x1="8" y1="18" x2="21" y2="18" />
                                <line x1="3" y1="6" x2="3.01" y2="6" />
                                <line x1="3" y1="12" x2="3.01" y2="12" />
                                <line x1="3" y1="18" x2="3.01" y2="18" />
                            </svg>
                        </div>
                        <div class="stat-val">#3</div>
                        <div class="stat-lbl">En la Fila Hoy</div>
                        <div class="stat-delta delta-neu">⏱ ~20 min espera</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon stat-icon--green">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                        </div>
                        <div class="stat-val">AB</div>
                        <div class="stat-lbl">Barbería Abierta</div>
                        <div class="stat-delta delta-up">↑ Hasta las 8 PM</div>
                    </div>
                </div>

                <div class="two-col">
                    <div class="card">
                        <div class="card-hd"><span class="card-hd-title">Tu Próxima Cita</span></div>
                        <div class="card-body">
                            <div class="list-item">
                                <div class="appt-date-box" style="margin-right:4px;">
                                    <div class="appt-date-day">07</div>
                                    <div class="appt-date-mon">May</div>
                                </div>
                                <div class="li-info">
                                    <div class="li-name">Corte + Barba</div>
                                    <div class="li-sub">10:00 AM · Barbero: Luis Mora</div>
                                </div>
                                <span class="badge badge--violet">Próxima</span>
                            </div>
                            <div class="list-item">
                                <div class="appt-date-box" style="margin-right:4px;">
                                    <div class="appt-date-day">15</div>
                                    <div class="appt-date-mon">May</div>
                                </div>
                                <div class="li-info">
                                    <div class="li-name">Corte Clásico</div>
                                    <div class="li-sub">2:30 PM · Barbero: Pedro Gómez</div>
                                </div>
                                <span class="badge badge--amber">Pendiente</span>
                            </div>
                            <div style="margin-top:14px;">
                                @if($filaActiva)
                                <div style="background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.3);
                                            border-radius:10px;padding:14px;text-align:center;">
                                    <div style="color:var(--red);font-weight:500;margin-bottom:6px;">Agendamiento deshabilitado</div>
                                    <div style="font-size:12px;color:var(--muted2);">La fila de espera virtual está activa.</div>
                                    <button class="btn-violet" style="margin-top:10px;width:100%;" onclick="showPanel('fila')">
                                        Ir a la fila de espera
                                    </button>
                                </div>
                                @else
                                <button class="btn-violet" style="width:100%;" onclick="showPanel('agenda')">
                                    Agendar Nueva Cita
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-hd"><span class="card-hd-title">Estado & Fila</span></div>
                        <div class="card-body">
                            <div class="shop-status shop-status--open">
                                <div class="status-dot status-dot--open"></div>
                                <div>
                                    <div class="status-text status-text--open">BARBERÍA ABIERTA</div>
                                    <div style="font-size:11px;color:var(--muted);">8:00 AM – 8:00 PM</div>
                                </div>
                            </div>
                            <div
                                style="background:var(--surface3);border-radius:10px;padding:14px;text-align:center;margin-bottom:14px;">
                                <div
                                    style="font-size:11px;color:var(--muted2);letter-spacing:1px;text-transform:uppercase;margin-bottom:4px;">
                                    Tu posición en la fila</div>
                                <div
                                    style="font-family:'Bebas Neue',sans-serif;font-size:48px;line-height:1;background:linear-gradient(135deg,var(--violet-light),var(--violet));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                                    #3</div>
                                <div style="font-size:12px;color:var(--muted2);">≈ 20 minutos de espera</div>
                            </div>
                            <button class="btn-outline" style="width:100%;" onclick="showPanel('fila')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="8" y1="6" x2="21" y2="6" />
                                    <line x1="8" y1="12" x2="21" y2="12" />
                                    <line x1="8" y1="18" x2="21" y2="18" />
                                    <line x1="3" y1="6" x2="3.01" y2="6" />
                                    <line x1="3" y1="12" x2="3.01" y2="12" />
                                    <line x1="3" y1="18" x2="3.01" y2="18" />
                                </svg>
                                Ver Fila Completa
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-hd">
                        <span class="card-hd-title">Últimas del Muro</span>
                        <button class="btn-outline" style="height:32px;padding:0 14px;font-size:12px;"
                            onclick="showPanel('muro')">Ver todo</button>
                    </div>
                    <div class="card-body">
                        <div class="list-item">
                            <div class="li-avatar">A</div>
                            <div class="li-info">
                                <div class="li-name">Admin BladeBarber</div>
                                <div class="li-sub">Hoy ya tenemos disponibilidad para citas express. ¡Pide la tuya!
                                </div>
                            </div>
                            <span class="badge badge--violet" style="white-space:nowrap;">Hace 2h</span>
                        </div>
                        <div class="list-item">
                            <div class="li-avatar">L</div>
                            <div class="li-info">
                                <div class="li-name">Luis Mora</div>
                                <div class="li-sub">Nuevas técnicas de fade disponibles esta semana 🔥</div>
                            </div>
                            <span class="badge badge--violet" style="white-space:nowrap;">Hace 5h</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== VER PERFIL ===== -->
            <div class="panel" id="panel-profile-view">
                <div class="profile-hero">
                    <div class="avatar-lg" onclick="showPanel('profile-edit')">
                        @if(auth()->user()->foto)
                        <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                            style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                        @else
                        {{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}
                        @endif
                        <div class="avatar-overlay">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                                <circle cx="12" cy="13" r="4" />
                            </svg>
                        </div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-name">{{ auth()->user()->nombre ?? 'Cliente' }}</div>
                        <div class="profile-email">{{ auth()->user()->email ?? 'cliente@gmail.com' }}</div>
                        <div class="profile-tags">
                            <span class="profile-tag">Cliente</span>
                            <span class="profile-tag">Frecuente</span>
                            <span class="profile-tag">Activo</span>
                        </div>
                    </div>
                </div>
                <div class="two-col">
                    <div class="card">
                        <div class="card-hd"><span class="card-hd-title">Información</span></div>
                        <div class="card-body">
                            <div class="list-item">
                                <div class="li-info">
                                    <div class="li-name">Nombre</div>
                                    <div class="li-sub">{{ auth()->user()->nombre ?? 'Cliente' }}</div>
                                </div>
                            </div>
                            <div class="list-item">
                                <div class="li-info">
                                    <div class="li-name">Correo</div>
                                    <div class="li-sub">{{ auth()->user()->email ?? 'Email' }}</div>
                                </div>
                            </div>
                            <div class="list-item">
                                <div class="li-info">
                                    <div class="li-name">Teléfono</div>
                                    <div class="li-sub">{{ auth()->user()->telefono ?? 'Telefono' }}</div>
                                </div>
                            </div>
                            <div class="list-item">
                                <div class="li-info">
                                    <div class="li-name">Miembro desde</div>
                                    <div class="li-sub">
                                        {{ auth()->user()?->created_at?->format('d M Y') ?? 'Enero 2024' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-hd"><span class="card-hd-title">Acciones</span></div>
                        <div class="card-body" style="display:flex;flex-direction:column;gap:10px;padding-top:18px;">
                            <button class="btn-violet" style="width:100%;" onclick="showPanel('profile-edit')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                                Editar Perfil
                            </button>
                            <button class="btn-outline" style="width:100%;" onclick="showPanel('change-pass')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" />
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                </svg>
                                Cambiar Contraseña
                            </button>
                            <button class="btn-outline" style="width:100%;" onclick="showPanel('mis-citas')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14 2 14 8 20 8" />
                                </svg>
                                Ver Mis Citas
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== EDITAR PERFIL ===== -->
            <div class="panel" id="panel-profile-edit">
                <div class="profile-hero" style="margin-bottom:20px;">
                    <div class="avatar-lg" style="cursor:pointer;">
                        @if(auth()->user()->foto)
                        <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                            style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                        @else
                        {{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}
                        @endif
                        <div class="avatar-overlay">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                                <circle cx="12" cy="13" r="4" />
                            </svg>
                        </div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-name">Editar Perfil</div>
                        <div class="profile-email">Haz clic en la foto para cambiarla</div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-hd"><span class="card-hd-title">Datos Personales</span></div>
                    <div class="card-body">
                        <div class="form-grid" style="gap:14px;">
                            <div class="field-wrap">
                                <label class="field-lbl">Nombre Completo</label>
                                <div class="field-box"><input type="text" value="Juan Pérez" placeholder="Tu nombre">
                                </div>
                            </div>
                            <div class="field-wrap">
                                <label class="field-lbl">Correo Electrónico</label>
                                <div class="field-box"><input type="email" value="juan.perez@email.com"></div>
                            </div>
                            <div class="field-wrap">
                                <label class="field-lbl">Usuario</label>
                                <div class="field-box"><input type="text" value="juanp" placeholder="usuario"></div>
                            </div>
                            <div class="field-wrap">
                                <label class="field-lbl">Teléfono</label>
                                <div class="field-box"><input type="tel" value="+57 300 123 4567"></div>
                            </div>
                            <div class="field-wrap form-full">
                                <label class="field-lbl">Foto de Perfil</label>
                                <label class="upload-btn"
                                    style="height:46px;border-radius:var(--radius);justify-content:center;cursor:pointer;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="18" height="18" rx="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <polyline points="21 15 16 10 5 21" />
                                    </svg>
                                    Seleccionar imagen
                                    <input type="file" accept="image/*">
                                </label>
                            </div>
                        </div>
                        <div class="form-actions" style="margin-top:18px;">
                            <button class="btn-violet" onclick="alert('Cambios guardados')">Guardar Cambios</button>
                            <button class="btn-outline" onclick="showPanel('profile-view')">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== CAMBIAR CONTRASEÑA ===== -->
            <div class="panel" id="panel-change-pass">
                <div class="card" style="max-width:460px;margin:0 auto;">
                    <div class="card-hd"><span class="card-hd-title">Cambiar Contraseña</span></div>
                    <div class="card-body">
                        <div style="display:flex;flex-direction:column;gap:14px;">
                            <div class="field-wrap">
                                <label class="field-lbl">Contraseña Actual</label>
                                <div class="field-box">
                                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <rect x="3" y="11" width="18" height="11" rx="2" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                    <input type="password" placeholder="••••••••" id="cp1">
                                    <button type="button" class="eye-btn" onclick="togglePwd('cp1')"><svg
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg></button>
                                </div>
                            </div>
                            <div class="field-wrap">
                                <label class="field-lbl">Nueva Contraseña</label>
                                <div class="field-box">
                                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <rect x="3" y="11" width="18" height="11" rx="2" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                    <input type="password" placeholder="••••••••" id="cp2"
                                        oninput="checkStrength(this.value)">
                                    <button type="button" class="eye-btn" onclick="togglePwd('cp2')"><svg
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
                                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <rect x="3" y="11" width="18" height="11" rx="2" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                    <input type="password" placeholder="••••••••" id="cp3" oninput="checkMatch()">
                                    <button type="button" class="eye-btn" onclick="togglePwd('cp3')"><svg
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg></button>
                                </div>
                                <div class="match-msg" id="matchMsg"></div>
                            </div>
                            <button class="btn-violet" style="margin-top:4px;"
                                onclick="alert('Contraseña actualizada')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" />
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                </svg>
                                Actualizar Contraseña
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== AGENDAR CITA ===== -->
            <div class="panel" id="panel-agenda">
                <div style="margin-bottom:22px;">
                    <div style="font-family:'Bebas Neue',sans-serif;font-size:26px;letter-spacing:2px;">Agendar Cita
                    </div>
                    <div style="font-size:13px;color:var(--muted2);">Reserva tu turno en pocos pasos</div>
                </div>

                <!-- Steps indicator -->
                <div class="appt-steps">
                    <div class="step-item">
                        <div class="step-circle active" id="sc1">1</div>
                        <div class="step-label active" id="sl1">Servicio</div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle" id="sc2">2</div>
                        <div class="step-label" id="sl2">Barbero</div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle" id="sc3">3</div>
                        <div class="step-label" id="sl3">Fecha & Hora</div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle" id="sc4">4</div>
                        <div class="step-label" id="sl4">Confirmar</div>
                    </div>
                </div>

                <!-- Step 1: Servicio -->
                <div class="step-content active" id="step1">
                    <div class="card">
                        <div class="card-hd">
                            <span class="card-hd-title">Elige tu servicio</span>
                            <span style="font-size:12px;color:var(--muted2);">Puedes elegir más de uno</span>
                        </div>
                        <div class="card-body">
                            <div class="service-grid" id="serviceGrid">
                                @forelse ($servicios as $servicio)
                                <div class="service-card" onclick="toggleService(this,
                                    {{ $servicio->id_servicio }},
                                    '{{ $servicio->nombre }}',
                                    {{ $servicio->precio }},
                                    {{ $servicio->duracion }})" data-id="{{ $servicio->id_servicio }}">

                                    <div class="service-check">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                    </div>

                                    <div class="service-name">✂ {{ $servicio->nombre }}</div>
                                    <div class="service-price">${{ number_format($servicio->precio, 0, ',', '.') }}
                                    </div>
                                    <div class="service-dur">{{ $servicio->duracion }} min · Servicio disponible</div>
                                </div>
                                @empty
                                <div style="text-align:center;color:var(--muted2);grid-column:1/-1;">
                                    No hay servicios disponibles
                                </div>
                                @endforelse
                            </div>

                            <!-- Barra resumen de selección -->
                            <div class="service-summary" id="serviceSummary" style="display:none;">
                                <div class="service-summary-chips" id="summaryChips"></div>
                                <div class="service-summary-totals">
                                    <div class="service-summary-total">
                                        <span class="summary-lbl">Duración</span>
                                        <span class="summary-val" id="sumTotalDur">0 min</span>
                                    </div>
                                    <div class="service-summary-total">
                                        <span class="summary-lbl">Total</span>
                                        <span class="summary-val summary-val--accent" id="sumTotalPrice">$0</span>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top:20px;text-align:right;">
                                <button class="btn-violet" id="btnStep2" onclick="goStep(2)" disabled
                                    style="opacity:.4;cursor:not-allowed;">
                                    Siguiente — Elegir Barbero
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="9 18 15 12 9 6" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Barbero -->
                <div class="step-content" id="step2">
                    <div class="card">
                        <div class="card-hd">
                            <span class="card-hd-title">Elige tu barbero</span>
                        </div>

                        <div class="card-body">

                            <div class="barber-pick-grid">

                                @forelse ($barberos as $barbero)
                                <div class="barber-pick"
                                    onclick="selectBarber(this, '{{ $barbero->usuario->nombre }}', {{ $barbero->id_barbero }})"
                                    data-id="{{ $barbero->id_barbero }}">

                                    {{-- Avatar --}}
                                    <div class="bp-avatar"
                                        style="overflow:hidden; display:flex; align-items:center; justify-content:center;">

                                        @if ($barbero->usuario->foto)
                                        <img src="{{ asset('storage/' . $barbero->usuario->foto) }}"
                                            style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                                        @else
                                        {{ strtoupper(substr($barbero->usuario->nombre, 0, 1)) }}
                                        @endif

                                    </div>

                                    {{-- Nombre --}}
                                    <div class="bp-name">
                                        {{ $barbero->usuario->nombre }}
                                    </div>
                                </div>
                                @empty
                                <div style="text-align:center;color:var(--muted2);grid-column:1/-1;">
                                    No hay barberos disponibles
                                </div>
                                @endforelse
                            </div>
                            <div style="margin-top:20px;display:flex;gap:10px;justify-content:space-between;">
                                <button class="btn-outline" onclick="goStep(1)">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="15 18 9 12 15 6" />
                                    </svg>
                                    Atrás
                                </button>

                                <button class="btn-violet" onclick="goStep(3)">
                                    Siguiente — Fecha & Hora
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="9 18 15 12 9 6" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Fecha & Hora -->
                <div class="step-content" id="step3">
                    <div class="card" style="margin-bottom:16px;">
                        <div class="card-hd">
                            <span class="card-hd-title">Selecciona el día</span>
                            <div style="display:flex;gap:8px;align-items:center;">
                                <button onclick="prevMonth()"
                                    style="background:var(--surface3);border:1px solid var(--border2);border-radius:8px;width:28px;height:28px;cursor:pointer;color:var(--muted2);display:flex;align-items:center;justify-content:center;"><svg
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        style="width:12px;height:12px;">
                                        <polyline points="15 18 9 12 15 6" />
                                    </svg></button>
                                <span id="calMonthLabel"
                                    style="font-size:13px;font-weight:500;min-width:100px;text-align:center;"></span>
                                <button onclick="nextMonth()"
                                    style="background:var(--surface3);border:1px solid var(--border2);border-radius:8px;width:28px;height:28px;cursor:pointer;color:var(--muted2);display:flex;align-items:center;justify-content:center;"><svg
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        style="width:12px;height:12px;">
                                        <polyline points="9 18 15 12 9 6" />
                                    </svg></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="calendar-grid" id="calGrid"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-hd"><span class="card-hd-title">Selecciona la hora</span></div>
                        <div class="card-body">
                            <div class="time-slots" id="timeSlots">
                                <div class="time-slot unavail">8:00</div>
                                <div class="time-slot" onclick="selectTime(this,'9:00')">9:00</div>
                                <div class="time-slot" onclick="selectTime(this,'9:30')">9:30</div>
                                <div class="time-slot unavail">10:00</div>
                                <div class="time-slot" onclick="selectTime(this,'10:30')">10:30</div>
                                <div class="time-slot" onclick="selectTime(this,'11:00')">11:00</div>
                                <div class="time-slot unavail">11:30</div>
                                <div class="time-slot" onclick="selectTime(this,'12:00')">12:00</div>
                                <div class="time-slot" onclick="selectTime(this,'14:00')">14:00</div>
                                <div class="time-slot" onclick="selectTime(this,'14:30')">14:30</div>
                                <div class="time-slot unavail">15:00</div>
                                <div class="time-slot" onclick="selectTime(this,'15:30')">15:30</div>
                                <div class="time-slot" onclick="selectTime(this,'16:00')">16:00</div>
                                <div class="time-slot" onclick="selectTime(this,'17:00')">17:00</div>
                                <div class="time-slot" onclick="selectTime(this,'17:30')">17:30</div>
                                <div class="time-slot" onclick="selectTime(this,'18:00')">18:00</div>
                            </div>
                            <div style="font-size:11px;color:var(--muted);margin-top:10px;display:flex;gap:14px;">
                                <span>⬜ Disponible</span>
                                <span style="color:var(--violet-light);">🟪 Seleccionado</span>
                                <span style="opacity:.5;">⬜̶ Ocupado</span>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top:16px;display:flex;gap:10px;justify-content:space-between;">
                        <button class="btn-outline" onclick="goStep(2)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="15 18 9 12 15 6" />
                            </svg>
                            Atrás
                        </button>
                        <button class="btn-violet" onclick="goStep(4)">
                            Siguiente — Confirmar
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="step-content" id="step4">
                    <div class="card">
                        <div class="card-hd"><span class="card-hd-title">Resumen de tu cita</span></div>
                        <div class="card-body">
                            <div class="appt-summary">
                                <div class="summary-row">
                                    <span class="summary-key">Servicio</span>
                                    <span class="summary-val highlight" id="sumService">—</span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-key">Barbero</span>
                                    <span class="summary-val" id="sumBarber">—</span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-key">Fecha</span>
                                    <span class="summary-val" id="sumDate">—</span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-key">Hora</span>
                                    <span class="summary-val" id="sumTime">—</span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-key">Duración</span>
                                    <span class="summary-val" id="sumDur">—</span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-key">Valor</span>
                                    <span class="summary-val highlight" id="sumPrice">—</span>
                                </div>
                            </div>

                            {{-- Formulario oculto que se envía al confirmar --}}
                            <form method="POST" action="{{ route('citas.store') }}" id="formCita">
                                @csrf
                                <input type="hidden" name="id_barbero" id="inputBarbero">
                                <input type="hidden" name="fecha_cita" id="inputFecha">
                                <input type="hidden" name="hora_cita" id="inputHora">
                                <div id="inputsServicios"></div>
                            </form>

                            <div
                                style="margin-top:20px;display:flex;gap:10px;justify-content:space-between;flex-wrap:wrap;">
                                <button class="btn-outline" onclick="goStep(3)">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="15 18 9 12 15 6" />
                                    </svg>
                                    Atrás
                                </button>
                                <button class="btn-violet" onclick="confirmarCita()">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="9 11 12 14 22 4" />
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                                    </svg>
                                    Confirmar Cita
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== MIS CITAS ===== -->
            <div class="panel" id="panel-mis-citas">
                <div
                    style="margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">
                    <div>
                        <div style="font-family:'Bebas Neue',sans-serif;font-size:26px;letter-spacing:2px;">Mis Citas
                        </div>
                        <div style="font-size:13px;color:var(--muted2);">Historial y próximas reservas</div>
                    </div>
                    <button class="btn-violet" onclick="showPanel('agenda')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Nueva Cita
                    </button>
                </div>
                <div class="my-appts">
                    @forelse($citas as $cita)
                    <div class="my-appt-card">
                        <div class="my-appt-top">
                            <div class="appt-date-box">
                                <div class="appt-date-day">
                                    {{ \Carbon\Carbon::parse($cita->fecha_cita)->format('d') }}
                                </div>
                                <div class="appt-date-mon">
                                    {{ \Carbon\Carbon::parse($cita->fecha_cita)->translatedFormat('M') }}
                                </div>
                            </div>

                            <div class="appt-detail">
                                <div class="appt-title">
                                    {{ $cita->servicios->pluck('nombre')->join(' + ') }}
                                </div>
                                <div class="appt-meta">
                                    {{ \Carbon\Carbon::parse($cita->hora_cita)->format('h:i A') }}
                                    · {{ $cita->barbero->usuario->nombre ?? 'Barbero' }}
                                    · {{ $cita->servicios->sum('duracion') ?? '60' }} min
                                </div>
                            </div>
                            @if($cita->estado === 'Reprogramada')
                            @php $ultima = $cita->reprogramaciones->first() @endphp
                            @if($ultima)
                            <div style="font-size:11px;color:var(--muted2);margin-top:4px;">
                                Motivo: {{ $ultima->motivo }}
                            </div>
                            <div style="font-size:11px;color:var(--muted2);">
                                Antes: {{ \Carbon\Carbon::parse($ultima->hora_original)->format('d/m H:i') }}
                                → {{ \Carbon\Carbon::parse($ultima->hora_nueva)->format('d/m H:i') }}
                            </div>
                            @endif
                            @endif
                            @if($cita->estado === 'Completada' && !$cita->resena)
                            <a href="{{ route('resena.show', $cita->id_cita) }}"
                                class="btn-violet"
                                style="height:32px;padding:0 14px;font-size:12px;
                                    display:inline-flex;align-items:center;gap:6px;
                                    text-decoration:none;">
                                ★ Calificar
                            </a>
                            @elseif($cita->estado === 'Completada' && $cita->resena)
                            <span style="font-size:12px;color:var(--muted2);
                                        display:inline-flex;align-items:center;gap:4px;">
                                ★ {{ number_format($cita->resena->promedio, 1) }} Reseñado
                            </span>
                            @endif
                            <span class="badge badge--violet">
                                {{ $cita->estado ?? 'Pendiente' }}
                            </span>
                        </div>

                        <div class="my-appt-footer">
                            <span style="font-size:13px;color:var(--muted2);">
                                ${{ number_format($cita->servicios->sum('precio'), 0, ',', '.') }}
                            </span>

                            <div style="margin-left:auto;display:flex;gap:8px;">
                                @if(in_array($cita->estado, ['Pendiente', 'Confirmada', 'Reprogramada']))
                                <form method="POST" action="{{ route('citas.cancelar', $cita->id_cita) }}"
                                    onsubmit="return confirm('¿Seguro que deseas cancelar esta cita?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-outline"
                                        style="height:32px;padding:0 14px;font-size:12px;
               border-color:rgba(248,113,113,0.3);color:var(--red);">
                                        Cancelar
                                    </button>
                                </form>
                                @endif
                                @if(in_array($cita->estado, ['Pendiente', 'Confirmada', 'Reprogramada']))
                                <a href="{{ route('citas.reprogramar.form', $cita->id_cita) }}"
                                    class="btn-outline"
                                    style="height:32px;padding:0 14px;font-size:12px;
              border-color:rgba(139,92,246,0.4);
              color:var(--violet-light);
              display:inline-flex;align-items:center;
              text-decoration:none;">
                                    Reprogramar
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <p style="color:var(--muted2);">No tienes citas registradas.</p>
                    @endforelse
                </div>
            </div>

            <!-- ===== FILA DE ESPERA ===== -->
            <div class="panel" id="panel-fila">
                <div style="margin-bottom:20px;">
                    <div style="font-family:'Bebas Neue',sans-serif;font-size:26px;letter-spacing:2px;">Fila de Espera</div>
                    <div style="font-size:13px;color:var(--muted2);">Turno virtual en tiempo real</div>
                </div>

                @php
                $filaActiva = \App\Models\ConfiguracionFila::vigente();
                $idCliente = auth()->user()->cliente->id_cliente ?? null;
                $miTurno = $idCliente ? \App\Models\FilaEspera::with('servicios')
                ->where('id_cliente', $idCliente)
                ->whereIn('estado', ['esperando','asignado','en_atencion'])
                ->first() : null;
                $totalFila = \App\Models\FilaEspera::whereIn('estado',['esperando','asignado','en_atencion'])->count();
                @endphp

                @if(!$filaActiva)
                {{-- Fila inactiva --}}
                <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);
            border-radius:12px;padding:28px;text-align:center;margin-bottom:20px;">
                    <div style="font-size:14px;color:var(--muted2);margin-bottom:6px;">
                        La fila de espera no está disponible ahora.
                    </div>
                    <div style="font-size:12px;color:var(--muted);">
                        Puedes agendar tu cita de manera normal.
                    </div>
                    <button class="btn-violet" style="margin-top:14px;" onclick="showPanel('agenda')">
                        Agendar Cita
                    </button>
                </div>

                @elseif($miTurno)
                {{-- Ya estoy en la fila --}}
                <div class="queue-hero">
                    <div class="queue-label">Tu posición actual</div>
                    <div class="queue-number">#{{ $miTurno->posicion }}</div>
                    <div style="font-size:14px;color:var(--muted2);">
                        Hay {{ $miTurno->posicion - 1 }} {{ $miTurno->posicion - 1 === 1 ? 'persona' : 'personas' }} antes que tú
                    </div>
                    <div class="queue-status-row">
                        <div class="queue-pill">
                            <div class="queue-dot"></div>
                            {{ ucfirst(str_replace('_',' ', $miTurno->estado)) }}
                        </div>
                        <div class="queue-pill">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            ~{{ ($miTurno->posicion - 1) * 20 }} min
                        </div>
                    </div>
                    <div style="margin-top:10px;font-size:12px;color:var(--muted2);">
                        Servicios: {{ $miTurno->servicios->pluck('nombre')->join(', ') }}
                    </div>
                    <div style="margin-top:16px;position:relative;z-index:10;">
                        <form method="POST" action="{{ route('fila.salir') }}"
                            onsubmit="return confirm('¿Seguro que quieres salir de la fila?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="btn-outline"
                                style="border-color:rgba(248,113,113,0.3);color:var(--red);
                   position:relative;z-index:10;pointer-events:all;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    style="width:15px;height:15px;">
                                    <line x1="18" y1="6" x2="6" y2="18" />
                                    <line x1="6" y1="6" x2="18" y2="18" />
                                </svg>
                                Salir de la fila
                            </button>
                        </form>
                    </div>
                </div>

                @else
                {{-- Fila activa pero cliente no está --}}
                <div class="join-queue-card">
                    <div class="big-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="8" y1="6" x2="21" y2="6" />
                            <line x1="8" y1="12" x2="21" y2="12" />
                            <line x1="8" y1="18" x2="21" y2="18" />
                            <line x1="3" y1="6" x2="3.01" y2="6" />
                        </svg>
                    </div>
                    <h3>¿Listo para hacer fila?</h3>
                    <p>Hay {{ $totalFila }} {{ $totalFila === 1 ? 'persona' : 'personas' }} en espera ahora</p>

                    <form method="POST" action="{{ route('fila.ingresar') }}"
                        style="display:flex;flex-direction:column;align-items:center;gap:14px;width:100%;max-width:300px;margin:0 auto;">
                        @csrf
                        <div class="field-wrap" style="width:100%;">
                            <label class="field-lbl">Selecciona tus servicios</label>
                            @foreach($servicios as $srv)
                            <label style="display:flex;align-items:center;gap:8px;margin-top:8px;
                          font-size:13px;cursor:pointer;color:var(--text);">
                                <input type="checkbox" name="servicios[]" value="{{ $srv->id_servicio }}"
                                    style="accent-color:var(--violet);">
                                {{ $srv->nombre }}
                                <span style="color:var(--muted2);font-size:11px;">
                                    ${{ number_format($srv->precio, 0, ',', '.') }}
                                </span>
                            </label>
                            @endforeach
                        </div>

                        @if($errors->has('servicios'))
                        <div style="color:#f87171;font-size:12px;">{{ $errors->first('servicios') }}</div>
                        @endif

                        <button type="submit" class="btn-violet" style="width:100%;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Unirme a la Fila
                        </button>
                    </form>
                </div>
                @endif

                {{-- Lista fila actual (siempre visible) --}}
                <div class="card" style="margin-top:20px;">
                    <div class="card-hd">
                        <span class="card-hd-title">Fila Actual</span>
                        <span class="badge badge--violet">{{ $totalFila }} en espera</span>
                    </div>
                    <div class="card-body" style="padding:14px 16px;">
                        @forelse(\App\Models\FilaEspera::with('cliente.usuario')
                        ->whereIn('estado',['esperando','asignado','en_atencion'])
                        ->orderBy('posicion')->get() as $t)
                        @php $esMio = $idCliente && $t->id_cliente == $idCliente; @endphp
                        <div class="queue-item {{ $esMio ? 'is-me' : '' }}">
                            <div class="queue-pos {{ $esMio ? 'is-me' : '' }}">{{ $t->posicion }}</div>
                            <div class="queue-info">
                                <div class="queue-name {{ $esMio ? 'is-me' : '' }}">
                                    {{ $esMio ? (($t->cliente->usuario->nombre ?? '—') . ' · (Tú)') : 'Cliente #'.$t->posicion }}
                                </div>
                                <div class="queue-detail">{{ ucfirst(str_replace('_',' ',$t->estado)) }}</div>
                            </div>
                            <div class="queue-wait">
                                <strong>~{{ ($t->posicion - 1) * 20 }} min</strong>
                                {{ $t->estado === 'en_atencion' ? 'atendiendo' : 'espera' }}
                            </div>
                        </div>
                        @empty
                        <div style="text-align:center;padding:20px;color:var(--muted2);font-size:13px;">
                            La fila está vacía
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- ===== BARBEROS ===== -->
            @foreach($barberos as $barbero)
            <div class="barber-card">
                <div class="barber-card-top">
                    <div class="barber-avatar">
                        @if($barbero->usuario->foto)
                        <img src="{{ asset('storage/' . $barbero->usuario->foto) }}"
                            style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                        @else
                        {{ strtoupper(substr($barbero->usuario->nombre, 0, 1)) }}
                        @endif
                    </div>
                    <div>
                        <div class="barber-name">{{ $barbero->usuario->nombre }}</div>
                        <div class="barber-spec">{{ $barbero->usuario->especialidad ?? 'Barbero' }}</div>
                        {{-- Promedio en tiempo real --}}
                        @php $prom = $barbero->promedioCalificacion(); @endphp
                        <div style="display:flex;align-items:center;gap:4px;margin-top:4px;">
                            <span style="color:#C9A84C;font-size:14px;">
                                @for($s = 1; $s <= 5; $s++)
                                    {{ $s <= round($prom) ? '★' : '☆' }}
                                    @endfor
                                    </span>
                                    <span style="font-size:12px;color:var(--muted2);">
                                        {{ $prom > 0 ? $prom : 'Sin reseñas' }}
                                        @if($prom > 0)
                                        ({{ $barbero->resenas->count() }})
                                        @endif
                                    </span>
                        </div>
                    </div>
                </div>
                <div style="display:flex;gap:8px;margin-top:12px;">
                    <button class="btn-violet" style="flex:1;height:38px;font-size:13px;"
                        onclick="showPanel('agenda')">
                        Agendar
                    </button>
                    <a href="{{ route('barbero.resenas', $barbero->id_barbero) }}"
                        class="btn-outline"
                        style="height:38px;padding:0 14px;font-size:12px;
              display:inline-flex;align-items:center;text-decoration:none;">
                        Ver reseñas
                    </a>
                </div>
            </div>
            @endforeach
            
            <!-- ===== MURO ===== -->
            <div class="panel" id="panel-muro">
                <div style="margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">
                    <div>
                        <div style="font-family:'Bebas Neue',sans-serif;font-size:26px;letter-spacing:2px;">Muro</div>
                        <div style="font-size:13px;color:var(--muted2);">Publicaciones de la comunidad BladeBarber</div>
                    </div>
                    <button class="btn-violet" onclick="showPanel('publicar')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="16" />
                            <line x1="8" y1="12" x2="16" y2="12" />
                        </svg>
                        Publicar
                    </button>
                </div>

                {{-- ─── FILTROS ─── --}}
                <div id="muroFiltros" style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">

                    {{-- Todos --}}
                    <button class="filtro-btn filtro-activo" data-filtro="todos" onclick="filtrarMuro(this,'todos')">
                        Todos
                    </button>

                    {{-- Admin --}}
                    <button class="filtro-btn" data-filtro="admin" onclick="filtrarMuro(this,'admin')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            style="width:13px;height:13px;">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                        </svg>
                        Administrador
                    </button>

                    {{-- Un botón por cada barbero --}}
                    @foreach($publicaciones->filter(fn($p) => optional($p->muro->usuario)->rol === 'barbero')
                    ->unique(fn($p) => $p->muro->usuario->id_usuario) as $pub)
                    @php $u = $pub->muro->usuario; @endphp
                    <button class="filtro-btn"
                        data-filtro="barbero-{{ $u->id_usuario }}"
                        onclick="filtrarMuro(this,'barbero-{{ $u->id_usuario }}')">
                        @if($u->foto)
                        <img src="{{ asset('storage/' . $u->foto) }}"
                            style="width:20px;height:20px;border-radius:50%;object-fit:cover;">
                        @else
                        <span style="width:20px;height:20px;border-radius:50%;
                   background:rgba(139,92,246,0.25);color:var(--violet-light);
                   font-size:11px;font-weight:600;
                   display:inline-flex;align-items:center;justify-content:center;">
                            {{ strtoupper(substr($u->nombre, 0, 1)) }}
                        </span>
                        @endif
                        {{ explode(' ', $u->nombre)[0] }}
                    </button>
                    @endforeach
                </div>
                <div class="posts-list" id="postsLista">
                    @forelse($publicaciones as $pub)
                    @php
                    $usuario = $pub->muro->usuario;
                    $rol = strtolower($usuario->rol ?? 'cliente');
                    $inicial = strtoupper(substr($usuario->nombre, 0, 1));
                    $esMio = $usuario->id_usuario === auth()->id();
                    $badgeClass = match($rol) {
                    'admin' => 'badge--violet',
                    'barbero' => 'badge--green',
                    default => 'badge--amber',
                    };
                    $badgeLabel = match($rol) {
                    'admin' => 'Admin',
                    'barbero' => 'Barbero',
                    default => 'Cliente',
                    };
                    // data-attr para el filtro JS
                    $dataFiltro = $rol === 'barbero'
                    ? 'barbero-' . $usuario->id_usuario
                    : $rol; // 'admin' o 'cliente'
                    @endphp

                    <div class="post-card"
                        data-rol="{{ $dataFiltro }}">

                        <div class="post-head">
                            @if($usuario->foto)
                            <div class="li-avatar" style="padding:0;overflow:hidden;">
                                <img src="{{ asset('storage/' . $usuario->foto) }}"
                                    style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                            </div>
                            @else
                            <div class="li-avatar">{{ $inicial }}</div>
                            @endif

                            <div class="post-meta">
                                <div class="post-author">
                                    {{ $usuario->nombre }}
                                    @if($esMio)<span style="color:var(--muted2);font-size:11px;"> · (Tú)</span>@endif
                                </div>
                                <div class="post-time">{{ $pub->fecha->diffForHumans() }}</div>
                            </div>

                            <span class="badge {{ $badgeClass }}">{{ $badgeLabel }}</span>

                            @if($esMio)
                            <form method="POST"
                                action="{{ route('publicacion.destroy', $pub->id_publicacion) }}"
                                style="margin-left:auto;">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    style="background:none;border:none;cursor:pointer;
                         color:var(--muted);padding:4px;border-radius:6px;"
                                    title="Eliminar">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        style="width:15px;height:15px;">
                                        <polyline points="3 6 5 6 21 6" />
                                        <path d="M19 6l-1 14H6L5 6" />
                                        <path d="M10 11v6M14 11v6" />
                                        <path d="M9 6V4h6v2" />
                                    </svg>
                                </button>
                            </form>
                            @endif
                        </div>

                        @if($pub->imagenes->count())
                        <img src="{{ asset('storage/' . $pub->imagenes->first()->imagen) }}"
                            style="width:100%;max-height:300px;object-fit:cover;">
                        @endif

                        <div class="post-body">
                            <p class="post-text">{{ $pub->contenido }}</p>
                        </div>

                        <div class="post-footer">
                            <button class="post-action" onclick="likePost(this)">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                                </svg>
                                <span>0</span>
                            </button>
                            <button class="post-action"
                                onclick="toggleComment(this,'c{{ $pub->id_publicacion }}')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                </svg>
                                <span>0</span>
                            </button>
                        </div>

                        <div class="comment-box" id="c{{ $pub->id_publicacion }}"
                            style="display:none;padding:12px 16px;border-top:1px solid var(--border2);">
                            <div style="display:flex;gap:8px;">
                                <div class="li-avatar" style="flex-shrink:0;">
                                    {{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}
                                </div>
                                <div class="field-box" style="flex:1;height:38px;">
                                    <input type="text" placeholder="Escribe un comentario..." style="ffont-size:13px;">
                                </div>
                                <button class="btn-violet"
                                    style="height:38px;padding:0 14px;font-size:12px;"
                                    onclick="addComment(this)">Enviar</button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div style="text-align:center;padding:40px;color:var(--muted2);">
                        No hay publicaciones aún. ¡Sé el primero en publicar!
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- ===== NUEVA PUBLICACIÓN ===== -->
            <div class="panel" id="panel-publicar">
                <div style="margin-bottom:20px;">
                    <div style="font-family:'Bebas Neue',sans-serif;font-size:26px;letter-spacing:2px;">Nueva
                        Publicación</div>
                    <div style="font-size:13px;color:var(--muted2);">Comparte con la comunidad BladeBarber</div>
                </div>
                <div class="card" style="max-width:600px;">
                    <div class="card-body" style="padding:22px;">
                        <div style="display:flex;flex-direction:column;gap:16px;">
                            <div class="field-wrap">
                                <label class="field-lbl">¿Qué quieres compartir?</label>
                                <textarea class="field-ta" id="postContent"
                                    placeholder="Comparte tu experiencia, una foto de tu corte, una recomendación..."
                                    style="min-height:130px;"></textarea>
                            </div>
                            <div class="field-wrap">
                                <label class="field-lbl">Imagen (opcional)</label>
                                <label class="upload-btn"
                                    style="height:46px;border-radius:var(--radius);justify-content:center;cursor:pointer;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="18" height="18" rx="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <polyline points="21 15 16 10 5 21" />
                                    </svg>
                                    Seleccionar imagen
                                    <input type="file" accept="image/*" onchange="previewPostImg(event)">
                                </label>
                                <div class="post-preview-img" id="postPreview"><img id="postPreviewImg" src=""
                                        alt="Preview"></div>
                            </div>
                            <div class="form-actions">
                                <button class="btn-violet" onclick="publicar()">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="22" y1="2" x2="11" y2="13" />
                                        <polygon points="22 2 15 22 11 13 2 9 22 2" />
                                    </svg>
                                    Publicar
                                </button>
                                <button class="btn-outline" onclick="showPanel('muro')">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        const APP_URL = '{{ url("") }}';
    </script>
    <script src="/BladeBarber/public/js/cliente-dash.js"></script>
    <script src="/BladeBarber/public/js/cliente-dash.js"></script>
</body>

</html>