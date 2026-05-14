<?php

namespace App\Http\Controllers;

use App\Models\Barbero;
use App\Models\Cita;
use App\Models\ConfiguracionFila;
use App\Models\Publicacion;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ClienteController extends Controller
{
    public function dashboard()
    {
        $servicios = Servicio::all();
        $barberos = Barbero::with('usuario')
            ->whereHas('usuario', function ($query) {
                $query->where('estado', 1);
            })
            ->get();
        $publicaciones = Publicacion::with([
            'muro.usuario',
            'imagenes'
        ])->orderBy('fecha', 'desc')->get();

        $idCliente = Auth::user()->cliente->id_cliente;
        $citas = Cita::with(['barbero.usuario', 'servicios', 'reprogramaciones', 'resena'])
             ->where('id_cliente', $idCliente)
             ->get();
        $filaActiva = ConfiguracionFila::vigente() !== null;

        return view('dashboard_cliente', compact('publicaciones', 'servicios', 'barberos', 'citas', 'filaActiva'));
    }

    public function reprogramarForm($id)
    {
        $idCliente = Auth::user()->cliente->id_cliente;

        $cita = Cita::with(['servicios', 'barbero.usuario'])
            ->where('id_cita', $id)
            ->where('id_cliente', $idCliente)
            ->whereIn('estado', ['Pendiente', 'Confirmada'])
            ->firstOrFail();

        $barberos = Barbero::with('usuario')
            ->whereHas('usuario', fn($q) => $q->where('estado', 1))
            ->get();

        return view('cliente.reprogramar', compact('cita', 'barberos'));
    }

    public function reprogramar(Request $request, $id)
    {
        $request->validate([
            'fecha_cita' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $fecha = Carbon::parse($value)->startOfDay();
                    $hoy   = Carbon::now()->startOfDay();

                    if ($fecha->lt($hoy)) {
                        $fail('La fecha de la cita debe ser hoy o una fecha futura.');
                    }
                }
            ],
            'hora_cita' => ['required', 'date_format:H:i'],
            'id_barbero' => ['required', 'exists:barberos,id_barbero'],
        ]);
        $fechaHora = Carbon::parse($request->fecha_cita . ' ' . $request->hora_cita);

        if ($fechaHora->lt(Carbon::now())) {
            return back()
                ->withErrors(['hora_cita' => 'No puedes seleccionar una fecha u hora pasada.'])
                ->withInput();
        }

        $idCliente = Auth::user()->cliente->id_cliente;

        $cita = Cita::with('servicios')
            ->where('id_cita', $id)
            ->where('id_cliente', $idCliente)
            ->whereIn('estado', ['Pendiente', 'Confirmada'])
            ->firstOrFail();

        $nuevaHora    = Carbon::parse($request->fecha_cita . ' ' . $request->hora_cita);
        $duracion     = $cita->servicios->sum('duracion');
        $nuevaHoraFin = $nuevaHora->copy()->addMinutes($duracion);

        // Validar horario del local (8:00 - 20:00)
        $apertura = Carbon::parse($request->fecha_cita . ' 08:00');
        $cierre   = Carbon::parse($request->fecha_cita . ' 20:00');

        if ($nuevaHora->lt($apertura) || $nuevaHoraFin->gt($cierre)) {
            return back()
                ->withErrors(['hora_cita' => 'El horario está fuera del horario de atención (8:00 AM – 8:00 PM).'])
                ->withInput();
        }

        // Validar conflictos con otras citas del barbero
        $conflicto = Cita::with('servicios')
            ->where('id_barbero', $request->id_barbero)
            ->where('id_cita', '!=', $cita->id_cita)
            ->where('fecha_cita', $request->fecha_cita)
            ->whereIn('estado', ['Pendiente', 'Confirmada'])
            ->get()
            ->first(function ($otraCita) use ($nuevaHora, $nuevaHoraFin) {
                $otraInicio = Carbon::parse($otraCita->hora_cita);
                $otraFin    = $otraInicio->copy()->addMinutes(
                    $otraCita->servicios->sum('duracion')
                );
                return $nuevaHora->lt($otraFin) && $nuevaHoraFin->gt($otraInicio);
            });

        if ($conflicto) {
            return back()
                ->withErrors(['hora_cita' => 'Ese horario ya está ocupado. Elige otro.'])
                ->withInput();
        }

        // Guardar
        $cita->id_barbero = $request->id_barbero;
        $cita->fecha_cita = $request->fecha_cita;
        $cita->hora_cita  = $nuevaHora->format('H:i:s');
        $cita->estado     = 'Pendiente';
        $cita->save();

        return redirect()
            ->route('dashboard.cliente')
            ->with('success', 'Cita reprogramada. Queda pendiente de confirmación por el barbero.');
    }

    public function slotsDisponibles(Request $request)
    {
        $request->validate([
            'fecha'      => 'required|date',
            'id_barbero' => 'required|exists:barberos,id_barbero',
            'id_cita'    => 'nullable|exists:citas,id_cita',
        ]);

        // Generar todos los slots del día cada 30 min
        $slots = [];
        $cursor = Carbon::parse($request->fecha . ' 08:00');
        $fin    = Carbon::parse($request->fecha . ' 20:00');
        while ($cursor->lt($fin)) {
            $slots[] = $cursor->format('H:i');
            $cursor->addMinutes(30);
        }

        // Citas ocupadas ese día para ese barbero
        $citasOcupadas = Cita::with('servicios')
            ->where('id_barbero', $request->id_barbero)
            ->where('fecha_cita', $request->fecha)
            ->whereIn('estado', ['Pendiente', 'Confirmada'])
            ->when($request->id_cita, fn($q) => $q->where('id_cita', '!=', $request->id_cita))
            ->get();

        $slotsOcupados = [];
        foreach ($citasOcupadas as $c) {
            $cInicio = Carbon::parse($c->hora_cita);
            $cFin    = $cInicio->copy()->addMinutes($c->servicios->sum('duracion'));
            foreach ($slots as $slot) {
                $t = Carbon::parse($request->fecha . ' ' . $slot);
                if ($t->gte($cInicio) && $t->lt($cFin)) {
                    $slotsOcupados[] = $slot;
                }
            }
        }

        return response()->json(array_map(fn($s) => [
            'hora'       => $s,
            'disponible' => !in_array($s, $slotsOcupados),
        ], $slots));
    }

    public function cancelar($id)
    {
        $idCliente = Auth::user()->cliente->id_cliente;

        $cita = Cita::where('id_cita', $id)
            ->where('id_cliente', $idCliente)
            ->whereIn('estado', ['Pendiente', 'Confirmada'])
            ->firstOrFail();

        $cita->estado = 'Cancelada';
        $cita->save();

        return redirect()
            ->route('dashboard.cliente')
            ->with('success', 'Cita cancelada exitosamente.');
    }
}
