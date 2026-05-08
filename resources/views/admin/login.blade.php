<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Barbershop Premium</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="login-page">

    <div class="login-container-card">
        <div class="login-header">
            <i class="fa-solid fa-scissors login-icon"></i>
            <h1>ADMIN PANEL</h1>
            <p>Sistem Manajemen Barbershop</p>
        </div>

        @if(session('error'))
            <div class="alert" style="background: rgba(220, 38, 38, 0.2); border: 1px solid #dc2626; color: #fca5a5;">
                <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert" style="background: rgba(220, 38, 38, 0.2); border: 1px solid #dc2626; color: #fca5a5;">
                <ul style="list-style: none; margin: 0; padding: 0;">
                    @foreach ($errors->all() as $error)
                        <li><i class="fa-solid fa-circle-exclamation"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf <div class="login-input-group">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" class="login-input" placeholder="Email Address" 
                        value="{{ old('email') }}" required autofocus>
                </div>

                <div class="login-input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" class="login-input" placeholder="Password" required>
                </div>

            <button type="submit" class="btn-login-premium">
                MASUK <i class="fa-solid fa-arrow-right-to-bracket" style="margin-left: 5px;"></i>
            </button>
        </form>

        <p style="margin-top: 25px; font-size: 0.8rem; color: #64748b;">
            &copy; {{ date('Y') }} Barbershop Admin.
        </p>
    </div>

</body>
</html>