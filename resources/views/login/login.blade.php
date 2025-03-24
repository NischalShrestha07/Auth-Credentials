<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" href="https://loktaapp.com/images/favicon_20250123_112559.png">
    <link rel="stylesheet" href="{{ asset('assets/login/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/main/css/style.css') }}">
</head>

<body>
    @session('error')
        <x-alert type="danger" message="{{ session('error') }}" />
    @endsession
    @session('success')
        <x-alert type="success" message="{{ session('success') }}" />
    @endsession
    <div class="body">
        <div class="login-container w-50">
            <h2 class="text-center mb-4">Login</h2>
            <form method="POST" action="{{ route('handelLogin') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input name="email" value="{{ old('email') }}" type="email" id="email" class="form-control" placeholder="Enter your email" required>
                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" id="password" class="form-control" placeholder="Enter your password" required>
                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>

</html>
