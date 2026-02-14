<?php

namespace App\Http\Controllers;

use App\Models\User\Maintenance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

date_default_timezone_set("America/Lima");

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = auth()->user()->cars;
        $carMants = auth()->user()
            ->cars()
            ->with(['maintenances' => function ($q) {
                $q->latest();
            }])
            ->has('maintenances')
            ->get();
        return view('users.mantenimientos')->with(['cars' => $cars, 'carMants' => $carMants]);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'marca' => 'required|string',
                'numero' => 'nullable|string',
                'price' => 'required|string',
                'km' => 'required|string',
                'fecEmit'  => 'required|string',
                'fecRenov'  => 'required|string',
                // 'imagen'  => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
                'car_id' => 'required|string',
            ]);
            $data['user_id'] = Auth::id();
            // $data['imagen'] = $request->file('imagen')->store('mant', 'public');

            Maintenance::create($data);
            return redirect()->route(route: 'mant.index')->with('flash_message', 'Addedd!');
        } catch (\Throwable $th) {
            Log::error('Error al actualizar vehículo', [
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
            ]);
            return redirect()->route('mant.index')->with('error_message', 'Error!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        return response()->json([
            'name' => $maintenance->name,
            'marca' => $maintenance->marca,
            'numero' => $maintenance->numero,
            'price' => $maintenance->price,
            'km' => $maintenance->km,

            // 'imagen'  => $maintenance->imagen
            //     ? asset('storage/' . $maintenance->imagen)
            //     : null,
            'fecEmit' => $maintenance->fecEmit,
            'fecRenov' => $maintenance->fecRenov,
            'car_id' => $maintenance->car_id,
            'carPlaca' => $maintenance->car
                ? $maintenance->car->marca . ' || ' . $maintenance->car->placa
                : null,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        try {

            $data = $request->validate([
                'name'   => 'required|string',
                'marca'   => 'required|string',
                'numero'  => 'nullable|string',
                'price'  => 'required|string',
                'km'  => 'required|string',

                // 'imagen'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'fecEmit'  => 'required|string',
                'fecRenov'  => 'required|string',
                'car_id'  => 'nullable|string',

            ]);
            // if ($request->hasFile('imagen')) {

            //     if ($maintenance->imagen && Storage::disk('public')->exists($maintenance->imagen)) {
            //         Storage::disk('public')->delete($maintenance->imagen);
            //     }

            //     $data['imagen'] = $request->file('imagen')->store('mant', 'public');
            // }

            $maintenance->update($data);

            return redirect()->route('mant.index')->with('flash_message', 'Updated!');
        } catch (\Throwable $th) {

            Log::error('Error al actualizar vehículo', [
                'maintenance_id' => $maintenance->id ?? null,
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
            ]);

            return redirect()
                ->route('mant.index')
                ->with('error_message', 'Error!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        try {
            // if ($maintenance->imagen && Storage::disk('public')->exists($maintenance->imagen)) {
            //     Storage::disk('public')->delete($maintenance->imagen);
            // }
            $maintenance->delete();
            return redirect()->route('mant.index')->with('flash_message', 'deleted!');
        } catch (\Throwable $th) {
            return redirect()->route('mant.index')->with('error_message', value: 'Error!');
        }
    }
}
