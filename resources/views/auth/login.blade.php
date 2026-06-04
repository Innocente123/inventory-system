<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventory System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

    <div class="min-vh-100 d-flex align-items-center justify-content-center px-3">
        <div class="login-card" style="max-width: 420px; width: 100%;">
            {{-- Logo / Brand --}}
            <div class="text-center mb-4">
                <div class="login-icon">
                    <i class="fas fa-cubes"></i>
                </div>
                <h3 class="text-white fw-bold mt-3 mb-1">Inventory System</h3>
                <p class="text-secondary mb-0">Sign in to manage your inventory</p>
            </div>

            {{-- Login Form --}}
            <div class="login-form-card">
                {{-- Global errors (login failure) --}}
                @if($errors->has('login'))
                    <div class="alert alert-danger">
                        {{ $errors->first('login') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Username --}}
                    <div class="mb-3">
                        <label for="username" class="form-label text-white">
                            <i class="fas fa-user me-1"></i>Username
                        </label>
                        <input id="username" type="text"
                               class="form-control auth-input @error('username') is-invalid @enderror"
                               name="username" value="{{ old('username') }}"
                               required autocomplete="username" autofocus
                               placeholder="your username">
                        @error('username')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label text-white">
                            <i class="fas fa-lock me-1"></i>Password
                        </label>
                        <input id="password" type="password"
                               class="form-control auth-input @error('password') is-invalid @enderror"
                               name="password" required autocomplete="current-password"
                               placeholder="Enter your password">
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label text-secondary" for="remember">
                                Remember me
                            </label>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-login w-100">
                        <i class="fas fa-arrow-right-to-bracket me-2"></i>Sign In
                    </button>

                    <div class="text-center mt-3">
                        <p class="text-secondary mb-0">
                            Don’t have an account? <a href="{{ route('register') }}" class="text-white text-decoration-underline">Register</a>
                        </p>
                    </div>
                </form>
            </div>

            {{-- Footer --}}
            <p class="text-center text-secondary mt-4 mb-0" style="font-size: 0.85rem;">
                &copy; {{ date('Y') }} Inventory System. All rights reserved.
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
