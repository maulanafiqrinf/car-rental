<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query();

        // Filter berdasarkan merek
        if ($request->has('brand') && $request->brand) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        // Filter berdasarkan model
        if ($request->has('model') && $request->model) {
            $query->where('model', 'like', '%' . $request->model . '%');
        }

        // Filter berdasarkan ketersediaan
        if ($request->has('available') && $request->available != '') {
            $query->where('available', $request->available);
        }

        // Dapatkan daftar mobil yang sesuai dengan filter
        $cars = $query->get();

        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'license_plate' => 'required|unique:cars',
            'rental_rate_per_day' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        // Mengambil data input
        $data = $request->only(['brand', 'model', 'license_plate', 'rental_rate_per_day', 'available']);

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('car_images', 'public');
            $data['image'] = $imagePath;
        }

        Car::create($data);

        return redirect()->route('cars.index')->with('success', 'Mobil berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'license_plate' => 'required|unique:cars,license_plate,' . $id,
            'rental_rate_per_day' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        $car = Car::findOrFail($id);

        // Mengambil data input
        $data = $request->only(['brand', 'model', 'license_plate', 'rental_rate_per_day', 'available']);

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('car_images', 'public');
            $data['image'] = $imagePath;
        }

        $car->update($data);

        return redirect()->route('cars.index')->with('success', 'Mobil berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Mobil berhasil dihapus.');
    }
}
