<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel Barbero — BarberOS</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/BladeBarber/public/css/barber-dash.css">
</head>
<body>
<div class="bg-scene"><div class="bg-grain"></div><div class="bg-glow bg-glow--1"></div><div class="bg-glow bg-glow--2"></div></div>
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-head">
    <div class="logo-box">
      <svg viewBox="0 0 24 24" fill="none" stroke="#0E0E0E" stroke-width="2.2"><path d="M3 6h18M3 12h18M3 18h18"/><circle cx="8" cy="6" r="2" fill="#0E0E0E" stroke="none"/><circle cx="16" cy="12" r="2" fill="#0E0E0E" stroke="none"/><circle cx="8" cy="18" r="2" fill="#0E0E0E" stroke="none"/></svg>
    </div>
    <div><div class="logo-text">BarberOS</div><div class="logo-role">Barbero</div></div>
  </div>
  <nav class="nav-section">
    <div class="nav-label">Principal</div>
    <button class="nav-item active" onclick="showPanel('welcome')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
      Bienvenida
    </button>
    <div class="nav-label">Perfil</div>
    <button class="nav-item" onclick="showPanel('profile-view')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
      Ver Perfil
    </button>
    <button class="nav-item" onclick="showPanel('profile-edit')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
      Editar Perfil
    </button>
    <button class="nav-item" onclick="showPanel('change-pass')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
      Cambiar Contraseña
    </button>
    <div class="nav-label">Publicaciones</div>
    <button class="nav-item" onclick="showPanel('posts-wall')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10l6 6v8a2 2 0 0 1-2 2z"/></svg>
      Muro
    </button>
    <button class="nav-item" onclick="showPanel('post-create')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
      Nueva Publicación
    </button>
    <div class="nav-label">Barberos</div>
    <button class="nav-item" onclick="showPanel('barbers-list')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      Equipo
      <span class="nav-badge">4</span>
    </button>
    <div class="nav-label">Agenda</div>
    <button class="nav-item" onclick="showPanel('agenda')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
      Mi Agenda
      <span class="nav-badge">5</span>
    </button>
    <button class="nav-item" onclick="showPanel('my-schedule')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      Mi Horario
    </button>
    <div class="nav-label">Barbería</div>
    <button class="nav-item" onclick="showPanel('barberia')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
      Estado Local
    </button>
  </nav>
  <div class="sidebar-foot">
    <div class="avatar-sm">{{ substr(auth()->user()->name ?? 'B', 0, 1) }}</div>
    <div class="foot-info">
      <div class="foot-name">{{ auth()->user()->name ?? 'Barbero' }}</div>
      <div class="foot-role">BARBERO</div>
    </div>
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
      @csrf
      <button class="logout-btn" type="submit">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
      </button>
    </form>
  </div>
</aside>

