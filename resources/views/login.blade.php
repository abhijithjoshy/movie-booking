<!DOCTYPE html>
<html>

<head>
    <title>Login-Show My Ticket</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f7fafc;
        }

        .button-container {
            text-align: center;
        }

        .button-container a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #4a90e2;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .button-container a:hover {
            background-color: #3576c6;
        }
    </style>
</head>

<body>
    <div class="button-container">
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>

</html>
