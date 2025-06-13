<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Reset dan Base Styles */
        /* Reset dan Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f5dc; /* Warna krem seperti di foto */
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

/* Container Form */
.form-container {
    background: white;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    border: 1px solid #e0e0e0;
}

/* Header */
h2 {
    text-align: center;
    color: #8B4513; /* Warna coklat seperti di foto */
    margin-bottom: 30px;
    font-size: 1.8em;
    font-weight: 600;
}

/* Error Messages */
.error-messages {
    background-color: #fee;
    border: 1px solid #fcc;
    color: #c66;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.error-messages ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.error-messages li {
    margin-bottom: 5px;
    font-size: 14px;
}

/* Form Labels */
label {
    display: block;
    margin-bottom: 8px;
    margin-top: 15px;
    color: #666;
    font-weight: 500;
    font-size: 14px;
}

/* Form Inputs */
input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.3s ease;
    background-color: #fff;
    outline: none;
    margin-bottom: 10px;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus {
    border-color: #8B4513;
    box-shadow: 0 0 0 2px rgba(139, 69, 19, 0.1);
}

input[type="text"]:hover,
input[type="email"]:hover,
input[type="password"]:hover {
    border-color: #8B4513;
}

/* Button */
button {
    width: 100%;
    padding: 15px;
    background-color: #8B4513; /* Warna coklat seperti di foto */
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 20px;
}

button:hover {
    background-color: #A0522D;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
}

button:active {
    transform: translateY(0);
}

/* Responsive Design */
@media (max-width: 480px) {
    .form-container {
        padding: 30px 20px;
        margin: 10px;
    }
    
    h2 {
        font-size: 1.5em;
    }
}

/* Login Link */
.login-link {
    text-align: center;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.login-link p {
    color: #666;
    font-size: 14px;
    margin-bottom: 8px;
}

.login-link a {
    color: #8B4513;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.login-link a:hover {
    color: #A0522D;
    text-decoration: underline;
}

/* Animation */
.form-container {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
    </style>
</head>
<body>
<div class="form-container">
    <h2>Register</h2>
    
    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>

        <button type="submit">Register</button>
    </form>
    
    <!-- Text untuk mengarahkan ke halaman login -->
    <div class="login-link">
        <p>Already have an account?</p>
        <a href="{{ route('login') }}">Login here</a>
    </div>
</div>
</body>
</html>