<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Property;
use Carbon\Carbon;


class ReservationController extends Controller
{
    public function getReservations(){
        $reservations = Reservation::all();
        return response()->json($reservations);
    }
    public function getUserReservations(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        $reservations = Reservation::where('user_id', $request->user_id)
        ->with(['property', 'user'])
        ->get();

        return response()->json($reservations);
    }

    public function makeReservation(Request $request)
{
    try {
        // Validar datos básicos (sin validación de rango de fechas todavía)
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date',
        ]);

        // Convertir las fechas en objetos Carbon
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Validación manual: end_date debe ser después de start_date
        if ($startDate->greaterThan($endDate)) {
            return response()->json([
                'success' => false,
                'message' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
            ], 422);
        }

        // Continuar con la lógica de reserva
        $propertyId = $request->property_id;

        // Verificar si la propiedad está ocupada en el rango de fechas
        $isOccupied = Reservation::where('property_id', $propertyId)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                      ->orWhereBetween('end_date', [$startDate, $endDate])
                      ->orWhere(function ($query) use ($startDate, $endDate) {
                          $query->where('start_date', '<=', $startDate)
                                ->where('end_date', '>=', $endDate);
                      });
            })
            ->exists();

        if ($isOccupied) {
            return response()->json([
                'success' => false,
                'message' => 'La propiedad está ocupada en el rango de fechas seleccionado.',
            ]);
        }

        // Calcular el precio total
        $property = Property::findOrFail($propertyId);
        $days = $startDate->diffInDays($endDate) + 1; // Incluir el último día
        $totalPrice = $property->price_per_night * $days;

        // Crear la reserva
        $reservation = Reservation::create([
            'user_id' => $request->user_id,
            'property_id' => $propertyId,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_price' => $totalPrice,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reserva creada con éxito.',
            'reservation' => $reservation,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Ocurrió un error al procesar la solicitud.',
            'error' => $e->getMessage(),
        ], 500);
    }
}


    
    

}
