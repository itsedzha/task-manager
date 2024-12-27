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
                display: flex;
                height: 100vh;
                margin: 0;
                font-family: 'Figtree', sans-serif;
                background-color: #181b34;
            }

            .left-section {
                flex: 1;
                background: url('/imagees/background.png') no-repeat center center / cover;
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
                color: white;
                padding: 2rem;
            }

            .left-section h1 {
                font-size: 2.5rem;
                font-weight: bold;
            }

            .left-section p {
                margin-top: 1rem;
                font-size: 1.2rem;
            }

            .overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.6);
                z-index: 1;
            }

            .content {
                position: relative;
                z-index: 2;
                text-align: center;
            }

            .right-section {
                flex: 1;
                background-color: #1e2138;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .form-container {
                width: 100%;
                max-width: 400px;
                background-color: #292f4c;
                padding: 2rem;
                border-radius: 1rem;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
            }

            .form-container h2 {
                text-align: center;
                margin-bottom: 1.5rem;
                font-size: 1.8rem;
                font-weight: bold;
                color: white;
            }

            label {
                display: block;
                margin-bottom: 0.5rem;
                color: #A5B4FC;
            }

            input {
                width: 100%;
                padding: 1rem;
                border: none;
                border-radius: 0.75rem;
                background-color: #1f2436;
                color: #E5E7EB;
                margin-bottom: 1.5rem;
                font-size: 1rem;
                font-weight: 500;
            }

            input::placeholder {
                color: #64748b;
            }

            button {
                width: 100%;
                padding: 1rem;
                background-color: #FF4D67;
                color: white;
                font-size: 1rem;
                font-weight: bold;
                border: none;
                border-radius: 0.75rem;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            button:hover {
                background-color: #e33e58;
            }

            .text-sm {
                text-align: center;
                margin-top: 1rem;
                color: #A5B4FC;
            }

            .text-sm a {
                color: #FF4D67;
                text-decoration: none;
            }

            .text-sm a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="left-section">
            <div class="overlay"></div>
            <div class="content">
                <h1>Welcome Back to Task Manager</h1>
                <p>Organize your tasks and stay productive!</p>
            </div>
        </div>
        <div class="right-section">
            <div class="form-container">
                <h2>Login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" placeholder="Enter your email" required autofocus />

                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="Enter your password" required />

                    <button type="submit">Log In</button>

                    <p class="text-sm">
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    </p>
                </form>
            </div>
        </div>
    </body>
</html>
