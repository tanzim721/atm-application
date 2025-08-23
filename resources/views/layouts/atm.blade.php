<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ATM Banking System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
        }
        .atm-container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            max-width: 500px;
            margin: 2rem auto;
            overflow: hidden;
        }
        .atm-header {
            background: #2c3e50;
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        .atm-body {
            padding: 2rem;
        }
        .btn-atm {
            background: #3498db;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: bold;
            width: 100%;
            margin: 8px 0;
        }
        .btn-atm:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }
        .keypad {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin: 20px 0;
        }
        .keypad button {
            aspect-ratio: 1;
            font-size: 18px;
            font-weight: bold;
            border: 2px solid #ddd;
            border-radius: 8px;
            background: #f8f9fa;
        }
        .keypad button:hover {
            background: #e9ecef;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="atm-container">
            <div class="atm-header">
                <h3><i class="fas fa-university"></i> @yield('header', 'ATM Banking System')</h3>
            </div>
            <div class="atm-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
    @yield('scripts')
</body>
</html>