<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card shadow-lg" style="width: 350px;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Login</h3>
                <p class="text-center text-muted mb-4">Please login to access the dashboard</p>
                
          
                <div class="d-grid">
                    <a href="{{ url('/login') }}" class="btn btn-primary btn-lg">Go to Login</a>
                    <p>For admin:</p>
                    <p>email:admin@gmail.com</p>
                    <p>password:password123</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

