// ── PANELS
const panelTitles = {
    welcome: 'Inicio', 'profile-view': 'Mi Perfil', 'profile-edit': 'Editar Perfil',
    'change-pass': 'Contraseña', 'agenda': 'Agendar Cita', 'mis-citas': 'Mis Citas',
    fila: 'Fila de Espera', 'barberos': 'Nuestros Barberos', 'muro': 'Muro', 'publicar': 'Nueva Publicación'
};

function showPanel(id) {
    document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    const p = document.getElementById('panel-' + id);
    if (p) p.classList.add('active');
    document.querySelectorAll('.nav-item').forEach(n => {
        if (n.getAttribute('onclick') && n.getAttribute('onclick').includes("'" + id + "'"))
            n.classList.add('active');
    });
    document.getElementById('topbarTitle').textContent = panelTitles[id] || '';
    if (window.innerWidth <= 768) closeSidebar();
}

function openSidebar() {
    document.getElementById('sidebar').classList.add('open');
    document.getElementById('sidebarOverlay').classList.add('show');
}
function closeSidebar() {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('sidebarOverlay').classList.remove('show');
}

// ── CLOCK
function updateClock() {
    const n = new Date();
    document.getElementById('clock').textContent = n.toLocaleTimeString('es-CO', { hour: '2-digit', minute: '2-digit' });
    document.getElementById('dateStr').textContent = n.toLocaleDateString('es-CO', { weekday: 'long', day: 'numeric', month: 'long' });
}
setInterval(updateClock, 1000); updateClock();

// ── PASSWORD
function togglePwd(id) {
    const i = document.getElementById(id);
    i.type = i.type === 'password' ? 'text' : 'password';
}
function checkStrength(v) {
    const bar = document.getElementById('strBar'), txt = document.getElementById('strText');
    let s = 0;
    if (v.length >= 8) s++;
    if (/[A-Z]/.test(v)) s++;
    if (/[0-9]/.test(v)) s++;
    if (/[^A-Za-z0-9]/.test(v)) s++;
    const w = ['', '25%', '50%', '75%', '100%'];
    const c = ['', '#F87171', '#FBBF24', '#8B5CF6', '#34D399'];
    const l = ['', 'Muy débil', 'Regular', 'Buena', 'Fuerte'];
    bar.style.width = w[s]; bar.style.background = c[s];
    txt.textContent = l[s]; txt.style.color = c[s];
}
function checkMatch() {
    const p2 = document.getElementById('cp2').value, p3 = document.getElementById('cp3').value;
    const m = document.getElementById('matchMsg');
    if (!p3) { m.textContent = ''; return; }
    m.textContent = p2 === p3 ? '✓ Las contraseñas coinciden' : '✗ No coinciden';
    m.style.color = p2 === p3 ? 'var(--green)' : 'var(--red)';
}

// ── AGENDA — ESTADO GLOBAL
let currentStep       = 1;
let selectedServices  = {};
let selectedBarberoId = null;
let selectedDate      = null;
let selectedTimeEl    = null;
let calYear, calMonth;

let sumService = '—';
let sumBarber  = '—';
let sumDate    = '—';
let sumTime    = '—';
let sumPrice   = '—';
let sumDur     = '—';

let barberoDisponibilidad = {
    diasTrabajo:   [],
    citasOcupadas: []
};

// ── STEPS
function goStep(n) {
    document.querySelectorAll('.step-content').forEach(s => s.classList.remove('active'));
    document.getElementById('step' + n).classList.add('active');
    for (let i = 1; i <= 4; i++) {
        const sc = document.getElementById('sc' + i);
        const sl = document.getElementById('sl' + i);
        sc.className = 'step-circle' + (i < n ? ' done' : i === n ? ' active' : '');
        sl.className = 'step-label' + (i === n ? ' active' : '');
        sc.innerHTML = i < n ? '✓' : i;
    }
    currentStep = n;
    if (n === 4) updateSummary();
}

function updateSummary() {
    document.getElementById('sumService').textContent = sumService || '—';
    document.getElementById('sumBarber').textContent  = sumBarber  || '—';
    document.getElementById('sumDate').textContent    = sumDate    || '—';
    document.getElementById('sumTime').textContent    = sumTime    || '—';
    document.getElementById('sumDur').textContent     = sumDur     || '—';
    document.getElementById('sumPrice').textContent   = sumPrice   || '—';
}

