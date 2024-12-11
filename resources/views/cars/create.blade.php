@extends('templates.dashboard.app')

@section('content')
    <div class="body-wrapper">
        @include('templates.includes.headbar')
        <br />
        <br />
        <br />

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Mobil</h5>
                <form action="{{ route('cars.store') }}" method="POST" id="addform" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand:</label>
                        <input type="text" id="brand" name="brand" class="form-control @error('brand') is-invalid @enderror" required>
                        @error('brand')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="model" class="form-label">Model:</label>
                        <input type="text" id="model" name="model" class="form-control @error('model') is-invalid @enderror" required>
                        @error('model')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="license_plate" class="form-label">License Plate:</label>
                        <input type="text" id="license_plate" name="license_plate" class="form-control @error('license_plate') is-invalid @enderror" required>
                        @error('license_plate')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="rental_rate_per_day" class="form-label">Rental Rate per Day:</label>
                        <input type="number" id="rental_rate_per_day" name="rental_rate_per_day" min="0" class="form-control @error('rental_rate_per_day') is-invalid @enderror" required>
                        @error('rental_rate_per_day')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Gambar Mobil</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                        @error('image')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah Mobil</button>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('addform').addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin ingin menambah mobil?',
                text: "penambahan bisa diedit!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tambah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit the form if confirmed
                }
            });
        });
    </script>
@endsection
