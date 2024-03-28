@extends('layouts.app')

@section('content')
    <div class="max-w-md p-6 mx-auto">
        <h1 class="mb-4 text-2xl font-semibold text-red-600">User Preferences</h1>
        <form action="{{ route('preferences.save') }}" method="POST">
            @csrf <!-- CSRF token -->

            <!-- News Categories -->
            <div class="mb-4">
                <label class="block mb-2 font-medium text-white">Select your preferred news categories:</label>
                <div class="space-y-2">
                    <label class="inline-flex items-center text-red-600">
                        <input type="checkbox" name="categories[]" value="technology" class="mr-2">
                        Technology
                    </label>
                    <label class="inline-flex items-center text-red-600">
                        <input type="checkbox" name="categories[]" value="sports" class="mr-2">
                        Sports
                    </label>
                    <label class="inline-flex items-center text-red-600">
                        <input type="checkbox" name="categories[]" value="business" class="mr-2">
                        Business
                    </label>
                    <!-- Add more categories as needed -->
                </div>
            </div>

            <!-- Save Button -->
            <button type="submit" class="px-4 py-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-600">
                Save Preferences
            </button>
        </form>
    </div>
@endsection
