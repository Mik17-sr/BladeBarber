<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reprogramar Cita — BladeBarber</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/BladeBarber/public/css/cliente-dash.css">
    <style>
        html, body { overflow-y: auto !important; height: auto !important; min-height: 100vh; }
        .bg-scene  { position: fixed; inset: 0; z-index: -1; }
        .card      { position: relative; z-index: 1; }
        .btn-violet, .btn-outline { display: inline-flex; align-items: center; gap: 8px; }
    </style>
</head>
<body>
<div class="bg-scene">
    <div class="bg-grain"></div>
    <div class="bg-glow bg-glow--1"></div>
    <div class="bg-glow bg-glow--2"></div>
</div>
 
<div style="max-width:700px;margin:40px auto;padding:0 16px;">
 
    {{-- Encabezado --}}
    <div style="margin-bottom:24px;">
        <a href="{{ route('dashboard.cliente') }}"
           style="font-size:13px;color:var(--muted2);text-decoration:none;
                  display:inline-flex;align-items:center;gap:6px;margin-bottom:12px;">
            ← Volver al inicio
        </a>
        <div style="font-family:'Bebas Neue',sans-serif;font-size:28px;letter-spacing:2px;">
            Reprogramar Cita
        </div>
        <div style="font-size:13px;color:var(--muted2);">Modifica la fecha u hora de tu reserva</div>
    </div>
 
    @if(session('success'))
        <div style="background:rgba(80,200,120,0.1);border:1px solid rgba(80,200,120,0.3);
                    border-radius:10px;padding:12px 16px;margin-bottom:16px;font-size:13px;color:#4ade80;">
            {{ session('success') }}
        </div>
    @endif
 
    @if($errors->any())
        <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);
                    border-radius:10px;padding:12px 16px;margin-bottom:16px;font-size:13px;color:#f87171;">
            @foreach($errors->all() as $error)
                <div>• {{ $error }}</div>
            @endforeach
        </div>
    @endif
 
    {{-- Cita actual --}}
    <div class="card" style="margin-bottom:20px;">
        <div class="card-hd"><span class="card-hd-title">Cita Actual</span></div>
        <div class="card-body">
            <div class="appt-summary">
                <div class="summary-row">
                    <span class="summary-key">Servicio(s)</span>
                    <span class="summary-val">{{ $cita->servicios->pluck('nombre')->join(' + ') }}</span>
                </div>
                <div class="summary-row">
                    <span class="summary-key">Barbero</span>
                    <span class="summary-val">{{ $cita->barbero->usuario->nombre }}</span>
                </div>
                <div class="summary-row">
                    <span class="summary-key">Fecha actual</span>
                    <span class="summary-val">
                        {{ \Carbon\Carbon::parse($cita->fecha_cita)->isoFormat('dddd D [de] MMMM YYYY') }}
                    </span>
                </div>
                <div class="summary-row">
                    <span class="summary-key">Hora actual</span>
                    <span class="summary-val">{{ \Carbon\Carbon::parse($cita->hora_cita)->format('h:i A') }}</span>
                </div>
                <div class="summary-row">
                    <span class="summary-key">Estado</span>
                    <span class="badge badge--amber">{{ $cita->estado }}</span>
                </div>
            </div>
        </div>
    </div>
 
    <form method="POST" action="{{ route('citas.reprogramar', $cita->id_cita) }}" id="formReprogramar">
        @csrf @method('PUT')
 
        {{-- Barbero --}}
        <div class="card" style="margin-bottom:16px;">
            <div class="card-hd"><span class="card-hd-title">1 · Barbero</span></div>
            <div class="card-body">
                <div class="barber-pick-grid">
                    @foreach($barberos as $barbero)
                        <div class="barber-pick {{ $barbero->id_barbero == $cita->id_barbero ? 'selected' : '' }}"
                             onclick="selectBarberoReprog(this, {{ $barbero->id_barbero }}, '{{ addslashes($barbero->usuario->nombre) }}')"
                             style="cursor:pointer;">
                            <div class="bp-avatar" style="overflow:hidden;display:flex;align-items:center;justify-content:center;">
                                @if($barbero->usuario->foto)
                                    <img src="{{ asset('storage/'.$barbero->usuario->foto) }}"
                                         style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                                @else
                                    {{ strtoupper(substr($barbero->usuario->nombre, 0, 1)) }}
                                @endif
                            </div>
                            <div class="bp-name">{{ $barbero->usuario->nombre }}</div>
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="id_barbero" id="inputBarberReprog"
                       value="{{ old('id_barbero', $cita->id_barbero) }}">
            </div>
        </div>
 
        {{-- Fecha --}}
        <div class="card" style="margin-bottom:16px;">
            <div class="card-hd">
                <span class="card-hd-title">2 · Nueva Fecha</span>
                <div style="display:flex;gap:8px;align-items:center;">
                    <button type="button" onclick="prevMonthR()"
                        style="background:var(--surface3);border:1px solid var(--border2);border-radius:8px;
                               width:28px;height:28px;cursor:pointer;color:var(--muted2);
                               display:flex;align-items:center;justify-content:center;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:12px;">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>
                    </button>
                    <span id="rCalMonthLabel" style="font-size:13px;font-weight:500;min-width:110px;text-align:center;"></span>
                    <button type="button" onclick="nextMonthR()"
                        style="background:var(--surface3);border:1px solid var(--border2);border-radius:8px;
                               width:28px;height:28px;cursor:pointer;color:var(--muted2);
                               display:flex;align-items:center;justify-content:center;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:12px;">
                            <polyline points="9 18 15 12 9 6"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="calendar-grid" id="rCalGrid"></div>
                <input type="hidden" name="fecha_cita" id="inputFechaReprog" value="">
            </div>
        </div>
 
        {{-- Hora --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card-hd"><span class="card-hd-title">3 · Nueva Hora</span></div>
            <div class="card-body">
                <div id="rSlotsMsg" style="font-size:13px;color:var(--muted2);text-align:center;padding:20px 0;">
                    Selecciona primero una fecha para ver los horarios disponibles.
                </div>
                <div id="rTimeSlots" style="display:none;flex-wrap:wrap;gap:8px;"></div>
                <div style="font-size:11px;color:var(--muted);margin-top:10px;display:flex;gap:14px;">
                    <span>⬜ Disponible</span>
                    <span style="color:var(--violet-light);">🟪 Seleccionado</span>
                    <span style="opacity:.5;">⬜̶ Ocupado</span>
                </div>
                <input type="hidden" name="hora_cita" id="inputHoraReprog" value="">
            </div>
        </div>
 
        {{-- Resumen --}}
        <div class="card" id="rResumenCard" style="margin-bottom:20px;display:none;">
            <div class="card-hd"><span class="card-hd-title">Resumen del Cambio</span></div>
            <div class="card-body">
                <div class="appt-summary">
                    <div class="summary-row">
                        <span class="summary-key">Barbero</span>
                        <span class="summary-val" id="rSumBarbero">—</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-key">Nueva Fecha</span>
                        <span class="summary-val" id="rSumFecha">—</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-key">Nueva Hora</span>
                        <span class="summary-val" id="rSumHora">—</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-key">Nuevo Estado</span>
                        <span class="badge badge--amber">Pendiente de confirmación</span>
                    </div>
                </div>
            </div>
        </div>
 
        {{-- Acciones --}}
        <div style="display:flex;gap:10px;justify-content:space-between;flex-wrap:wrap;margin-bottom:40px;">
            <a href="{{ route('dashboard.cliente') }}" class="btn-outline"
               style="display:inline-flex;align-items:center;text-decoration:none;">Cancelar</a>
            <button type="submit" class="btn-violet" id="btnReprogramar"
                    disabled style="opacity:.4;cursor:not-allowed;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 11 12 14 22 4"/>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                </svg>
                Confirmar Reprogramación
            </button>
        </div>
    </form>
</div>
 
<script>
const CITA_ID          = {{ $cita->id_cita }};
const APP_URL          = '{{ url("") }}';
const FECHA_ORIGINAL   = '{{ \Carbon\Carbon::parse($cita->fecha_cita)->format("Y-m-d") }}';
 
const MESES      = ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
const DIAS_LABEL = ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'];
 
let rCurYear  = new Date().getFullYear();
let rCurMonth = new Date().getMonth();
 
let selectedBarberoId   = {{ $cita->id_barbero }};
let selectedBarberoName = '{{ addslashes($cita->barbero->usuario->nombre) }}';
let selectedFecha       = '';
let selectedHora        = '';
 
let barberoDisponibilidad = { diasTrabajo: [], citasOcupadas: [] };
 
// ── BARBERO ────────────────────────────────────────────────────────
function selectBarberoReprog(el, id, nombre) {
    document.querySelectorAll('.barber-pick').forEach(b => b.classList.remove('selected'));
    el.classList.add('selected');
    selectedBarberoId   = id;
    selectedBarberoName = nombre;
    document.getElementById('inputBarberReprog').value = id;
    selectedFecha = '';
    selectedHora  = '';
    document.getElementById('inputFechaReprog').value = '';
    document.getElementById('inputHoraReprog').value  = '';
    document.getElementById('rSlotsMsg').textContent   = 'Selecciona primero una fecha para ver los horarios disponibles.';
    document.getElementById('rSlotsMsg').style.display = 'block';
    document.getElementById('rTimeSlots').style.display = 'none';
    document.getElementById('rTimeSlots').innerHTML = '';
    checkSubmit();
    cargarDisponibilidadBarbero(id, null); // sin preselección al cambiar barbero
}
 
// ── CARGA DISPONIBILIDAD ───────────────────────────────────────────
function cargarDisponibilidadBarbero(idBarbero, fechaPreselectar) {
    fetch(`${APP_URL}/barbero/${idBarbero}/disponibilidad`)
        .then(r => r.json())
        .then(data => {
            barberoDisponibilidad.diasTrabajo   = data.horarios || [];
 
            // Normalizar fecha a YYYY-MM-DD (quita el timestamp ISO)
            barberoDisponibilidad.citasOcupadas = (data.citas || []).map(c => ({
                id_cita: c.id_cita,
                fecha:   c.fecha.substring(0, 10),
                hora:    c.hora.substring(0, 5),
            }));
 
            renderCalR();
 
            // Preseleccionar fecha si se pasa
            if (fechaPreselectar) {
                const partes  = fechaPreselectar.split('-');
                const fechaAno = +partes[0];
                const fechaMes = +partes[1] - 1;
 
                // Navegar al mes de la cita si es diferente al actual
                if (rCurYear !== fechaAno || rCurMonth !== fechaMes) {
                    rCurYear  = fechaAno;
                    rCurMonth = fechaMes;
                }
 
                const jsDow   = new Date(fechaAno, fechaMes, +partes[2]).getDay();
                const diaBD   = jsDow === 0 ? 7 : jsDow;
                const horario = barberoDisponibilidad.diasTrabajo.find(h => h.dia === diaBD);
 
                if (horario) {
                    selectedFecha = fechaPreselectar;
                    document.getElementById('inputFechaReprog').value = fechaPreselectar;
                    renderCalR();                          // re-render marcando el día
                    renderTimeSlotsR(fechaPreselectar, horario);
                }
            }
        })
        .catch(err => console.error('Error cargando disponibilidad:', err));
}
 
// ── CALENDARIO ────────────────────────────────────────────────────
function renderCalR() {
    const grid  = document.getElementById('rCalGrid');
    const label = document.getElementById('rCalMonthLabel');
    const hoy   = new Date(); hoy.setHours(0,0,0,0);
 
    label.textContent = MESES[rCurMonth] + ' ' + rCurYear;
    grid.innerHTML = '';
 
    ['Lu','Ma','Mi','Ju','Vi','Sa','Do'].forEach(d => {
        const h = document.createElement('div');
        h.className = 'cal-header';
        h.textContent = d;
        grid.appendChild(h);
    });
 
    let offset = new Date(rCurYear, rCurMonth, 1).getDay() - 1;
    if (offset < 0) offset = 6;
    for (let i = 0; i < offset; i++) {
        const e = document.createElement('div');
        e.className = 'cal-day cal-empty';
        grid.appendChild(e);
    }
 
    const totalDias = new Date(rCurYear, rCurMonth + 1, 0).getDate();
    for (let d = 1; d <= totalDias; d++) {
        const fecha    = new Date(rCurYear, rCurMonth, d);
        fecha.setHours(0,0,0,0);
        const jsDow    = fecha.getDay();
        const diaBD    = jsDow === 0 ? 7 : jsDow;
        const horario  = barberoDisponibilidad.diasTrabajo.find(h => h.dia === diaBD);
        const fechaStr = `${rCurYear}-${String(rCurMonth+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
        const esPasado = fecha < hoy;
        const noTrabaja= !horario;
        const esSelec  = fechaStr === selectedFecha;
        const esHoy    = fecha.getTime() === hoy.getTime();
 
        const cell = document.createElement('div');
        cell.textContent = d;
 
        if (esPasado || noTrabaja) {
            cell.className = 'cal-day cal-disabled';
            cell.title = noTrabaja ? 'El barbero no trabaja este día' : 'Fecha pasada';
        } else {
            cell.className = 'cal-day' + (esSelec ? ' selected' : '') + (esHoy ? ' today' : '');
            cell.onclick = () => seleccionarFechaR(cell, fechaStr, horario);
        }
        grid.appendChild(cell);
    }
}
 
function prevMonthR() {
    rCurMonth--;
    if (rCurMonth < 0) { rCurMonth = 11; rCurYear--; }
    renderCalR();
}
function nextMonthR() {
    rCurMonth++;
    if (rCurMonth > 11) { rCurMonth = 0; rCurYear++; }
    renderCalR();
}
 
// ── FECHA ─────────────────────────────────────────────────────────
function seleccionarFechaR(el, fechaStr, horarioDia) {
    document.querySelectorAll('.cal-day.selected').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    selectedFecha = fechaStr;
    selectedHora  = '';
    document.getElementById('inputFechaReprog').value = fechaStr;
    document.getElementById('inputHoraReprog').value  = '';
    renderTimeSlotsR(fechaStr, horarioDia);
    checkSubmit();
}
 
// ── SLOTS ─────────────────────────────────────────────────────────
function renderTimeSlotsR(fechaStr, horarioDia) {
    const msg       = document.getElementById('rSlotsMsg');
    const container = document.getElementById('rTimeSlots');
 
    msg.style.display       = 'none';
    container.style.display = 'flex';
    container.innerHTML     = '';
 
    // Horas ocupadas ese día (excluir la cita que se está reprogramando)
    const ocupadas = barberoDisponibilidad.citasOcupadas
        .filter(c => c.fecha === fechaStr && c.id_cita !== CITA_ID)
        .map(c => c.hora);
 
    console.log('Fecha seleccionada:', fechaStr);
    console.log('Ocupadas:', ocupadas);
    console.log('Todas las citas:', barberoDisponibilidad.citasOcupadas);
 
    const [hIni, mIni] = horarioDia.hora_inicio.split(':').map(Number);
    const [hFin, mFin] = horarioDia.hora_fin.split(':').map(Number);
    const minInicio    = hIni * 60 + mIni;
    const minFin       = hFin * 60 + mFin;
 
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
            el.onclick = () => seleccionarHoraR(el, slot);
        }
        container.appendChild(el);
    }
 
    if (container.children.length === 0) {
        msg.textContent         = 'Sin horarios disponibles para este día.';
        msg.style.display       = 'block';
        container.style.display = 'none';
    }
}
 
function seleccionarHoraR(btn, hora) {
    document.querySelectorAll('#rTimeSlots .time-slot').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    selectedHora = hora;
    document.getElementById('inputHoraReprog').value = hora;
    actualizarResumen();
    checkSubmit();
}
 
// ── RESUMEN ───────────────────────────────────────────────────────
function actualizarResumen() {
    if (!selectedFecha || !selectedHora) return;
    document.getElementById('rResumenCard').style.display = 'block';
    const partes   = selectedFecha.split('-');
    const fechaObj = new Date(+partes[0], +partes[1]-1, +partes[2]);
    const fechaFmt = DIAS_LABEL[fechaObj.getDay()] + ' ' + fechaObj.getDate() +
                     ' de ' + MESES[fechaObj.getMonth()] + ' ' + fechaObj.getFullYear();
    document.getElementById('rSumBarbero').textContent = selectedBarberoName;
    document.getElementById('rSumFecha').textContent   = fechaFmt;
    document.getElementById('rSumHora').textContent    = selectedHora;
}
 
function checkSubmit() {
    const btn = document.getElementById('btnReprogramar');
    const ok  = selectedFecha && selectedHora && selectedBarberoId;
    btn.disabled      = !ok;
    btn.style.opacity = ok ? '1' : '.4';
    btn.style.cursor  = ok ? 'pointer' : 'not-allowed';
}
 
// ── INIT ──────────────────────────────────────────────────────────
// Carga disponibilidad y preselecciona la fecha original de la cita
cargarDisponibilidadBarbero(selectedBarberoId, FECHA_ORIGINAL);
</script>
</body>
</html>
 