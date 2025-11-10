<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="icon" href="{{ asset('assets/image/upam.png') }}" type="image/png" width="64" height="64">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            position: relative;
            overflow: hidden;
        }

        .bg-video {
            position: fixed;
            top: -40px; /* Geser dikit biar bagian bawah ke-crop */
            left: 0;
            width: 100%;
            height: 120%; /* Lebihin dikit biar gak ada ruang kosong */
            object-fit: cover;
            z-index: -1;
            filter: brightness(60%); /* Biar form login keliatan jelas */
        }

        /* === LOGIN CARD === */
        .login-card {
            width: 380px;
            background: rgba(255, 255, 255, 0.15); /* transparan */
            backdrop-filter: blur(15px); /* efek kaca */
            -webkit-backdrop-filter: blur(15px); /* biar support Safari */
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.3); /* garis halus kaca */
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.2);
            padding: 30px;
            color: #fff; /* teks putih biar kontras */
        }            
       .card-header h3 {
            color: #fff;
            font-weight: 600;
        }
        
        .form-label {
            color: #f1f1f1;
            font-weight: 500;
        }
        
        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        
        .btn-primary {
            width: 100%;
            background-color: rgba(0, 123, 255, 0.9);
            border: none;
            font-weight: 600;
        }
        
        .btn-primary:hover {
            background-color: rgba(0, 123, 255, 1);
        }
        .text-center a {
            text-decoration: none;
            font-size: 0.9rem;
            color: #0056b3;
        }

        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Video Background -->
    <video autoplay muted loop class="bg-video">
        <source src="{{ asset('assets/image/bg.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Login Card -->
    <div class="login-card">
        <div class="card-header text-center mb-3">
            <h3>Register</h3>
        </div>

        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @elseif (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        value="{{ old('email') }}" 
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="form-control"
                    required
                >
            </div>

                <button type="submit" class="btn btn-primary mt-4">Daftar</button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}">Sudah punya akun? Masuk di sini</a>
            </div>
        </div>
    </div>
</body>
</html>