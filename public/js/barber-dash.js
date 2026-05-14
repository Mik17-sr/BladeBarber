const panels = { welcome: 'Bienvenida', 'profile-view': 'Mi Perfil', 'profile-edit': 'Editar Perfil', 'change-pass': 'Cambiar Contraseña', 'posts-wall': 'Muro', 'post-create': 'Nueva Publicación', 'barbers-list': 'Equipo', 'agenda': 'Mi Agenda', 'my-schedule': 'Mi Horario', 'barberia': 'Estado Local' };
function showPanel(id) { document.querySelectorAll('.panel').forEach(p => p.classList.remove('active')); document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active')); const p = document.getElementById('panel-' + id); if (p) p.classList.add('active'); document.querySelectorAll('.nav-item').forEach(n => { if (n.getAttribute('onclick') && n.getAttribute('onclick').includes("'" + id + "'")) n.classList.add('active'); }); document.getElementById('topbarTitle').textContent = panels[id] || ''; if (window.innerWidth <= 768) closeSidebar(); }
function openSidebar() { document.getElementById('sidebar').classList.add('open'); document.getElementById('sidebarOverlay').classList.add('show'); }
function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('sidebarOverlay').classList.remove('show'); }
function updateClock() { const n = new Date(); document.getElementById('clock').textContent = n.toLocaleTimeString('es-CO', { hour: '2-digit', minute: '2-digit' }); document.getElementById('dateStr').textContent = n.toLocaleDateString('es-CO', { weekday: 'long', day: 'numeric', month: 'long' }); }
setInterval(updateClock, 1000); updateClock();
function checkStrength(v) { const bar = document.getElementById('strBar'); const txt = document.getElementById('strText'); let s = 0; if (v.length >= 8) s++; if (/[A-Z]/.test(v)) s++; if (/[0-9]/.test(v)) s++; if (/[^A-Za-z0-9]/.test(v)) s++; const w = ['', '25%', '50%', '75%', '100%']; const c = ['', '#E25A4A', '#C9A84C', '#4A90E2', '#4CAF6E']; const l = ['', 'Muy débil', 'Regular', 'Buena', 'Fuerte']; bar.style.width = w[s]; bar.style.background = c[s]; txt.textContent = l[s]; txt.style.color = c[s]; }
function checkMatch() { const p2 = document.getElementById('cp2').value; const p3 = document.getElementById('cp3').value; const m = document.getElementById('matchMsg'); if (!p3) { m.textContent = ''; return; } if (p2 === p3) { m.textContent = '✓ Coinciden'; m.style.color = 'var(--green)'; } else { m.textContent = '✗ No coinciden'; m.style.color = 'var(--red)'; } }
function togglePwd(id) { const i = document.getElementById(id); i.type = i.type === 'password' ? 'text' : 'password'; }
function previewAvatar(e) { const f = e.target.files[0]; if (f) { const r = new FileReader(); r.onload = ev => { document.querySelectorAll('.avatar-lg').forEach(a => { a.style.backgroundImage = `url(${ev.target.result})`; a.style.backgroundSize = 'cover'; }); }; r.readAsDataURL(f); } }
function previewPost(e) { const f = e.target.files[0]; if (f) { const r = new FileReader(); r.onload = ev => { document.getElementById('postPreviewImg').src = ev.target.result; document.getElementById('postPreview').style.display = 'block'; }; r.readAsDataURL(f); } }

const params = new URLSearchParams(window.location.search);
const panelParam = params.get('panel');
if (panelParam) showPanel(panelParam);

function abrirModalReprogramar(idCita, nombreCliente, horaActual, actionUrl) {
  document.getElementById('repro-id-cita').value     = idCita;
  document.getElementById('repro-nueva-hora').value  = horaActual;
  document.getElementById('repro-motivo').value       = '';
  document.getElementById('repro-cliente-label').textContent = 'Cliente: ' + nombreCliente;
  document.getElementById('formReprogramar').action = actionUrl;
  var modal = document.getElementById('modalReprogramar');
  modal.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}

function cerrarModalReprogramar() {
    document.getElementById('modalReprogramar').style.display = 'none';
    document.body.style.overflow = '';
}

document.getElementById('modalReprogramar').addEventListener('click', function (e) {
    if (e.target === this) cerrarModalReprogramar();
});

(function iniciarPolling() {
    var INTERVALO_MS = 60000;
    var PANELES_RECARGA = ['panel-agenda', 'panel-atender', 'panel-fila-barbero'];
    function panelActivo() {
        return document.querySelector('.panel.active');
    }
    function esPanelAgenda(panel) {
        return panel && PANELES_RECARGA.includes(panel.id);
    }
    function mostrarIndicadorRecarga() {
        var ind = document.getElementById('recarga-indicator');
        if (!ind) return;
        ind.style.opacity = '1';
        setTimeout(function () { ind.style.opacity = '0'; }, 1800);
    }
    function recargarPaginaSiEsNecesario() {
        var activo = panelActivo();
        if (esPanelAgenda(activo)) {
            var url = new URL(window.location.href);
            url.searchParams.set('panel', activo.id.replace('panel-', ''));
            var modalAbierto = document.getElementById('modalReprogramar').style.display === 'flex';
            if (!modalAbierto) {
                window.location.replace(url.toString());
            }
        }
    }
    setInterval(recargarPaginaSiEsNecesario, INTERVALO_MS);

    function actualizarRelojUltimaActualizacion() {
        var el = document.getElementById('ultima-actualizacion');
        if (!el) return;
        var ahora = new Date();
        el.textContent = 'Actualizado: ' + ahora.getHours().toString().padStart(2, '0')
            + ':' + ahora.getMinutes().toString().padStart(2, '0')
            + ':' + ahora.getSeconds().toString().padStart(2, '0');
    }
    actualizarRelojUltimaActualizacion();
    setInterval(actualizarRelojUltimaActualizacion, 1000);
})();

function marcarBloque(radio) {
  document.querySelectorAll('.bloque-option').forEach(function(el) {
    el.style.border        = '1px solid var(--border2)';
    el.style.background    = 'transparent';
    el.style.color         = 'var(--text)';
  });
  var opt = document.getElementById('opt-' + radio.value.replace(':00',''));
  if (opt) {
    opt.style.border     = '1px solid var(--gold)';
    opt.style.background = 'rgba(201,168,76,0.1)';
  }
}
 
/* Mostrar/ocultar campo hora según tipo de novedad */
function toggleHoraAfectada(tipo) {
  var wrap = document.getElementById('wrap-hora-afectada');
  if (wrap) {
    wrap.style.display = tipo === 'cancelacion_anticipada' ? 'block' : 'none';
  }
}