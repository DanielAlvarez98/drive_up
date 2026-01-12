<?php

namespace App\Http\Controllers;

use App\Models\User\Car;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set("America/Lima");

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $cars = auth()->user()->cars;

        $today = Carbon::today();
        $limit = $today->copy()->addDays(10);
        $cars = auth()->user()->cars->map(function ($car) use ($today, $limit) {

            $alerts = [];

            // DOCUMENTOS
            foreach ($car->documents as $doc) {
                if (!$doc->fecRenov) continue;

                $fec = Carbon::parse($doc->fecRenov);

                if ($fec->isPast()) {
                    $alerts[] = [
                        'date'  => $fec->format(format: 'Y-m-d'),
                        'icon'  => 'bg-danger-subtle text-danger',
                        'title' => $doc->name,
                    ];
                } elseif ($fec->lte($limit)) {
                    $alerts[] = [
                        'date'  => $fec->format('Y-m-d'),
                        'icon'  => 'bg-warning-subtle text-warning',
                        'title' => $doc->name,
                    ];
                }
            }

            // MANTENIMIENTOS
            foreach ($car->maintenances as $mnt) {
                if (!$mnt->fecRenov) continue;

                $fec = Carbon::parse($mnt->fecRenov);

                if ($fec->isPast()) {
                    $alerts[] = [
                        'date'  => $fec->format('Y-m-d'),
                        'icon'  => 'bg-danger-subtle text-danger',
                        'title' => $mnt->name,

                    ];
                } elseif ($fec->lte($limit)) {
                    $alerts[] = [
                        'date'  => $fec->format('Y-m-d'),
                        'icon'  => 'bg-warning-subtle text-warning',
                        'title' => $mnt->name,

                    ];
                }
            }

            return [
                'id'     => $car->id,
                'marca'  => $car->marca,
                'placa'  => $car->placa,
                'imagen'  => $car->imagen,
                'alerts' => $alerts,
            ];
        });

        return view('home')->with('cars', $cars);
    }

    public function show(Car $car)
    {
        $today = Carbon::today();
        $limit = $today->copy()->addDays(10);

        $alerts = [];

        // DOCUMENTOS
        foreach ($car->documents as $doc) {
            if (!$doc->fecRenov) continue;

            $fec = Carbon::parse($doc->fecRenov);

            if ($fec->lt($today)) {
                $alerts[] = [
                    'icon' => ' bi-file-excel',
                    'type' => 'danger',
                    'title' => $doc->name,
                    'days' => $today->diffInDays($fec),
                    'text' => 'Vencido hace'
                ];
            } elseif ($fec->lte($limit)) {
                $alerts[] = [
                    'icon' => 'bi-exclamation-triangle',
                    'type' => 'warning',
                    'title' => $doc->name,
                    'days' => $today->diffInDays($fec),
                    'text' => 'Vence en'
                ];
            }
        }

        // MANTENIMIENTOS
        foreach ($car->maintenances as $mnt) {
            if (!$mnt->fecRenov) continue;

            $fec = Carbon::parse($mnt->fecRenov);

            if ($fec->lt($today)) {
                $alerts[] = [
                    'icon' => ' bi-file-excel',
                    'type' => 'danger',
                    'title' => $mnt->name,
                    'days' => $today->diffInDays($fec),
                    'text' => 'Vencido hace'
                ];
            } elseif ($fec->lte($limit)) {
                $alerts[] = [
                    'icon' => 'bi-exclamation-triangle',
                    'type' => 'warning',
                    'title' => $mnt->name,
                    'days' => $today->diffInDays($fec),
                    'text' => 'Vence en'
                ];
            }
        }

        return view('users.autos.show', compact('car', 'alerts'));
    }

    public function recorda()
    {
        $today = Carbon::today();
        $limit = $today->copy()->addDays(10);

        $cars = auth()->user()->cars->map(function ($car) use ($today, $limit) {

            $alerts = [];

            // DOCUMENTOS
            foreach ($car->documents as $doc) {
                if (!$doc->fecRenov) continue;

                $fec = Carbon::parse($doc->fecRenov);

                if ($fec->isPast()) {
                    $alerts[] = [
                        'date'  => $fec->format('Y-m-d'),
                        'icon'  => 'bi-file-excel',
                        'type'  => 'danger',
                        'title' => $doc->name,
                        'days'  => $fec->diffInDays($today),
                        'text'  => 'Vencido hace',
                    ];
                } elseif ($fec->lte($limit)) {
                    $alerts[] = [
                        'date'  => $fec->format('Y-m-d'),

                        'icon'  => 'bi-exclamation-triangle',
                        'type'  => 'warning',
                        'title' => $doc->name,
                        'days'  => $today->diffInDays($fec),
                        'text'  => 'Vence en',
                    ];
                }
            }

            // MANTENIMIENTOS
            foreach ($car->maintenances as $mnt) {
                if (!$mnt->fecRenov) continue;

                $fec = Carbon::parse($mnt->fecRenov);

                if ($fec->isPast()) {
                    $alerts[] = [
                        'date'  => $fec->format('Y-m-d'),
                        'icon'  => 'bi-file-excel',
                        'type'  => 'danger',
                        'title' => $mnt->name,
                        'days'  => $fec->diffInDays($today),
                        'text'  => 'Vencido hace',
                    ];
                } elseif ($fec->lte($limit)) {
                    $alerts[] = [
                        'date'  => $fec->format('Y-m-d'),
                        'icon'  => 'bi-exclamation-triangle',
                        'type'  => 'warning',
                        'title' => $mnt->name,
                        'days'  => $today->diffInDays($fec),
                        'text'  => 'Vence en',
                    ];
                }
            }

            return [
                'id'     => $car->id,
                'marca'  => $car->marca,
                'placa'  => $car->placa,
                'alerts' => $alerts,
            ];
        });

        return view('users.recordatorios', data: compact('cars'));
    }


    public function perfil()
    {
        $user = auth()->user();

        return view('users.perfil', data: compact('user'));
    }
    public function editPerfil(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'name'   => 'required|string',
            'email'   => 'required|string',
            'phone'  => 'nullable|string|max:9',
        ]);
        $user->update($data);

        return redirect()->route('perfil.show')->with(['user' => $user, 'flash_message' => 'Updated!']);
    }
}
