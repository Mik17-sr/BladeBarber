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
    const w = ['', '25%', '50%', '75%', '100%'], c = ['', '#F87171', '#FBBF24', '#8B5CF6', '#34D399'], l = ['', 'Muy débil', 'Regular', 'Buena', 'Fuerte'];
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

// ── AGENDA STEPS
let currentStep = 1;
let selected = { service: '', price: '', duration: '', barber: '', date: '', time: '' };

function goStep(n) {
    document.querySelectorAll('.step-content').forEach(s => s.classList.remove('active'));
    document.getElementById('step' + n).classList.add('active');
    for (let i = 1; i <= 4; i++) {
        const sc = document.getElementById('sc' + i), sl = document.getElementById('sl' + i);
        sc.className = 'step-circle' + (i < n ? ' done' : i === n ? ' active' : '');
        sl.className = 'step-label' + (i === n ? ' active' : '');
        if (i < n) sc.innerHTML = '✓';
        else sc.innerHTML = i;
    }
    currentStep = n;
    if (n === 4) updateSummary();
}

function selectService(el, name, price, dur) {
    document.querySelectorAll('.service-card').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    selected.service = name; selected.price = price; selected.duration = dur;
}
function selectBarber(el, name) {
    document.querySelectorAll('.barber-pick').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    selected.barber = name;
}
function selectTime(el, time) {
    document.querySelectorAll('.time-slot:not(.unavail)').forEach(t => t.classList.remove('selected'));
    el.classList.add('selected');
    selected.time = time;
}

function updateSummary() {
    document.getElementById('sumService').textContent = selected.service || '—';
    document.getElementById('sumBarber').textContent = selected.barber || '—';
    document.getElementById('sumDate').textContent = selected.date || '—';
    document.getElementById('sumTime').textContent = selected.time || '—';
    document.getElementById('sumDur').textContent = selected.duration || '—';
    document.getElementById('sumPrice').textContent = selected.price || '—';
}

function confirmarCita() {
    const msg = `¡Cita confirmada!\n\n${selected.service}\nBarbero: ${selected.barber}\nFecha: ${selected.date} a las ${selected.time}`;
    alert(msg);
    showPanel('mis-citas');
    goStep(1);
    document.querySelectorAll('.service-card,.barber-pick,.time-slot').forEach(el => el.classList.remove('selected'));
    selected = { service: '', price: '', duration: '', barber: '', date: '', time: '' };
}

// ── CALENDAR
let calDate = new Date();
const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
const days = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];

function renderCalendar() {
    const grid = document.getElementById('calGrid');
    grid.innerHTML = '';
    document.getElementById('calMonthLabel').textContent = months[calDate.getMonth()] + ' ' + calDate.getFullYear();
    days.forEach(d => {
        const el = document.createElement('div');
        el.className = 'cal-day-name'; el.textContent = d; grid.appendChild(el);
    });
    const first = new Date(calDate.getFullYear(), calDate.getMonth(), 1).getDay();
    const total = new Date(calDate.getFullYear(), calDate.getMonth() + 1, 0).getDate();
    const today = new Date();
    for (let i = 0; i < first; i++) {
        const el = document.createElement('div'); el.className = 'cal-day empty'; grid.appendChild(el);
    }
    for (let d = 1; d <= total; d++) {
        const el = document.createElement('div');
        const thisDate = new Date(calDate.getFullYear(), calDate.getMonth(), d);
        const isPast = thisDate < new Date(today.getFullYear(), today.getMonth(), today.getDate());
        const isSun = thisDate.getDay() === 0;
        el.className = 'cal-day' + (isPast || isSun ? ' disabled' : ' has-slot');
        el.textContent = d;
        if (!isPast && !isSun) {
            if (d === today.getDate() && calDate.getMonth() === today.getMonth() && calDate.getFullYear() === today.getFullYear())
                el.classList.add('today');
            el.onclick = () => selectDay(el, d);
        }
        grid.appendChild(el);
    }
}

function selectDay(el, d) {
    document.querySelectorAll('.cal-day.selected').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    selected.date = d + ' de ' + months[calDate.getMonth()];
}
function prevMonth() { calDate.setMonth(calDate.getMonth() - 1); renderCalendar(); }
function nextMonth() { calDate.setMonth(calDate.getMonth() + 1); renderCalendar(); }

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
    const span = btn.querySelector('span');
}
function addComment(btn) {
    const box = btn.closest('.comment-box');
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
renderCalendar();