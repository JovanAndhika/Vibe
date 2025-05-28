<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>

    <!-- Styles -->
    <link rel="stylesheet" href="fonts.css">
    <link rel="stylesheet" href="opening.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: white;
            transition: background-color 2s ease;
        }

        .black-background {
            background-color: black;
        }

        h2 {
            color: black;
            transition: color 2s ease;
        }

        .white-text {
            color: white;
        }

        .logo a {
            font-size: 50px;
            color: rgb(238, 181, 0);
        }

        h2.title {
            font-size: 40px;
        }

        .form-container {
            width: 100%;
            max-width: 500px;
            padding: 2rem;
            border-radius: 10px;
            background-color: #f8f9fa;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-container">
            <!-- Logo -->
            <div class="logo mb-4 text-center">
                <a class="navbar-brand fontMonsseratExtraBold" href="#mainSection">Vibe</a>
            </div>

            <!-- Flash Messages -->
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif

            <!-- Title -->
            <h2 class="title p-3 text-center">Your Music Is Waiting For You!</h2>

            <!-- Form -->
            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email (admin@gmail.com / user@gmail.com)</label>
                    <div class="input-group">
                        <button class="btn btn-outline-warning change" type="button">Email</button>
                        <input type="text" class="form-control" placeholder="Email" name="email" required>
                    </div>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">Password (12345678)</label>
                    <div class="input-group">
                        <button class="btn btn-outline-warning change" type="button">Password</button>
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="d-flex flex-column">
                    <button type="submit" class="btn btn-outline-warning fontMonsseratSemiBold my-2">Log In</button>
                    <a href="{{ route('home') }}" class="btn btn-outline-warning font-weight-semibold my-2">Back</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(function () {
                document.body.classList.add("black-background");
                document.querySelector("h2").classList.add("white-text");
            }, 5000);

            document.querySelectorAll(".change").forEach(function (button) {
                button.addEventListener("click", function () {
                    document.body.classList.toggle("black-background");
                    document.querySelector("h2").classList.toggle("white-text");
                });
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></sc
