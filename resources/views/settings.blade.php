@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 text-white">
    <h1 class="text-3xl font-bold mb-6">Settings</h1>

    <p class="text-gray-300 mb-6">Here you’ll be able to customize your experience, like background and avatar color.</p>

    <form action="{{ route('user-preference.store') }}" method="POST" class="space-y-4">
        @csrf
        <h2 class="text-xl font-semibold mb-2">Choose Dashboard Background Color</h2>

        @php
            $colors = ['#181b34', '#1e2138', '#292f4c', '#3b425c', '#4a5568'];
            $current = auth()->user()->preference->background_image ?? '#181b34';
        @endphp

        <div class="flex gap-4">
            @foreach ($colors as $color)
                <label class="w-12 h-12 rounded-full border-4 cursor-pointer transition-all duration-200"
                       style="background-color: {{ $color }}; border-color: {{ $current === $color ? '#805ad5' : 'transparent' }};">
                    <input type="radio" name="background_image" value="{{ $color }}" class="sr-only">
                </label>
            @endforeach
        </div>

        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded mt-4">
            Save Preferences
        </button>
    </form>
</div>
@endsection
