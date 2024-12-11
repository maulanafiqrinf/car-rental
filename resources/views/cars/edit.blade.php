@extends('templates.dashboard.app')

@section('content')
    <div class="body-wrapper">
        @include('templates.includes.headbar')
        <br />
        <br />
        <br />

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Update Mobil</h5>
                <form id="editCarForm" action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Brand Field -->
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand:</label>
                        <input type="text" id="brand" name="brand" value="{{ old('brand', $car->brand) }}"
                            class="form-control @error('brand') is-invalid @enderror" required>
                        @error('brand')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Model Field -->
                    <div class="mb-3">
                        <label for="model" class="form-label">Model:</label>
                        <input type="text" id="model" name="model" value="{{ old('model', $car->model) }}"
                            class="form-control @error('model') is-invalid @enderror" required>
                        @error('model')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- License Plate Field -->
                    <div class="mb-3">
                        <label for="license_plate" class="form-label">License Plate:</label>
                        <input type="text" id="license_plate" name="license_plate"
                            value="{{ old('license_plate', $car->license_plate) }}" class="form-control @error('license_plate') is-invalid @enderror" required>
                        @error('license_plate')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Rental Rate per Day Field -->
                    <div class="mb-3">
                        <label for="rental_rate_per_day" class="form-label">Rental Rate per Day:</label>
                        <input type="number" id="rental_rate_per_day" name="rental_rate_per_day"
                            value="{{ old('rental_rate_per_day', $car->rental_rate_per_day) }}" min="0"
                            class="form-control @error('rental_rate_per_day') is-invalid @enderror" required>
                        @error('rental_rate_per_day')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Field -->
                    <div class="form-group">
                        <label for="image">Gambar Mobil</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Display Existing Image -->
                    @if ($car->image)
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . $car->image) }}" alt="Gambar Mobil" style="max-width: 200px;">
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update Mobil</button>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('editCarForm').addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin ingin mengupdate mobil?',
                text: "Perubahan akan diterapkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, update!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit the form if confirmed
                }
            });
        });
    </script>
@endsection
