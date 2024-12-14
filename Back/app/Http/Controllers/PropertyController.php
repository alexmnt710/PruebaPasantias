<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Type;
use App\Models\City;
use App\Models\Country;

class PropertyController extends Controller
{
    public function getProperties(){
        $properties = Property::with(['type', 'city', 'country'])->get();
        return response()->json($properties);
    }

    public function filterProperties(Request $request)
{
    // Validación de los datos recibidos
    $request->validate([
        'name' => 'string|nullable',
        'country_id' => 'integer|nullable',
        'types_id' => 'integer|nullable',
        'price_min' => 'numeric|nullable|min:0',
        'price_max' => 'numeric|nullable|min:0|gte:price_min',
    ]);

    // Construcción de la consulta dinámica con relaciones
    $query = Property::with(['type', 'city', 'country']);

    // Aplicar filtros condicionales ignorando valores vacíos
    if ($request->filled('name')) {
        $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
    }

    if ($request->filled('country_id')) {
        $query->where('country_id', $request->input('country_id'));
    }

    if ($request->filled('types_id')) {
        $query->where('types_id', $request->input('types_id'));
    }

    if ($request->filled('price_min')) {
        $query->where('price_per_night', '>=', $request->input('price_min'));
    }

    if ($request->filled('price_max')) {
        $query->where('price_per_night', '<=', $request->input('price_max'));
    }

    // Obtener las propiedades filtradas
    $properties = $query->get();

    // Verificar si se encontraron resultados
    if ($properties->isNotEmpty()) {
        // Retornar los resultados con relaciones
        return response()->json($properties);
    }

    // Si no se encuentran resultados, retornar un mensaje vacío
    return response()->json([
        'success'=> true ,'message' => 'No properties found for the given criteria.',
    ], 404);
}



}