<!-- MAIN -->
<div class="main">
  <div class="topbar">
    <button class="mob-menu-btn" onclick="openSidebar()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <span class="topbar-title" id="topbarTitle">Bienvenida</span>
    <div class="topbar-actions">
      <button class="icon-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></button>
    </div>
  </div>
  <div class="content">

    <!-- WELCOME -->
    <div class="panel active" id="panel-welcome">
      <div class="welcome-banner">
        <div class="welcome-tag">Panel del Barbero</div>
        <div class="welcome-title">Hola,<br>{{ auth()->user()->name ?? 'Barbero' }}</div>
        <div class="welcome-sub">Tienes <strong style="color:var(--gold);">5 citas</strong> programadas para hoy.</div>
        <div class="welcome-time">
          <div class="time" id="clock">--:--</div>
          <div class="date" id="dateStr">--</div>
        </div>
      </div>
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon stat-icon--gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
          <div class="stat-val">5</div><div class="stat-lbl">Citas Hoy</div>
          <div class="stat-delta delta-up">↑ 2 vs ayer</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon stat-icon--green"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
          <div class="stat-val">$380K</div><div class="stat-lbl">Ingresos Hoy</div>
          <div class="stat-delta delta-up">↑ Buen día</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon stat-icon--blue"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></div>
          <div class="stat-val">4.9</div><div class="stat-lbl">Mi Rating</div>
          <div class="stat-delta delta-up">Top barbero</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon stat-icon--gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
          <div class="stat-val">43</div><div class="stat-lbl">Clientes Atendidos</div>
          <div class="stat-delta delta-up">Este mes</div>
        </div>
      </div>
      <div class="two-col">
        <div class="card">
          <div class="card-hd"><span class="card-hd-title">Mis Próximas Citas</span></div>
          <div class="card-body">
            @foreach([['Carlos R.','Corte + Barba','09:00'],['Miguel T.','Fade','10:30'],['Juan L.','Diseño','12:00']] as $c)
            <div class="list-item">
              <div class="li-avatar">{{ substr($c[0],0,1) }}</div>
              <div class="li-info"><div class="li-name">{{ $c[0] }}</div><div class="li-sub">{{ $c[1] }}</div></div>
              <span class="badge badge--gold">{{ $c[2] }}</span>
            </div>
            @endforeach
          </div>
        </div>
        <div class="card">
          <div class="card-hd"><span class="card-hd-title">Estado del Local</span></div>
          <div class="card-body">
            <div class="shop-status shop-status--open">
              <div class="status-dot status-dot--open"></div>
              <div><div class="status-text--open">ABIERTA</div><div style="font-size:11px;color:var(--muted);">Info del admin</div></div>
            </div>
            <div style="font-size:12px;color:var(--muted);margin-top:12px;text-align:center;">Solo el admin puede cambiar el estado</div>
          </div>
        </div>
      </div>
    </div>

    <!-- VER PERFIL -->
    <div class="panel" id="panel-profile-view">
      <div class="profile-hero">
        <div class="avatar-lg">{{ substr(auth()->user()->name ?? 'B', 0, 1) }}<div class="avatar-overlay"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg></div></div>
        <div class="profile-info">
          <div class="profile-name">{{ auth()->user()->name ?? 'Barbero' }}</div>
          <div class="profile-email">{{ auth()->user()->email ?? 'barbero@barberos.com' }}</div>
          <div class="profile-tags"><span class="profile-tag">Barbero</span><span class="profile-tag">{{ auth()->user()->specialty ?? 'Fade & Barba' }}</span><span class="profile-tag">Activo</span></div>
        </div>
      </div>
      <div class="two-col">
        <div class="card">
          <div class="card-hd"><span class="card-hd-title">Información</span></div>
          <div class="card-body">
            <div class="list-item"><div class="li-info"><div class="li-name">Nombre</div><div class="li-sub">{{ auth()->user()->name }}</div></div></div>
            <div class="list-item"><div class="li-info"><div class="li-name">Correo</div><div class="li-sub">{{ auth()->user()->email }}</div></div></div>
            <div class="list-item"><div class="li-info"><div class="li-name">Especialidad</div><div class="li-sub">{{ auth()->user()->specialty ?? 'Fade & Barba' }}</div></div></div>
            <div class="list-item"><div class="li-info"><div class="li-name">Teléfono</div><div class="li-sub">{{ auth()->user()->phone ?? '+57 300 000 0000' }}</div></div></div>
          </div>
        </div>
        <div class="card">
          <div class="card-hd"><span class="card-hd-title">Acciones</span></div>
          <div class="card-body" style="display:flex;flex-direction:column;gap:10px;padding-top:20px;">
            <button class="btn-gold" onclick="showPanel('profile-edit')" style="width:100%;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              Editar Perfil
            </button>
            <button class="btn-outline" onclick="showPanel('change-pass')" style="width:100%;">Cambiar Contraseña</button>
          </div>
        </div>
      </div>
    </div>

    <!-- EDITAR PERFIL -->
    <div class="panel" id="panel-profile-edit">
      <div class="profile-hero" style="margin-bottom:24px;">
        <div class="avatar-lg" onclick="document.getElementById('avatarInput').click()">
          {{ substr(auth()->user()->name ?? 'B', 0, 1) }}
          <div class="avatar-overlay"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg></div>
          <input type="file" id="avatarInput" accept="image/*" style="display:none" onchange="previewAvatar(event)">
        </div>
        <div class="profile-info"><div class="profile-name">Editar Perfil</div><div class="profile-email">Toca la foto para cambiarla</div></div>
      </div>
      <div class="card">
        <div class="card-hd"><span class="card-hd-title">Datos Personales</span></div>
        <div class="card-body">
          <form action="{{ route('barber.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-grid" style="gap:16px;">
              <div class="field-wrap"><label class="field-lbl">Nombre</label><div class="field-box"><input type="text" name="name" value="{{ auth()->user()->name }}" placeholder="Tu nombre completo"></div></div>
              <div class="field-wrap"><label class="field-lbl">Correo</label><div class="field-box"><input type="email" name="email" value="{{ auth()->user()->email }}"></div></div>
              <div class="field-wrap"><label class="field-lbl">Teléfono</label><div class="field-box"><input type="tel" name="phone" value="{{ auth()->user()->phone }}" placeholder="+57 300 000 0000"></div></div>
              <div class="field-wrap"><label class="field-lbl">Especialidad</label><div class="field-box"><select name="specialty"><option>Fade & Barba</option><option>Corte Clásico</option><option>Diseño y Coloración</option><option>Moderno</option></select></div></div>
              <div class="field-wrap form-full"><label class="field-lbl">Descripción</label><textarea class="field-ta" name="bio" placeholder="Tu experiencia y habilidades...">{{ auth()->user()->bio }}</textarea></div>
              <div class="field-wrap form-full"><label class="field-lbl">Foto de Perfil</label><div class="field-box"><input type="file" name="avatar" accept="image/*"></div></div>
            </div>
            <div class="form-actions" style="margin-top:20px;">
              <button type="submit" class="btn-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>Guardar</button>
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
              <div class="field-wrap"><label class="field-lbl">Contraseña Actual</label><div class="field-box"><svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg><input type="password" name="current_password" placeholder="••••••••" id="cp1"><button type="button" class="eye-btn" onclick="togglePwd('cp1')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button></div></div>
              <div class="field-wrap"><label class="field-lbl">Nueva Contraseña</label><div class="field-box"><svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg><input type="password" name="password" placeholder="••••••••" id="cp2" oninput="checkStrength(this.value)"><button type="button" class="eye-btn" onclick="togglePwd('cp2')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button></div><div class="strength-bar"><div class="strength-fill" id="strBar"></div></div><div class="strength-text" id="strText"></div></div>
              <div class="field-wrap"><label class="field-lbl">Confirmar</label><div class="field-box"><svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg><input type="password" name="password_confirmation" placeholder="••••••••" id="cp3" oninput="checkMatch()"><button type="button" class="eye-btn" onclick="togglePwd('cp3')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button></div><div class="match-msg" id="matchMsg"></div></div>
              <button type="submit" class="btn-gold">Actualizar Contraseña</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- MURO -->
    <div class="panel" id="panel-posts-wall">
      <div style="margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;">
        <div><div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Muro</div><div style="font-size:13px;color:var(--muted2);">Publicaciones de la barbería</div></div>
        <button class="btn-gold" onclick="showPanel('post-create')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>Publicar</button>
      </div>
      <div class="posts-list">
        @forelse($posts ?? [] as $post)
        <div class="post-card">
          <div class="post-head">
            <div class="li-avatar">{{ substr($post->user->name,0,1) }}</div>
            <div class="post-meta"><div class="post-author">{{ $post->user->name }}</div><div class="post-time">{{ $post->created_at->diffForHumans() }}</div></div>
            @if($post->user_id === auth()->id())
            <form action="{{ route('barber.posts.destroy',$post->id) }}" method="POST"><@csrf @method('DELETE')<button class="post-del" type="submit"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/></svg></button></form>
            @endif
          </div>
          @if($post->image)<img src="{{ asset('storage/'.$post->image) }}" alt="" class="post-img">@endif
          <div class="post-body"><p class="post-text">{{ $post->content }}</p></div>
          <div class="post-footer"><button class="post-action"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>{{ $post->likes_count ?? 0 }}</button></div>
        </div>
        @empty
        <div class="post-card">
          <div class="post-head"><div class="li-avatar">A</div><div class="post-meta"><div class="post-author">Admin</div><div class="post-time">hace 1 hora</div></div></div>
          <div class="post-body"><p class="post-text">¡Equipo, recuerden que hoy tenemos día de promociones! Corte + barba a precio especial. ✂️</p></div>
          <div class="post-footer"><button class="post-action"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>12</button></div>
        </div>
        @endforelse
      </div>
    </div>

    <!-- NUEVA PUBLICACIÓN -->
    <div class="panel" id="panel-post-create">
      <div style="margin-bottom:20px;"><div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Nueva Publicación</div></div>
      <div class="card" style="max-width:600px;">
        <div class="card-body" style="padding:24px;">
          <form action="{{ route('barber.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display:flex;flex-direction:column;gap:16px;">
              <div class="field-wrap"><label class="field-lbl">Contenido</label><textarea class="field-ta" name="content" placeholder="¿Qué quieres compartir?" style="min-height:120px;"></textarea></div>
              <div class="field-wrap">
                <label class="field-lbl">Imagen (opcional)</label>
                <label class="upload-btn" style="height:48px;border-radius:var(--radius);justify-content:center;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>Seleccionar imagen<input type="file" name="image" accept="image/*" onchange="previewPost(event)"></label>
                <div class="post-preview-img" id="postPreview"><img id="postPreviewImg" src="" alt=""></div>
              </div>
              <div class="form-actions"><button type="submit" class="btn-gold"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>Publicar</button><button type="button" class="btn-outline" onclick="showPanel('posts-wall')">Cancelar</button></div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- LISTA BARBEROS (solo lectura para barbero) -->
    <div class="panel" id="panel-barbers-list">
      <div style="margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
        <div><div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Equipo de Barberos</div><div style="font-size:13px;color:var(--muted2);">Conoce a tus compañeros</div></div>
        <div class="search-box" style="max-width:240px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg><input type="text" placeholder="Buscar..."></div>
      </div>
      <div class="barbers-grid">
        @forelse($barbers ?? [] as $barber)
        <div class="barber-card">
          <div class="barber-card-top">
            <div class="barber-avatar">@if($barber->avatar)<img src="{{ asset('storage/'.$barber->avatar) }}" alt="">@else{{ substr($barber->name,0,1) }}@endif</div>
            <div><div class="barber-name">{{ $barber->name }}</div><div class="barber-spec">{{ $barber->specialty ?? 'Barbero' }}</div><span class="badge {{ $barber->active ? 'badge--green' : 'badge--red' }}">{{ $barber->active ? 'Activo' : 'Inactivo' }}</span></div>
          </div>
          <div class="barber-stats">
            <div class="barber-stat"><div class="barber-stat-val">{{ $barber->appointments_count ?? 0 }}</div><div class="barber-stat-lbl">Citas</div></div>
            <div class="barber-stat"><div class="barber-stat-val">{{ $barber->rating ?? '5.0' }}</div><div class="barber-stat-lbl">Rating</div></div>
          </div>
        </div>
        @empty
        @foreach([['Pedro G.','Fade & Barba',true,28,'4.9'],['Luis M.','Clásico',true,15,'4.7'],['Andrés C.','Diseño',false,5,'4.5'],['Camilo R.','Moderno',true,32,'5.0']] as $b)
        <div class="barber-card">
          <div class="barber-card-top"><div class="barber-avatar">{{ substr($b[0],0,1) }}</div><div><div class="barber-name">{{ $b[0] }}</div><div class="barber-spec">{{ $b[1] }}</div><span class="badge {{ $b[2] ? 'badge--green' : 'badge--red' }}">{{ $b[2] ? 'Activo' : 'Inactivo' }}</span></div></div>
          <div class="barber-stats"><div class="barber-stat"><div class="barber-stat-val">{{ $b[3] }}</div><div class="barber-stat-lbl">Citas</div></div><div class="barber-stat"><div class="barber-stat-val">{{ $b[4] }}</div><div class="barber-stat-lbl">Rating</div></div></div>
        </div>
        @endforeach
        @endforelse
      </div>
    </div>

    <!-- MI AGENDA -->
    <div class="panel" id="panel-agenda">
      <div class="agenda-controls">
        <div style="flex:1;"><div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Mi Agenda</div><div style="font-size:13px;color:var(--muted2);">Tus citas de la semana</div></div>
        <div class="week-nav"><button class="week-nav-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg></button><span class="week-label">Esta semana</span><button class="week-nav-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></button></div>
      </div>
      <div class="schedule-grid">
        @foreach(['Lun','Mar','Mié','Jue','Vie','Sáb','Dom'] as $i => $day)
        <div class="day-col {{ $i == 2 ? 'today' : '' }}">
          <div class="day-hd"><div class="day-name">{{ $day }}</div><div class="day-num">{{ 14 + $i }}</div></div>
          @if($i==0)<div class="slot slot--booked"><div class="slot-time">9:00</div><div class="slot-name">Carlos</div></div><div class="slot slot--avail"><div class="slot-time">11:00</div><div class="slot-name">Libre</div></div>@endif
          @if($i==2)<div class="slot slot--booked"><div class="slot-time">9:00</div><div class="slot-name">Miguel</div></div><div class="slot slot--booked"><div class="slot-time">11:30</div><div class="slot-name">Juan</div></div><div class="slot slot--booked"><div class="slot-time">14:00</div><div class="slot-name">Ana</div></div>@endif
          @if($i==4)<div class="slot slot--booked"><div class="slot-time">10:00</div><div class="slot-name">Pedro</div></div><div class="slot slot--avail"><div class="slot-time">14:00</div><div class="slot-name">Libre</div></div>@endif
          @if($i==5)<div class="slot slot--booked"><div class="slot-time">9:00</div><div class="slot-name">Luis</div></div><div class="slot slot--booked"><div class="slot-time">11:00</div><div class="slot-name">Andrés</div></div>@endif
        </div>
        @endforeach
      </div>
      <div style="font-family:'Bebas Neue',sans-serif;font-size:18px;letter-spacing:1px;margin-bottom:14px;">Citas de Hoy</div>
      <div class="appt-list">
        @foreach([['09:00','Carlos Ruiz','Corte + Barba','60'],['11:30','Miguel Torres','Fade','45'],['14:00','Juan López','Diseño','75'],['15:30','Ana Martínez','Coloración','90']] as $a)
        <div class="appt-item">
          <div class="appt-time">{{ $a[0] }}</div>
          <div class="appt-info"><div class="appt-client">{{ $a[1] }}</div><div class="appt-service">{{ $a[2] }}</div></div>
          <div class="appt-dur">{{ $a[3] }} min<br><span class="badge badge--green">Confirmado</span></div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- MI HORARIO -->
    <div class="panel" id="panel-my-schedule">
      <div style="margin-bottom:20px;"><div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Mi Horario</div><div style="font-size:13px;color:var(--muted2);">Consulta tu disponibilidad semanal</div></div>
      <div class="my-schedule">
        <div class="card-hd-title">Horario Asignado por el Admin</div>
        <div class="hours-grid">
          @foreach(['Lun','Mar','Mié','Jue','Vie','Sáb','Dom'] as $day)
          <div class="hour-day">
            <div class="hour-label">{{ $day }}</div>
            <div style="background:var(--surface3);border-radius:8px;padding:6px;text-align:center;font-size:11px;color:var(--gold);">08:00</div>
            <div style="background:var(--surface3);border-radius:8px;padding:6px;text-align:center;font-size:11px;color:var(--muted2);">18:00</div>
            <div style="font-size:10px;color:var(--green);text-align:center;margin-top:2px;">✓ Activo</div>
          </div>
          @endforeach
        </div>
        <div style="margin-top:16px;padding:12px;background:rgba(201,168,76,0.05);border:0.5px dashed rgba(201,168,76,0.25);border-radius:10px;font-size:12px;color:var(--muted);text-align:center;">
          Para modificar tu horario, contacta al administrador.
        </div>
      </div>
    </div>

    <!-- ESTADO LOCAL (lectura) -->
    <div class="panel" id="panel-barberia">
      <div style="margin-bottom:20px;"><div style="font-family:'Bebas Neue',sans-serif;font-size:24px;letter-spacing:2px;">Estado del Local</div><div style="font-size:13px;color:var(--muted2);">Información del estado actual de la barbería</div></div>
      <div class="card" style="max-width:500px;">
        <div class="card-hd"><span class="card-hd-title">Estado Actual</span></div>
        <div class="card-body">
          <div class="shop-status shop-status--open">
            <div class="status-dot status-dot--open"></div>
            <div><div class="status-text--open" style="font-size:15px;">BARBERÍA ABIERTA</div><div style="font-size:12px;color:var(--muted);">Desde las 8:00 AM • Cierra 8:00 PM</div></div>
          </div>
          <div style="margin-top:16px;display:flex;flex-direction:column;gap:10px;">
            @foreach([['Lunes – Viernes','8:00 AM – 8:00 PM'],['Sábado','9:00 AM – 6:00 PM'],['Domingo','Cerrado']] as $h)
            <div class="list-item"><div class="li-info"><div class="li-name">{{ $h[0] }}</div><div class="li-sub">{{ $h[1] }}</div></div>@if($h[1]=='Cerrado')<span class="badge badge--red">Cerrado</span>@else<span class="badge badge--green">Abierto</span>@endif</div>
            @endforeach
          </div>
          <div style="margin-top:14px;padding:10px 14px;background:rgba(74,144,226,0.06);border:0.5px solid rgba(74,144,226,0.2);border-radius:10px;font-size:12px;color:var(--blue);text-align:center;">
            Solo el administrador puede abrir o cerrar la barbería.
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<script src="/BladeBarber/public/js/barber-dash.js"></script>
</body>
</html>