// ── SERVICIOS (multi-select)
function toggleService(card, id, nombre, precio, duracion) {
    if (selectedServices[id]) {
        delete selectedServices[id];
        card.classList.remove('selected');
    } else {
        selectedServices[id] = { id, nombre, precio, duracion };
        card.classList.add('selected');
    }
    updateServiceSummary();
}

function updateServiceSummary() {
    const items   = Object.values(selectedServices);
    const summary = document.getElementById('serviceSummary');
    const chips   = document.getElementById('summaryChips');
    const btn     = document.getElementById('btnStep2');

    if (items.length === 0) {
        summary.style.display = 'none';
        btn.disabled       = true;
        btn.style.opacity  = '.4';
        btn.style.cursor   = 'not-allowed';
    } else {
        summary.style.display = 'flex';
        btn.disabled       = false;
        btn.style.opacity  = '1';
        btn.style.cursor   = 'pointer';

        chips.innerHTML = items.map(s => `
            <span class="summary-chip">${s.nombre}
                <button onclick="removeService(${s.id})" title="Quitar">×</button>
            </span>`).join('');

        const totalDur    = items.reduce((a, s) => a + s.duracion, 0);
        const totalPrecio = items.reduce((a, s) => a + s.precio, 0);

        document.getElementById('sumTotalDur').textContent   = totalDur + ' min';
        document.getElementById('sumTotalPrice').textContent = '$' + totalPrecio.toLocaleString('es-CO');

        // Variables globales para el resumen paso 4
        sumService = items.map(s => s.nombre).join(' + ');
        sumPrice   = '$' + totalPrecio.toLocaleString('es-CO');
        sumDur     = totalDur + ' min';
    }
}

function removeService(id) {
    delete selectedServices[id];
    const card = document.querySelector(`.service-card[data-id="${id}"]`);
    if (card) card.classList.remove('selected');
    updateServiceSummary();
}

// ── BARBERO
function selectBarber(el, nombre, idBarbero) {
    document.querySelectorAll('.barber-pick').forEach(b => b.classList.remove('selected'));
    el.classList.add('selected');
    sumBarber         = nombre;
    selectedBarberoId = idBarbero;
    cargarHorasOcupadas();
    if (!calYear || !calMonth === undefined) {
        const hoy = new Date();
        calYear  = hoy.getFullYear();
        calMonth = hoy.getMonth();
    }

    selectedDate   = null;
    selectedTimeEl = null;
    document.getElementById('sumDate').textContent = '—';
    document.getElementById('sumTime').textContent = '—';
    document.getElementById('timeSlots').innerHTML =
        '<div style="color:var(--muted2);font-size:13px;grid-column:1/-1;">Selecciona primero un día</div>';

    const url = `${APP_URL}/barbero/${idBarbero}/disponibilidad`;

    fetch(url)
        .then(r => {
            if (!r.ok) throw new Error('HTTP ' + r.status);
            return r.json();
        })
        .then(data => {
            console.log('Horarios recibidos:', data.horarios); 
            barberoDisponibilidad.diasTrabajo   = data.horarios;
            barberoDisponibilidad.citasOcupadas = data.citas;
            renderCal();
        })
        .catch(err => console.error('Error:', err));
}

// ── CALENDARIO
function initCal() {
    const hoy = new Date();
    calYear  = hoy.getFullYear();
    calMonth = hoy.getMonth();
    renderCal();
}

