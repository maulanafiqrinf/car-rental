<x-app-layout>
    <h1>Rent a Car</h1>

    <form action="{{ route('rentals.store') }}" method="POST">
        @csrf

        <div>
            <label for="car_id">Select Car:</label>
            <select id="car_id" name="car_id" required>
                @foreach($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->brand }} - {{ $car->model }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>
        </div>

        <div>
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>
        </div>

        <button type="submit">Rent Car</button>
    </form>
</x-app-layout>
