<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'brand', 
        'model', 
        'license_plate', 
        'rental_rate_per_day', 
        'available', 
        'image' // Tambahkan field 'image' jika gambar dimasukkan
    ];

    // Default value for available
    protected $attributes = [
        'available' => 1, // Mobil tersedia secara default
    ];

    // Relasi dengan Rental
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