function renderCal() {
    const meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                   'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    document.getElementById('calMonthLabel').textContent = `${meses[calMonth]} ${calYear}`;

    const grid = document.getElementById('calGrid');
    grid.innerHTML = '';

    // Cabecera semana (Lunes primero)
    ['Lu','Ma','Mi','Ju','Vi','Sa','Do'].forEach(d => {
        const h = document.createElement('div');
        h.className = 'cal-header';
        h.textContent = d;
        grid.appendChild(h);
    });

    const primerDia = new Date(calYear, calMonth, 1);
    const totalDias = new Date(calYear, calMonth + 1, 0).getDate();
    const hoy       = new Date();
    hoy.setHours(0, 0, 0, 0);

    // Offset: lunes=0 … domingo=6
    let offset = primerDia.getDay() - 1;
    if (offset < 0) offset = 6;

    for (let i = 0; i < offset; i++) {
        const empty = document.createElement('div');
        empty.className = 'cal-day cal-empty';
        grid.appendChild(empty);
    }

    for (let d = 1; d <= totalDias; d++) {
        const fecha = new Date(calYear, calMonth, d);
        fecha.setHours(0, 0, 0, 0);

        // JS: 0=dom…6=sab  →  BD: 1=lun…7=dom
        const jsDow  = fecha.getDay();
        const diaBD  = jsDow === 0 ? 7 : jsDow;

        // ¿Trabaja el barbero ese día?
        const horarioDia = barberoDisponibilidad.diasTrabajo
            .find(h => h.dia === diaBD);

        const pasado    = fecha < hoy;
        const noTrabaja = !horarioDia;

        const fechaStr = `${calYear}-${String(calMonth + 1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;

        const cell = document.createElement('div');
        cell.textContent = d;

        if (pasado || noTrabaja) {
            cell.className = 'cal-day cal-disabled';
            cell.title = noTrabaja ? 'El barbero no trabaja este día' : 'Fecha pasada';
        } else {
            cell.className = 'cal-day';
            if (selectedDate === fechaStr) cell.classList.add('selected');
            cell.onclick = () => selectDay(cell, fechaStr, horarioDia);
            cargarHorasOcupadas();
        }

        // Marcar hoy
        const esHoy = fecha.getTime() === hoy.getTime();
        if (esHoy && !pasado && !noTrabaja) cell.classList.add('today');

        grid.appendChild(cell);
    }
}

function prevMonth() {
    calMonth--;
    if (calMonth < 0) { calMonth = 11; calYear--; }
    renderCal();
}

function nextMonth() {
    calMonth++;
    if (calMonth > 11) { calMonth = 0; calYear++; }
    renderCal();
}

// ── DÍA Y SLOTS
function selectDay(el, fechaStr, horarioDia) {
    document.querySelectorAll('.cal-day.selected').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    selectedDate   = fechaStr;
    selectedTimeEl = null;

    const [y, m, d] = fechaStr.split('-');
    const meses = ['','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
    sumDate = `${d} ${meses[parseInt(m)]} ${y}`;
    document.getElementById('sumDate').textContent = sumDate;
    document.getElementById('sumTime').textContent = '—';

    renderTimeSlots(fechaStr, horarioDia);
    cargarHorasOcupadas();
}

function renderTimeSlots(fechaStr, horarioDia) {
    const container = document.getElementById('timeSlots');
    container.innerHTML = '';

    const ocupadas = barberoDisponibilidad.citasOcupadas
        .filter(c => c.fecha === fechaStr)
        .map(c => c.hora);

    const [hIni] = horarioDia.hora_inicio.split(':').map(Number);
    const [hFin] = horarioDia.hora_fin.split(':').map(Number);
    const mIni   = parseInt(horarioDia.hora_inicio.split(':')[1]);
    const mFin   = parseInt(horarioDia.hora_fin.split(':')[1]);

    const minInicio = hIni * 60 + mIni;
    const minFin    = hFin * 60 + mFin;

    for (let min = minInicio; min < minFin; min += 30) {
        const hh   = String(Math.floor(min / 60)).padStart(2, '0');
        const mm   = String(min % 60).padStart(2, '0');
        const slot = `${hh}:${mm}`;

        const el = document.createElement('div');
        el.textContent = slot;

        if (ocupadas.includes(slot)) {
            el.className = 'time-slot unavail';
            el.title = 'Hora ocupada';
        } else {
            el.className = 'time-slot';
            el.onclick = () => selectTime(el, slot);
        }

        container.appendChild(el);
    }

    if (container.children.length === 0) {
        container.innerHTML =
            '<div style="color:var(--muted2);font-size:13px;grid-column:1/-1;">Sin horarios disponibles</div>';
    }
}

function selectTime(el, hora) {
    if (selectedTimeEl) selectedTimeEl.classList.remove('selected');
    el.classList.add('selected');
    selectedTimeEl = el;
    sumTime = hora;
    document.getElementById('sumTime').textContent = hora;
}

// ── CONFIRMAR CITA
function confirmarCita() {
    const serviciosIds = Object.values(selectedServices).map(s => s.id);

    if (!serviciosIds.length)  return alert('Selecciona al menos un servicio.');
    if (!selectedBarberoId)    return alert('Selecciona un barbero.');
    if (!selectedDate)         return alert('Selecciona una fecha.');
    if (!sumTime || sumTime === '—') return alert('Selecciona una hora.');

    // Llenar los campos ocultos del formulario
    document.getElementById('inputBarbero').value = selectedBarberoId;
    document.getElementById('inputFecha').value   = selectedDate;
    document.getElementById('inputHora').value    = sumTime;

    // Generar inputs hidden para cada servicio seleccionado
    const contenedor = document.getElementById('inputsServicios');
    contenedor.innerHTML = '';
    serviciosIds.forEach(id => {
        const input = document.createElement('input');
        input.type  = 'hidden';
        input.name  = 'servicios[]';
        input.value = id;
        contenedor.appendChild(input);
    });

    // Enviar el formulario PHP
    document.getElementById('formCita').submit();
}

// ── FILA
function salirFila() {
    if (!confirm('¿Seguro que quieres salir de la fila?')) return;
    document.getElementById('queueHeroSection').style.display = 'none';
    document.getElementById('joinQueueSection').style.display = 'block';
    document.querySelector('.queue-item.is-me').style.display = 'none';
}
function entrarFila() {
    document.getElementById('joinQueueSection').style.display = 'none';
    document.getElementById('queueHeroSection').style.display = 'block';
    const item = document.querySelector('.queue-item.is-me');
    if (item) item.style.display = 'flex';
    alert('¡Te has unido a la fila! Eres el #3');
}

// ── POSTS
function likePost(btn) {
    btn.classList.toggle('liked');
    const span = btn.querySelector('span');
    let n = parseInt(span.textContent);
    span.textContent = btn.classList.contains('liked') ? n + 1 : n - 1;
}
function toggleComment(btn, id) {
    const box = document.getElementById(id);
    box.style.display = box.style.display === 'none' ? 'block' : 'none';
}
function addComment(btn) {
    const box   = btn.closest('.comment-box');
    const input = box.querySelector('input');
    if (!input.value.trim()) return;
    input.value = '';
    alert('Comentario publicado');
}
function eliminarPost(btn) {
    if (!confirm('¿Eliminar tu publicación?')) return;
    btn.closest('.post-card').remove();
}
function previewPostImg(e) {
    const f = e.target.files[0];
    if (f) {
        const r = new FileReader();
        r.onload = ev => {
            document.getElementById('postPreviewImg').src = ev.target.result;
            document.getElementById('postPreview').style.display = 'block';
        };
        r.readAsDataURL(f);
    }
}
function publicar() {
    const content = document.getElementById('postContent').value.trim();
    if (!content) { alert('Escribe algo antes de publicar'); return; }
    alert('¡Publicación enviada al muro!');
    document.getElementById('postContent').value = '';
    document.getElementById('postPreview').style.display = 'none';
    showPanel('muro');
}

// ── INIT
document.addEventListener('DOMContentLoaded', initCal);
let horasOcupadas = [];

async function cargarHorasOcupadas() {
    if (!selectedBarberoId || !selectedDate) return;

    const res = await fetch(
        `${APP_URL}/citas/horas-ocupadas?barbero=${selectedBarberoId}&fecha=${selectedDate}`
    );

    horasOcupadas = await res.json();

    aplicarBloqueos();
}

function aplicarBloqueos() {
    document.querySelectorAll('.time-slot').forEach(slot => {
        const hora = slot.textContent.trim();
        const horaNorm = hora.length === 4 ? '0' + hora : hora;

        if (horasOcupadas.includes(horaNorm)) {
            slot.classList.add('unavail');
            slot.onclick = null;
        } else {
            slot.classList.remove('unavail');
            slot.onclick = () => selectTime(slot, hora);
        }
    });
}

function filtrarMuro(btn, filtro) {
  // Marcar botón activo
  document.querySelectorAll('#muroFiltros .filtro-btn')
          .forEach(b => b.classList.remove('filtro-activo'));
  btn.classList.add('filtro-activo');

  // Mostrar/ocultar posts
  document.querySelectorAll('#postsLista .post-card').forEach(card => {
    const rol = card.dataset.rol; // 'admin', 'barbero-5', 'cliente'
    if (filtro === 'todos' || rol === filtro) {
      card.style.display = '';
    } else {
      card.style.display = 'none';
    }
  });
}
