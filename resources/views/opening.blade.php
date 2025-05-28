<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>

    <link rel="stylesheet" href="fonts.css">
    <link rel="stylesheet" href="opening.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: black;
        }

        .welcome-container {
            text-align: center;
            padding: 2rem;
            border-radius: 10px;
        }

        .navbar-brand {
            font-size: 50px;
            color: rgb(238, 181, 0);
        }

        h1 {
            color: white;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="welcome-container">
            <a class="navbar-brand fontMonsseratExtraBold" href="#mainSection">Vibe</a>
            <h1 class="p-3">Ready to Start Your New Adventure?</h1>
            <div class="buttons d-flex flex-column align-items-center">
                <a href="{{ route('register') }}" class="btn btn-outline-warning font-weight-semibold mb-3">Create Account</a>
                <a href="{{ route('login') }}" class="btn btn-outline-warning font-weight-semibold mb-3">Login</a>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
