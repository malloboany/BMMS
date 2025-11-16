<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MyResult;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'min:3', 'max:250'],
            'phone' => ['required', 'string', 'max:30', 'regex:/^\\+?[0-9]+$/'],
            'booking_date' => ['required', 'date'],
            'service_type_id' => ['required', 'integer', 'exists:service_types,id'],
            'notes' => ['nullable', 'string'],
        ]);

        $booking = Booking::create([
            ...$validated,
            'status' => 'pending',
        ]);

        return MyResult::success(
            $booking->load('serviceType:id,name'),
            'Booking created successfully.',
            201,
        );
    }
}
