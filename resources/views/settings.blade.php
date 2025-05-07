@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 text-white">
    <h1 class="text-3xl font-bold mb-6">Settings</h1>

    <p class="text-gray-300 mb-6">Here you’ll be able to customize your experience, like background and avatar color.</p>

    {{-- Flash success message after saving --}}
    @if(session('success'))
        <div class="bg-green-600 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('user-preference.store') }}" method="POST" class="space-y-4">
        @csrf

        <h2 class="text-xl font-semibold mb-2">Choose Dashboard Background Color</h2>

        {{-- Color options rendered from array --}}
        <div class="flex space-x-4" id="colorOptions">
            @php
                $colors = ['#1e2138', '#292f4c', '#181b34', '#2d3748', '#4a5568'];
                $current = auth()->user()->preference->background_color ?? '';
            @endphp

            @foreach ($colors as $color)
    <label class="cursor-pointer relative w-12 h-12 rounded-full border-4 transition-all duration-200"
           data-color="{{ $color }}">
        <input type="radio"
               name="background_color"
               value="{{ $color }}"
               class="absolute inset-0 opacity-0 cursor-pointer"
               {{ $current === $color ? 'checked' : '' }}>
        <div class="w-full h-full rounded-full" style="background-color: {{ $color }}"></div>
    </label>
@endforeach
        </div>

        {{-- Save button --}}
<button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded mt-4">
    Save Preferences
</button>
</form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log("Script loaded");

        fetch('/user-preference/get')
            .then(response => response.json())
            .then(data => {
                console.log("Fetched preference:", data);

                if (data.background_color) {
                    document.body.style.backgroundColor = data.background_color;
                }
            })
            .catch(error => {
                console.error('Error fetching background preference:', error);
            });

        // highlighto izvēlēto krāsu
        const options = document.querySelectorAll('#colorOptions label');

        options.forEach(label => {
            const input = label.querySelector('input');

            input.addEventListener('change', () => {
                options.forEach(lbl => lbl.classList.remove('border-purple-500'));
                if (input.checked) {
                    label.classList.add('border-purple-500');
                }
            });

            // ja ir izvēlēta krāsa, pievieno border
            if (input.checked) {
                label.classList.add('border-purple-500');
            }
        });
    });
</script>


@endsection
