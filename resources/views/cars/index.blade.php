@extends('templates.dashboard.app')

@section('content')
    <div class="body-wrapper">
        @include('templates.includes.headbar')
        <br />
        <br />
        <br />
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Mobil</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <!-- Form Pencarian -->
                            <form method="GET" action="{{ route('cars.index') }}" class="mb-4">
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <input type="text" name="brand" class="form-control"
                                            placeholder="Cari berdasarkan merek" value="{{ request('brand') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="model" class="form-control"
                                            placeholder="Cari berdasarkan model" value="{{ request('model') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <select name="available" class="form-select">
                                            <option value="">Pilih Ketersediaan</option>
                                            <option value="1" {{ request('available') === '1' ? 'selected' : '' }}>
                                                Tersedia</option>
                                            <option value="0" {{ request('available') === '0' ? 'selected' : '' }}>
                                                Tidak Tersedia
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary w-100">Cari</button>
                                    </div>
                                </div>
                            </form>

                            <!-- Tombol Tambah Mobil -->
                            <a href="{{ route('cars.create') }}" class="btn btn-primary mb-4">Tambah Mobil</a>

                            <!-- Tabel Mobil -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Brand</th>
                                                    <th>Model</th>
                                                    <th>Nomor Plat</th>
                                                    <th>Tarif Sewa/Hari</th>
                                                    <th>Ketersediaan</th>
                                                    <th>Mobil</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cars as $car)
                                                    <tr>
                                                        <td>{{ $car->brand }}</td>
                                                        <td>{{ $car->model }}</td>
                                                        <td>{{ $car->license_plate }}</td>
                                                        <td>{{ $car->rental_rate_per_day }}</td>
                                                        <td>{{ $car->available ? 'Tersedia' : 'Tidak Tersedia' }}</td>
                                                        <td><img src="{{ asset('storage/' . $car->image) }}"
                                                                alt="Gambar Mobil" style="max-width: 200px;">
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('cars.edit', $car->id) }}"
                                                                class="btn btn-sm btn-info">Edit</a>
                                                            <form action="{{ route('cars.destroy', $car->id) }}"
                                                                method="POST" class="d-inline delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger">Hapus</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- SweetAlert JavaScript CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-form').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: 'Data ini akan dihapus dan tidak dapat dikembalikan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
