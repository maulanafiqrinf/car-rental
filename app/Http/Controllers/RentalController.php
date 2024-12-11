<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            // 'start_date' => 'required|date|after_or_equal:today',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $car = Car::find($request->car_id);

        if (!$car || $car->available == 0) {
            return redirect()->back()->withErrors('Mobil tidak tersedia untuk tanggal yang dipilih.');
        }

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $days = $endDate->diffInDays($startDate) + 1;
        $totalPrice = $car->rental_rate_per_day * $days;

        Rental::create([
            'user_id' => Auth::id(),
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $totalPrice,
        ]);

        $car->update(['available' => 0]);

        return redirect()->route('rentals.index')->with('success', 'Mobil berhasil disewa.');
    }

    public function index()
    {
        if (Auth::user()->role === 'admin') {
            // Admin sees all rentals
            $rentals = Rental::with('car', 'user')->get();
        } else {
            // Users see only their own rentals
            $rentals = Rental::where('user_id', Auth::id())->with('car')->get();
        }
        
        $availableCars = Car::where('available', 1)->get();

        return view('rentals.index', compact('rentals', 'availableCars'));
    }

    public function return(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|string',
        ]);

        $car = Car::where('license_plate', $request->license_plate)->first();

        if (!$car) {
            return redirect()->back()->withErrors('Mobil dengan nomor plat ini tidak ditemukan.');
        }

        $rental = Rental::where('car_id', $car->id)
                        ->where('user_id', Auth::id())
                        ->whereNull('returned_at')
                        ->first();

        if (!$rental) {
            return redirect()->back()->withErrors('Tidak ditemukan sewa aktif untuk mobil ini.');
        }

        $returnDate = Carbon::now();
        $startDate = Carbon::parse($rental->start_date);
        $daysRented = $returnDate->diffInDays($startDate) + 1;
        $totalPrice = $car->rental_rate_per_day * $daysRented;

        $rental->update([
            'returned_at' => $returnDate->toDateString(),
            'total_price' => $totalPrice,
        ]);

        $car->update(['available' => 1]);

        return redirect()->route('rentals.index')->with('success', "Mobil berhasil dikembalikan. Total biaya: $totalPrice");
    }
}

