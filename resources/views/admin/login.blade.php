<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - {{ config('app.name', 'Admin Panel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #56CCF2 0%, #2F80ED 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            max-width: 450px;
            width: 100%;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            padding: 3rem 2.5rem;
            border: none;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header .logo {
            background: linear-gradient(135deg, #56CCF2 0%, #2F80ED 100%);
            color: white;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
            box-shadow: 0 10px 30px rgba(86, 204, 242, 0.3);
        }

        .login-header h2 {
            color: #2d3748;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #718096;
            margin: 0;
        }

        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-floating .form-control {
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            height: calc(3.5rem + 2px);
            padding: 1rem 0.75rem;
            transition: all 0.3s ease;
        }

        .form-floating .form-control:focus {
            border-color: #56CCF2;
            box-shadow: 0 0 0 0.2rem rgba(86, 204, 242, 0.25);
        }

        .form-floating label {
            color: #718096;
            padding: 1rem 0.75rem;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #718096;
            cursor: pointer;
            z-index: 10;
        }

        .password-toggle:hover {
            color: #56CCF2;
        }

        .btn-login {
            background: linear-gradient(135deg, #56CCF2 0%, #2F80ED 100%);
            border: none;
            border-radius: 12px;
            height: 50px;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(86, 204, 242, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(86, 204, 242, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            border-radius: 12px;
            border: none;
            margin-bottom: 1.5rem;
        }

        .admin-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        .admin-link a {
            color: #56CCF2;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .admin-link a:hover {
            color: #2F80ED;
            text-decoration: underline;
        }

        .password-field-container {
            position: relative;
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card login-card">
            <div class="login-header">
                <div class="logo">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h2>Admin Portal</h2>
                <p>Sign in to access your dashboard</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="admin_email" placeholder="Email" required>
                    <label for="admin_email"><i class="fas fa-envelope me-2"></i>Email Address</label>
                </div>

                <div class="form-floating password-field-container">
                    <input type="password" name="password" class="form-control" id="admin_password" placeholder="Password" required>
                    <label for="admin_password"><i class="fas fa-lock me-2"></i>Password</label>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye" id="passwordToggleIcon"></i>
                    </button>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>Sign In
                    </button>
                </div>
            </form>

            <div class="admin-link">
                <p class="mb-0">
                    <i class="fas fa-user-tie me-2"></i>
                    Employee Login? <a href="{{ route('employee.login') }}">Access Employee Panel</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('admin_password');
            const toggleIcon = document.getElementById('passwordToggleIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const card = document.querySelector('.login-card');
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>
