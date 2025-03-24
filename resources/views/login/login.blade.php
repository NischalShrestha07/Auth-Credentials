<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" href="https://loktaapp.com/images/favicon_20250123_112559.png">
    <link rel="stylesheet" href="{{ asset('assets/login/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/main/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Font Awesome -->
    <style>
        body {
            /* background: linear-gradient(120deg, #4a90e2, #8e44ad); */
            /* Softer gradient */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Roboto', sans-serif;
            /* Clean, professional font */
        }

        .login-container {
            background: #fff;
            /* Explicitly white as requested */
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            /* Softer shadow */
            padding: 2rem;
            width: 100%;
            max-width: 420px;
            /* Slightly narrower for elegance */
            position: relative;
            overflow: hidden;
            animation: slideUp 0.4s ease-out;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #4a90e2, #8e44ad);
            /* Header accent */
        }

        .login-container h2 {
            font-weight: 600;
            color: #2c3e50;
            /* Darker blue-gray for contrast */
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .form-label {
            font-weight: 500;
            color: #34495e;
            /* Softer dark color */
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }

        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #dfe6e9;
            border-right: none;
            border-radius: 8px 0 0 8px;
            color: #7f8c8d;
        }

        .form-control {
            border: 2px solid #dfe6e9;
            border-radius: 0 8px 8px 0;
            padding: 10px 12px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 6px rgba(74, 144, 226, 0.3);
            outline: none;
        }

        .btn-primary {
            background: #4a90e2;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background: #357abd;
            /* Darker shade on hover */
            transform: translateY(-2px);
        }

        .text-danger {
            font-size: 0.8rem;
            margin-top: 4px;
            display: block;
            color: #e74c3c;
        }

        .forgot-password {
            display: block;
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #7f8c8d;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #4a90e2;
        }

        /* Alert Positioning */
        .alert-custom {
            position: fixed;
            top: 15px;
            right: 15px;
            z-index: 1050;
            max-width: 320px;
        }

        /* Animation */
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-container {
                margin: 15px;
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    @session('error')
    <x-alert type="danger" message="{{ session('error') }}" title="Error" id="alert-error-{{ uniqid() }}" />
    @endsession
    @session('success')
    <x-alert type="success" message="{{ session('success') }}" title="Success" id="alert-success-{{ uniqid() }}" />
    @endsession

    <div class="login-container">
        <h2>Login to Your Account</h2>
        <form method="POST" action="{{ route('handelLogin') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input name="email" value="{{ old('email') }}" type="email" id="email" class="form-control"
                        placeholder="Your email" required>
                </div>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input name="password" type="password" id="password" class="form-control"
                        placeholder="Your password" required>
                </div>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>