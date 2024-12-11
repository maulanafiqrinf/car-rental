<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 leading-tight">
            {{ __('Return Car') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('rentals.return') }}" method="POST">
                        @csrf
                        <label for="license_plate">License Plate:</label>
                        <input type="text" id="license_plate" name="license_plate" required>
                
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Return Car</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
