<?php

namespace App\Http\Controllers;

use App\Models\User\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

date_default_timezone_set("America/Lima");

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = auth()->user()->documents;

        $cars = auth()->user()->cars;

        $carDocs = auth()->user()
            ->documents()
            ->with('car')
            ->whereNotNull('car_id')
            ->get()
            ->groupBy('car_id');

        return view('users.documentos')->with(['documents' => $documents, 'cars' => $cars, 'carDocs' => $carDocs]);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'tipo' => 'required|string',
                'name' => 'required|string',
                'licen' => 'nullable|string',
                'empresa' => 'nullable|string',
                'categoria' => 'nullable|string',
                'imagen'  => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
                'fecEmit'  => 'required|string',
                'fecRenov'  => 'required|string',
                'car_id' => 'nullable|string',
            ]);
            $data['user_id'] = Auth::id();
            $data['imagen'] = $request->file('imagen')->store('documents', 'public');
            Document::create($data);
            return redirect()->route(route: 'document.index')->with('flash_message', 'Addedd!');
        } catch (\Throwable $th) {
            Log::error('Error al actualizar vehículo', [
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
            ]);
            return redirect()->route('document.index')->with('error_message', 'Error!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        // $carId = $car->id; // o desde request

        // $documents =    Document::where('car_id', $carId)
        //     ->where('user_id', auth()->id())
        //     ->get();
    }


    public function edit(Document $document)
    {


        return response()->json([
            'name' => $document->name,
            'licen' => $document->licen,
            'empresa' => $document->empresa,
            'categoria' => $document->categoria,
            'imagen'  => $document->imagen
                ? asset('storage/' . $document->imagen)
                : null,
            'fecEmit' => $document->fecEmit,
            'fecRenov' => $document->fecRenov,
            'car_id' => $document->car_id,
            'carPlaca' => $document->car
                ? $document->car->marca . ' || ' . $document->car->placa
                : null,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        try {

            $data = $request->validate([
                'name'   => 'required|string',
                'licen'   => 'nullable|string',
                'empresa'  => 'nullable|string',
                'categoria' => 'nullable|integer',
                'imagen'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'fecEmit'  => 'required|string',
                'fecRenov'  => 'required|string',
                'car_id'  => 'nullable|string',



            ]);
            if ($request->hasFile('imagen')) {

                if ($document->imagen && Storage::disk('public')->exists($document->imagen)) {
                    Storage::disk('public')->delete($document->imagen);
                }

                $data['imagen'] = $request->file('imagen')->store('documents', 'public');
            }

            $document->update($data);

            return redirect()->route('document.index')->with('flash_message', 'Updated!');
        } catch (\Throwable $th) {

            Log::error('Error al actualizar vehículo', [
                'document_id' => $document->id ?? null,
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
            ]);

            return redirect()
                ->route('document.index')
                ->with('error_message', 'Error!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        try {
            if ($document->imagen && Storage::disk('public')->exists($document->imagen)) {
                Storage::disk('public')->delete($document->imagen);
            }
            $document->delete();
            return redirect()->route('document.index')->with('flash_message', 'deleted!');
        } catch (\Throwable $th) {
            return redirect()->route('document.index')->with('error_message', value: 'Error!');
        }
    }
}
