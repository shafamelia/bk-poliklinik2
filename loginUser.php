<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Tambahan CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #0C4C93;
        }

        .login-container {
            display: flex;
            max-width: 1200px;
            background-color: #fff;
            color: #000;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .left-container {
            flex: 1;
            overflow: hidden;
        }

        .left-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .right-container {
            flex: 1;
            padding: 40px;
        }

        .login-form {
            max-width: 400px;
            margin: 0 auto;
        }

        .login-form h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-form p {
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .login-form label {
            display: block;
            margin-bottom: 8px;
            color: #000;
            font-size: 14px;
        }

        .login-form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: none;
            border-bottom: 1px solid #ccc;
            outline: none;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #0C4C93;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
        }

        .register-link a {
            color: #3498db;
            text-decoration: none;
        }

        .text-primary {
            color: #3498db !important;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="left-container">
            <img src="assets/images/logopalang.png" alt="Login Image">
        </div>
        <div class="right-container">
            <div class="login-form">
                <h4 class="text-center">Login</h4>
                <p class="login-box-msg text-center">Lakukan login <span class="text-primary">Pasien</span> untuk mendapatkan layanan</p>
                <form action="pages/loginUser/checkLoginUser.php" method="post">
                    <label for="username">Username :</label>
                    <input type="text" class="form-control" name="username" required>

                    <label for="password">Password :</label>
                    <input type="password" class="form-control" name="password" required>

                    <button type="submit" class="btn btn-block btn-success">
                        Masuk
                    </button>
                </form>
            </div>
            <div class="text-center mt-3">
                <p>Belum punya akun?</p>
                <a href="register.php" class="text-primary">Registrasi disini</a>
            </div>
        </div>
    </div>
</body>

</html>
