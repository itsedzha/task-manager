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
        background-color: {{ $backgroundColor ?? '#181b34' }};
        font-family: 'Figtree', sans-serif;
        background-size: cover;
        background-repeat: no-repeat;
        transition: background-color 0.5s ease-in-out;
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
    </style>
</head>
<body class="flex">
    <x-sidebar />

    <div class="flex-1 ml-64">
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
    </div>
</body>
</html>
