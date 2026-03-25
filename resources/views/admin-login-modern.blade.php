<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | ആരവം</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #0a0a0a;
            overflow: hidden;
        }

        .login-container {
            position: relative;
            width: 900px;
            height: 550px;
            background: rgba(15, 15, 25, 0.95);
            border: 2px solid #00f3ff;
            border-radius: 20px;
            box-shadow: 0 0 40px rgba(0, 243, 255, 0.3);
            display: flex;
            overflow: hidden;
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Left Side - Login Form */
        .login-form {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(10, 10, 20, 0.8);
        }

        .login-form h2 {
            font-size: 32px;
            color: #fff;
            margin-bottom: 40px;
            font-weight: 600;
        }

        .input-group {
            position: relative;
            margin-bottom: 30px;
        }

        .input-group input {
            width: 100%;
            padding: 15px 45px 15px 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: #fff;
            font-size: 15px;
            transition: all 0.3s;
        }

        .input-group input:focus {
            outline: none;
            border-color: #00f3ff;
            background: rgba(0, 243, 255, 0.05);
            box-shadow: 0 0 15px rgba(0, 243, 255, 0.2);
        }

        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .input-group i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.5);
            font-size: 18px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .input-group i:hover {
            color: #00f3ff;
        }

        .forgot-password {
            text-align: right;
            margin: -15px 0 25px 0;
        }

        .forgot-password a {
            color: #00f3ff;
            text-decoration: none;
            font-size: 14px;
            transition: opacity 0.3s;
        }

        .forgot-password a:hover {
            opacity: 0.8;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #00f3ff 0%, #00d4e0 100%);
            border: none;
            border-radius: 10px;
            color: #000;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 5px 20px rgba(0, 243, 255, 0.3);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 243, 255, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .signup-link {
            text-align: center;
            margin-top: 25px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
        }

        .signup-link a {
            color: #00f3ff;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        /* Right Side - Welcome Section */
        .welcome-section {
            flex: 1;
            position: relative;
            background: linear-gradient(135deg, #1a1a2e 0%, #2d1b3d 50%, #1a1a2e 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 50px;
            overflow: hidden;
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200%;
            height: 200%;
            background: linear-gradient(135deg, transparent 0%, rgba(0, 243, 255, 0.1) 50%, transparent 100%);
            transform: rotate(-15deg);
            animation: shimmer 8s infinite;
        }

        @keyframes shimmer {
            0%, 100% {
                transform: rotate(-15deg) translateY(0);
            }
            50% {
                transform: rotate(-15deg) translateY(-20px);
            }
        }

        .diagonal-line {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, transparent 48%, #00f3ff 48%, #00f3ff 52%, transparent 52%);
            opacity: 0.3;
            pointer-events: none;
        }

        .welcome-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .welcome-content h1 {
            font-size: 48px;
            color: #fff;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 0 0 20px rgba(0, 243, 255, 0.5);
        }

        .welcome-content .subtitle {
            font-size: 20px;
            color: #00f3ff;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .welcome-content p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 16px;
            line-height: 1.6;
        }

        /* Error Messages */
        .alert-error {
            background: rgba(255, 68, 68, 0.1);
            border: 1px solid rgba(255, 68, 68, 0.3);
            color: #ff4444;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                width: 95%;
                height: auto;
                flex-direction: column;
            }

            .welcome-section {
                padding: 30px;
                min-height: 200px;
            }

            .welcome-content h1 {
                font-size: 32px;
            }

            .login-form {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Side - Login Form -->
        <div class="login-form">
            <h2>Admin Login</h2>
            
            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                
                @if ($errors->any())
                    <div class="alert-error">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class="bx bxs-user"></i>
                </div>

                <div class="input-group">
                    <input type="password" name="password" id="admin-password" placeholder="Password" required>
                    <i class="bx bxs-show toggle-password" onclick="togglePassword('admin-password', this)"></i>
                </div>

                <div class="forgot-password">
                    <a href="{{ route('admin.forgot-password') }}">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn">Login</button>

                <div class="signup-link">
                    New Admin? <a href="{{ route('admin.register') }}">Sign Up</a>
                </div>
            </form>
        </div>

        <!-- Right Side - Welcome Section -->
        <div class="welcome-section">
            <div class="diagonal-line"></div>
            <div class="welcome-content">
                <h1>ADMIN<br>PORTAL</h1>
                <p class="subtitle">ആരവം</p>
                <p>Manage your application<br>securely.</p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('bxs-show');
                icon.classList.add('bxs-hide');
            } else {
                input.type = "password";
                icon.classList.remove('bxs-hide');
                icon.classList.add('bxs-show');
            }
        }
    </script>
</body>
</html>
