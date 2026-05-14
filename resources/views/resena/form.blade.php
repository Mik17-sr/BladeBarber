<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Califica tu experiencia — BladeBarber</title>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/BladeBarber/public/css/cliente-dash.css">
  <style>
    .stars { display:flex; gap:8px; flex-direction:row-reverse; justify-content:flex-end; }
    .stars input { display:none; }
    .stars label {
      font-size:32px; cursor:pointer; color:var(--border2);
      transition: color .15s;
    }
    .stars input:checked ~ label,
    .stars label:hover,
    .stars label:hover ~ label { color: #C9A84C; }
    .cal-row {
      display:flex; flex-direction:column; gap:8px;
      padding:16px 0; border-bottom:1px solid rgba(255,255,255,.07);
    }
    .cal-row:last-of-type { border-bottom:none; }
    .cal-label { font-size:13px; font-weight:500; color:var(--text); }
    .cal-sub   { font-size:11px; color:var(--muted2); margin-top:2px; }
  </style>
</head>
<body>
<div class="bg-scene">
  <div class="bg-grain"></div>
  <div class="bg-glow bg-glow--1"></div>
  <div class="bg-glow bg-glow--2"></div>
</div>

<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;">
  <div style="width:100%;max-width:520px;">

    {{-- Encabezado --}}
    <div style="text-align:center;margin-bottom:28px;">
      <div style="font-family:'Bebas Neue',sans-serif;font-size:32px;letter-spacing:3px;">
        ¿Cómo fue tu experiencia?
      </div>
      <div style="font-size:13px;color:var(--muted2);margin-top:6px;">
        Tu opinión ayuda a mejorar el servicio
      </div>
    </div>

    {{-- Info de la cita --}}
    <div class="card" style="margin-bottom:16px;">
      <div class="card-body" style="display:flex;align-items:center;gap:14px;padding:16px 20px;">
        <div class="li-avatar" style="flex-shrink:0;font-size:20px;">
          {{ strtoupper(substr($cita->barbero->usuario->nombre, 0, 1)) }}
        </div>
        <div>
          <div style="font-size:14px;font-weight:500;">
            {{ $cita->barbero->usuario->nombre }}
          </div>
          <div style="font-size:12px;color:var(--muted2);">
            {{ $cita->servicios->pluck('nombre')->join(', ') }}
            · {{ \Carbon\Carbon::parse($cita->hora_cita)->format('d M Y, H:i') }}
          </div>
        </div>
      </div>
    </div>

    {{-- Formulario --}}
    <div class="card">
      <div class="card-body" style="padding:24px;">
        <form method="POST" action="{{ route('resena.store', $cita->id_cita) }}">
          @csrf

          {{-- Calificación 1: Proceso de citación --}}
          <div class="cal-row">
            <div class="cal-label">Proceso de citación</div>
            <div class="cal-sub">¿Fue fácil agendar tu cita?</div>
            <div class="stars">
              @for($i = 5; $i >= 1; $i--)
              <input type="radio" name="cal_citacion" id="cit{{ $i }}" value="{{ $i }}"
                     {{ old('cal_citacion') == $i ? 'checked' : '' }} required>
              <label for="cit{{ $i }}" title="{{ $i }} estrellas">★</label>
              @endfor
            </div>
            @error('cal_citacion')
              <div style="font-size:11px;color:#f87171;">{{ $message }}</div>
            @enderror
          </div>

          {{-- Calificación 2: Trato del personal --}}
          <div class="cal-row">
            <div class="cal-label">Trato del personal</div>
            <div class="cal-sub">¿Cómo fue la atención de tu barbero?</div>
            <div class="stars">
              @for($i = 5; $i >= 1; $i--)
              <input type="radio" name="cal_trato" id="tra{{ $i }}" value="{{ $i }}"
                     {{ old('cal_trato') == $i ? 'checked' : '' }} required>
              <label for="tra{{ $i }}" title="{{ $i }} estrellas">★</label>
              @endfor
            </div>
            @error('cal_trato')
              <div style="font-size:11px;color:#f87171;">{{ $message }}</div>
            @enderror
          </div>

          {{-- Calificación 3: Resultado técnico --}}
          <div class="cal-row">
            <div class="cal-label">Resultado técnico</div>
            <div class="cal-sub">¿Quedaste satisfecho con el corte o servicio?</div>
            <div class="stars">
              @for($i = 5; $i >= 1; $i--)
              <input type="radio" name="cal_resultado" id="res{{ $i }}" value="{{ $i }}"
                     {{ old('cal_resultado') == $i ? 'checked' : '' }} required>
              <label for="res{{ $i }}" title="{{ $i }} estrellas">★</label>
              @endfor
            </div>
            @error('cal_resultado')
              <div style="font-size:11px;color:#f87171;">{{ $message }}</div>
            @enderror
          </div>

          {{-- Observaciones --}}
          <div style="margin-top:16px;">
            <label class="field-lbl">Observaciones adicionales</label>
            <textarea class="field-ta" name="observaciones"
              placeholder="Cuéntanos más sobre tu experiencia (opcional)..."
              style="min-height:100px;">{{ old('observaciones') }}</textarea>
          </div>

          <div class="form-actions" style="margin-top:20px;">
            <button type="submit" class="btn-violet" style="width:100%;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                   style="width:16px;height:16px;">
                <polyline points="9 11 12 14 22 4"/>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
              </svg>
              Enviar Reseña
            </button>
            <a href="{{ route('dashboard.cliente') }}"
               class="btn-outline"
               style="width:100%;text-align:center;text-decoration:none;
                      display:flex;align-items:center;justify-content:center;">
              Ahora no
            </a>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
</body>
</html>