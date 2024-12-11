@extends('templates.dashboard.app')

@section('content')
    <div class="body-wrapper">
        @include('templates.includes.headbar')
        <br/>
        <br/>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">rental</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (Auth::user()->role === 'user')
                            <h3 class="card-title mb-4">Pesan Mobil</h3>
                            <form action="{{ route('rentals.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="car_id" class="form-label">Pilih Mobil</label>
                                    <select id="car_id" name="car_id" class="form-select">
                                        <option value="">-- Pilih Mobil --</option>
                                        @foreach ($availableCars as $car)
                                            <option value="{{ $car->id }}">{{ $car->brand }} - {{ $car->model }}
                                                ({{ $car->license_plate }})</option>
                                        @endforeach
                                    </select>
                                    @error('car_id')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control">
                                    @error('start_date')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Tanggal Selesai</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control">
                                    @error('end_date')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Pesan Mobil</button>
                            </form>
                        @endif

                        <h3 class="card-title mt-4 mb-4">Mobil Tersedia</h3>
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Nomor Plat</th>
                                    <th>Tarif Sewa/Hari</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($availableCars as $car)
                                    <tr>
                                        <td>{{ $car->brand }}</td>
                                        <td>{{ $car->model }}</td>
                                        <td>{{ $car->license_plate }}</td>
                                        <td>{{ $car->rental_rate_per_day }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <h3 class="card-title mt-4 mb-4">Daftar Penyewaan Aktif</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Pengguna</th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Nomor Plat</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Total Biaya</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rentals as $rental)
                                        <tr>
                                            <td>{{ $rental->user->name }}</td>
                                            <td>
                                                @if ($rental->car)
                                                    {{ $rental->car->brand }}
                                                @else
                                                    Mobil tidak tersedia
                                                @endif
                                            </td>
                                            <td>
                                                @if ($rental->car)
                                                    {{ $rental->car->model }}
                                                @else
                                                    Mobil tidak tersedia
                                                @endif
                                            </td>
                                            <td>
                                                @if ($rental->car)
                                                    {{ $rental->car->license_plate }}
                                                @else
                                                    Mobil tidak tersedia
                                                @endif
                                            </td>
                                            <td>{{ $rental->start_date }}</td>
                                            <td>{{ $rental->end_date }}</td>
                                            <td>{{ $rental->total_price }}</td>
                                            <td>
                                                @if (is_null($rental->returned_at))
                                                    <form action="{{ route('rentals.return') }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @if (Auth::user()->role === 'user')
                                                            <input type="text" name="license_plate"
                                                                placeholder="License Plat" class="form-control">
                                                        @endif
                                                        <button type="submit"
                                                            class="btn btn-danger mt-2">Kembalikan</button>
                                                    </form>
                                                @else
                                                    <span class="text-success">Dikembalikan</span>
                                                @endif
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
@endsection
