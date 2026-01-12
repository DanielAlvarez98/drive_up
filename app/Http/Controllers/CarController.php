<?php

namespace App\Http\Controllers;

use App\Models\User\Car;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
date_default_timezone_set("America/Lima");

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = auth()->user()->cars;


        return view('users.autos')->with('cars', $cars);
    }


    public function store(Request $request)
    {

        try {

            $data = $request->validate([
                'marca'   => 'required|string',
                'placa'   => 'required|string',
                'anhoFab'  => 'required|string|max:4',
                'km'      => 'required|integer',
                'modelo'  => 'required|string',
                'imagen'  => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            $data['user_id'] = Auth::id();

            $data['imagen'] = $request->file('imagen')->store('cars', 'public');
            Car::create($data);

            return redirect()->route('car.index')->with('flash_message', 'Addedd!');
        } catch (\Throwable $th) {
            return redirect()->route('car.index')->with('error_message', 'Error!');
        }
    }



    public function edit(Car $car)
    {
        return response()->json([
            'marca' => $car->marca,
            'placa' => $car->placa,
            'anhoFab' => $car->anhoFab,
            'km' => $car->km,
            'modelo' => $car->modelo,
            'imagen'  => $car->imagen
                ? asset('storage/' . $car->imagen)
                : null
        ]);
    }

    public function update(Request $request, Car $car)
    {
        try {

            $data = $request->validate([
                'marca'   => 'required|string',
                'placa'   => 'required|string',
                'anhoFab'  => 'required|string|max:4',
                'km'      => 'required|integer',
                'modelo'  => 'required|string',
                'imagen'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            ]);
            if ($request->hasFile('imagen')) {

                if ($car->imagen && Storage::disk('public')->exists($car->imagen)) {
                    Storage::disk('public')->delete($car->imagen);
                }

                $data['imagen'] = $request->file('imagen')->store('cars', 'public');
            }

            $car->update($data);

            return redirect()->route('car.index')->with('flash_message', 'Updated!');
        } catch (\Throwable $th) {

            Log::error('Error al actualizar vehículo', [
                'car_id' => $car->id ?? null,
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
            ]);

            return redirect()
                ->route('car.index')
                ->with('error_message', 'Error!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        try {
            if ($car->imagen && Storage::disk('public')->exists($car->imagen)) {
                Storage::disk('public')->delete($car->imagen);
            }
            $car->delete();
            return redirect()->route('car.index')->with('flash_message', 'deleted!');
        } catch (\Throwable $th) {
            return redirect()->route('car.index')->with('error_message', value: 'Error!');
        }
    }
}
