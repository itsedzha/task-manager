<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #181b34;
            font-family: 'Figtree', sans-serif;
            background-size: cover;
            background-repeat: no-repeat;
            transition: background-image 0.5s ease-in-out;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .greeting {
            text-align: center;
            color: #ffffff;
            margin-bottom: 2rem;
        }

        .greeting h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .card {
            background-color: #292f4c;
            flex: 1;
            margin: 0 1rem;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
            color: #ffffff;
            text-align: center;
        }

        .card h2 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card p {
            font-size: 1.2rem;
            margin-top: 0.5rem;
        }

        .tasks-section {
            background-color: #1e2138;
            padding: 2rem;
            border-radius: 1rem;
            color: #ffffff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
        }

        .tasks-section h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 1rem;
            border-bottom: 1px solid #3a3d58;
            text-align: left;
        }

        table th {
            color: #a5b4fc;
        }

        table tr:hover {
            background-color: #292f4c;
        }

        .bg-options-container {
            margin: 2rem 0;
            text-align: center;
        }

        .bg-option {
            padding: 0.5rem 1rem;
            background-color: #292f4c;
            color: white;
            border: none;
            border-radius: 0.5rem;
            margin: 0 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .bg-option:hover {
            background-color: #3b425c;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="greeting">
            <h1>Welcome, {{ auth()->user()->name }}!</h1>
            <p>Here's an overview of your tasks.</p>
        </div>

        <div class="stats">
            <div class="card">
                <h2>Total Tasks</h2>
                <p>{{ $totalTasks }}</p>
            </div>
            <div class="card">
                <h2>Completed Tasks</h2>
                <p>{{ $completedTasks }}</p>
            </div>
            <div class="card">
                <h2>Progress</h2>
                <p>{{ $progress }}%</p>
            </div>
        </div>

        <div class="bg-options-container">
            <button class="bg-option" data-image="backgrounds/backgroundimage2.jpeg">Background 1</button>
            <button class="bg-option" data-image="backgrounds/backgroundimage3.jpg">Background 2</button>
            <button class="bg-option" data-image="backgrounds/backgroundimage4.jpeg">Background 3</button>
        </div>

        <div class="tasks-section">
            <h2>Your Tasks</h2>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Deadline</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ ucfirst($task->priority) }}</td>
                            <td>{{ $task->completed ? 'Completed' : 'Pending' }}</td>
                            <td>{{ $task->deadline }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.bg-option');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const imagePath = this.getAttribute('data-image');

                // Api save preference
                fetch('/user-preference/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ background_image: imagePath })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to save background preference.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.message) {
                        // dinamiskais update backgrounda bildei
                        document.body.style.backgroundImage = `url(/${imagePath})`;
                        console.log('Background updated to:', imagePath);
                    }
                })
                .catch(error => {
                    console.error('Error updating background:', error);
                });
            });
        });

        // user preference on page load
        fetch('/user-preference/get')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch user preference.');
                }
                return response.json();
            })
            .then(data => {
                if (data.background_image) {
                    document.body.style.backgroundImage = `url(/${data.background_image})`;
                    console.log('Background applied from preference:', data.background_image);
                }
            })
            .catch(error => {
                console.error('Error fetching background preference:', error);
            });
    });
</script>

</body>
</html>
