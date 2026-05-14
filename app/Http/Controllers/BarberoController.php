<?php

namespace App\Http\Controllers;

use App\Models\Barbero;
use App\Models\BloqueAlmuerzo;
use App\Models\Pago;
use App\Models\Usuario;
use App\Models\Cita;
use App\Models\NovedadDisponibilidad;
use App\Models\Publicacion;
use App\Models\Reprogramacion;
use App\Models\Servicio;
use App\Validations\Validacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BarberoController extends Controller
{
    private function barberoId(): int
    {
        return Auth::user()->barbero->id_barbero;
    }

    public function store(Request $request)
    {
        $validador = Validacion::barbero($request->all());

        if ($validador->fails()) {
            return back()
                ->withErrors($validador, 'barberoForm')
                ->withInput()
                ->with('panel', 'barber-register');
        }

        try {
            DB::transaction(function () use ($request) {
                $usuario = Usuario::create([
                    'nombre' => $request->nombre,
                    'email' => $request->email,
                    'usuario' => $request->usuario,
                    'contrasena' => Hash::make($request->password),
                    'telefono' => $request->telefono,
                    'especialidad' => $request->especialidad,
                    'bio' => $request->bio,
                    'rol' => 'barbero',
                    'estado' => 1,
                ]);

                Barbero::create([
                    'id_usuario' => $usuario->id_usuario,
                ]);
            });
        } catch (\Exception $e) {
            return back()
                ->withErrors(['general' => 'Error al registrar el barbero: ' . $e->getMessage()], 'barberoForm')
                ->withInput()
                ->with('panel', 'barber-register');
        }

        return redirect()->route('admin.dashboard')
            ->with('success', 'Barbero registrado exitosamente.')
            ->with('panel', 'barbers-list');
    }

    public function dashboard()
    {
        $idBarbero = $this->barberoId();

        $inicioSemana = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $finSemana = $inicioSemana->copy()->endOfWeek(Carbon::SUNDAY);
        $posts     = Publicacion::with(['imagenes', 'muro.usuario'])
                        ->orderBy('fecha', 'desc')
                        ->get();
        $fechaFiltro = Carbon::today();

        $citasHoy = Cita::with(['cliente', 'servicios'])
            ->where('id_barbero', $idBarbero)
            ->whereDate('fecha_cita', $fechaFiltro)
            ->orderBy('hora_cita')
            ->get();

        $citasDelDia = $citasHoy;
        $servicios = Servicio::all();

        $citasSinAtender = $citasHoy->where('estado', 'Confirmada');

        $citasSemana = Cita::with(['cliente', 'servicios'])
            ->where('id_barbero', $idBarbero)
            ->whereBetween('fecha_cita', [
    $inicioSemana->toDateString(),
    $finSemana->toDateString(),
])
            ->orderBy('hora_cita')
            ->get()
            ->groupBy(fn($c) => Carbon::parse($c->fecha_cita)->toDateString());

        $totalCitasHoy = $citasHoy->count();

        return view('dashboard_barbero', compact(
            'citasHoy',
            'citasDelDia',
            'citasSemana',
            'citasSinAtender',
            'inicioSemana',
            'finSemana',
            'fechaFiltro',
            'totalCitasHoy',
            'servicios',
            'posts'
        ));
    }

    public function actualizarEstado(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);
        $cita->estado = $request->estado;
        $cita->save();

        return redirect()->route('barber.agenda', [
            'fecha' => Carbon::parse($cita->hora_cita)->toDateString(),
            'panel' => 'agenda'
        ])->with('success', 'Cita confirmada.');
    }

    public function cancelarCita($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->estado = 'Cancelada';
        $cita->save();

        return redirect()->route('barber.agenda', [
            'fecha' => Carbon::parse($cita->hora_cita)->toDateString(),
            'panel' => 'agenda'
        ])->with('success', 'Cita cancelada.');
    }

    public function agenda(Request $request)
    {
        $idBarbero = $this->barberoId();

        $inicioSemana = $request->filled('semana')
            ? Carbon::parse($request->semana)->startOfWeek(Carbon::MONDAY)
            : Carbon::now()->startOfWeek(Carbon::MONDAY);

        $finSemana = $inicioSemana->copy()->endOfWeek(Carbon::SUNDAY);

        $citasSemana = Cita::where('id_barbero', $this->barberoId())
            ->whereBetween('fecha_cita', [
                    $inicioSemana->toDateString(),
                    $finSemana->toDateString(),
                ])
            ->whereIn('estado', ['Pendiente', 'Confirmada'])
            ->with(['cliente', 'servicios'])
            ->get()
            ->groupBy(fn($c) => Carbon::parse($c->fecha_cita)->toDateString());

        $fechaFiltro = $request->filled('fecha')
            ? Carbon::parse($request->fecha)
            : Carbon::today();

        $bloqueHoy = BloqueAlmuerzo::where('id_barbero', $this->barberoId())
            ->whereDate('fecha', today())
            ->first();
        $novedades = NovedadDisponibilidad::where('id_barbero', $this->barberoId())
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        

        $citasDelDia = Cita::where('id_barbero', $this->barberoId())
            ->whereDate('fecha_cita', $fechaFiltro)
            ->whereIn('estado', ['Pendiente', 'Confirmada'])
            ->orderBy('hora_cita')
            ->with(['cliente', 'servicios'])
            ->get();

        $citasHoy = $citasDelDia;

        $citasSinAtender = $citasHoy->where('estado', 'Confirmada');
        $totalCitasHoy = $citasHoy->count();

        return view('dashboard_barbero', compact(
            'citasSemana',
            'citasHoy',
            'citasSinAtender',
            'citasDelDia',
            'inicioSemana',
            'finSemana',
            'fechaFiltro',
            'totalCitasHoy',
            'bloqueHoy',
            'novedades',

        ));
    }

    public function updateEstado(Request $request, int $idCita)
    {
        $request->validate([
            'estado' => ['required', 'in:Pendiente,Confirmada,Cancelada'],
        ]);

        $cita = Cita::where('id_cita', $idCita)
            ->where('id_barbero', $this->barberoId())
            ->firstOrFail();

        $cita->estado = $request->estado;
        $cita->save();

        return back()->with('success', 'Estado actualizado.');
    }

    public function cancelar(int $idCita)
    {
        $cita = Cita::where('id_cita', $idCita)
            ->where('id_barbero', $this->barberoId())
            ->firstOrFail();

        $cita->estado = 'Cancelada';
        $cita->save();

        return back()->with('success', 'Cita cancelada.');
    }

    public function updateProfile(Request $request)
    {
        $user = Usuario::findOrFail(auth()->user()->id_usuario);

        $user->update([
            'nombre' => $request->name,
            'email' => $request->email,
            'telefono' => $request->phone,
            'especialidad' => $request->specialty,
            'bio' => $request->bio,
        ]);

        return back()->with('success', 'Perfil actualizado correctamente.');
    }

    public function updatePassword(Request $request)
    {
        $user = Usuario::findOrFail(auth()->user()->id_usuario);

        if (!Hash::check($request->current_password, $user->contrasena)) {
            return back()->withErrors(['current_password' => 'Contraseña incorrecta.']);
        }

        if ($request->password !== $request->password_confirmation) {
            return back()->withErrors(['password' => 'No coinciden.']);
        }

        $user->update([
            'contrasena' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Contraseña actualizada.');
    }

    public function atenderPanel()
    {
        $hoy = now()->toDateString();

        $citas = Cita::with(['cliente', 'servicios'])
            ->where('id_barbero', auth()->id())
            ->whereDate('hora_cita', $hoy)
            ->where('estado', 'Confirmada')
            ->get();

        return view('barber.atender', compact('citas'));
    }

    public function completarCita(Request $request, $id)
    {
        $cita = Cita::with('servicios')->findOrFail($id);
        $total = $cita->servicios->sum('precio');

        Pago::create([
            'id_cita' => $cita->id_cita,
            'monto' => $total,
            'metodo' => $request->metodo ?? 'Efectivo'
        ]);

        $cita->estado = 'Completada';
        $cita->save();

        return back()->with('success', 'Cita completada y pago registrado');
    }
    public function storeService(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'duracion' => 'required|integer|min:1',
        ]);

        Servicio::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'duracion' => $request->duracion,
        ]);

        return back()->with('success', 'Servicio creado correctamente.');
    }

    public function reprogramarCita(Request $request, $id)
    {
        $request->validate([
            'nueva_hora'            => 'required|date',
            'motivo_reprogramacion' => 'required|string|max:500',
        ]);

        $cita = Cita::where('id_cita', $id)
                    ->where('id_barbero', $this->barberoId()) // ← usa el helper correcto
                    ->firstOrFail();

        Reprogramacion::create([
            'id_cita'       => $cita->id_cita,
            'id_barbero'    => $this->barberoId(),
            'hora_original' => $cita->hora_cita,
            'hora_nueva'    => $request->nueva_hora,
            'motivo'        => $request->motivo_reprogramacion,
        ]);

        $cita->hora_cita = $request->nueva_hora;
        $cita->estado    = 'Reprogramada';
        $cita->save();

        return redirect()
            ->route('barber.agenda')
            ->with('success', 'Cita reprogramada correctamente.');
    }

    public function registrarAlmuerzo(Request $request)
    {
        $request->validate([
            'fecha'       => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required|in:12:00,13:00',
        ]);
    
        $horaFin = BloqueAlmuerzo::calcularFin($request->hora_inicio);
    
        BloqueAlmuerzo::updateOrCreate(
            [
                'id_barbero' => $this->barberoId(),
                'fecha'      => $request->fecha,
            ],
            [
                'hora_inicio'    => $request->hora_inicio,
                'hora_fin'       => $horaFin,
                'automatico'     => false,
                'id_cita_origen' => null,
            ]
        );
    
        return back()->with('success', 'Bloque de almuerzo registrado: '
            . $request->hora_inicio . ' – ' . $horaFin . '.');
    }

    public function registrarNovedad(Request $request)
    {
        $request->validate([
            'fecha'         => 'required|date',
            'tipo'          => 'required|in:inasistencia,cancelacion_anticipada,otro',
            'motivo'        => 'required|string|min:10|max:600',
            'hora_afectada' => 'nullable|date_format:H:i',
        ]);
    
        NovedadDisponibilidad::create([
            'id_barbero'    => $this->barberoId(),
            'fecha'         => $request->fecha,
            'tipo'          => $request->tipo,
            'motivo'        => $request->motivo,
            'hora_afectada' => $request->hora_afectada,
            'estado'        => 'pendiente',
        ]);

        if ($request->tipo === 'cancelacion_anticipada' && $request->hora_afectada) {
            Cita::where('id_barbero', $this->barberoId())
                ->whereDate('fecha_cita', $request->fecha)
                ->where('hora_cita', 'like', $request->hora_afectada . '%')
                ->whereIn('estado', ['Pendiente', 'Confirmada'])
                ->update(['estado' => 'Cancelada']);
        }
    
        return back()->with('success', 'Novedad registrada. Queda pendiente de aprobación.');
    }

    
}
