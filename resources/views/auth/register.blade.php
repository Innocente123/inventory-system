<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Inventory System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

    <div class="min-vh-100 d-flex align-items-center justify-content-center px-3">
        <div class="login-card" style="max-width: 520px; width: 100%;">
            <div class="text-center mb-4">
                <div class="login-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h3 class="text-white fw-bold mt-3 mb-1">Create Account</h3>
                <p class="text-secondary mb-0">Register to manage inventory and track stock.</p>
            </div>

            <div class="login-form-card">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label text-white">
                            <i class="fas fa-id-card me-1"></i>Full Name
                        </label>
                        <input id="name" type="text"
                               class="form-control auth-input @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}"
                               required autocomplete="name" autofocus
                               placeholder="Your full name">
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label text-white">
                            <i class="fas fa-user me-1"></i>Username
                        </label>
                        <input id="username" type="text"
                               class="form-control auth-input @error('username') is-invalid @enderror"
                               name="username" value="{{ old('username') }}"
                               required autocomplete="username"
                               placeholder="Choose a username">
                        @error('username')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label text-white">
                            <i class="fas fa-envelope me-1"></i>Email Address
                        </label>
                        <input id="email" type="email"
                               class="form-control auth-input @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}"
                               required autocomplete="email"
                               placeholder="you@example.com">
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-white">
                            <i class="fas fa-lock me-1"></i>Password
                        </label>
                        <input id="password" type="password"
                               class="form-control auth-input @error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password"
                               placeholder="Create a password">
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label text-white">
                            <i class="fas fa-lock me-1"></i>Confirm Password
                        </label>
                        <input id="password_confirmation" type="password"
                               class="form-control auth-input"
                               name="password_confirmation" required autocomplete="new-password"
                               placeholder="Repeat your password">
                    </div>

                    <button type="submit" class="btn btn-login w-100">
                        <i class="fas fa-user-plus me-2"></i>Register
                    </button>

                    <div class="text-center mt-3">
                        <p class="text-secondary mb-0">
                            Already have an account? <a href="{{ route('login') }}" class="text-white text-decoration-underline">Sign in</a>
                        </p>
                    </div>
                </form>
            </div>

            <p class="text-center text-secondary mt-4 mb-0" style="font-size: 0.85rem;">
                &copy; {{ date('Y') }} Inventory System. All rights reserved.
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
