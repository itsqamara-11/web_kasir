<?php
// session_start();
if (!empty($_SESSION['username_cozcafe'])) {
    header('location:home');
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="CozCafe Team">
    <meta name="generator" content="Hugo 0.104.2">
    <title>CozCafe | Aplikasi Pemesanan Makanan dan Minuman Cafe</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #686D76;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }

        .form-signin {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(15px);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .form-signin h1 {
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .form-signin .form-floating {
            width: 100%;
        }

        .form-signin .form-floating label {
            color: #ddd;
        }

        .form-signin .form-control {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: none;
        }

        .form-signin .form-control:focus {
            background-color: rgba(255, 255, 255, 0.3);
            box-shadow: none;
            border-color: #6e8efb;
        }

        .form-signin button {
            background-color: #6e8efb;
            border: none;
            transition: background-color 0.3s ease;
        }

        .form-signin button:hover {
            background-color: #686D76;
        }

        .form-signin .checkbox label {
            font-weight: 400;
        }

        .form-signin img {
            filter: drop-shadow(2px 4px 6px black);
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

    <main class="form-signin">
        <form class="needs-validation" novalidate action="proses/proses_login.php" method="POST">
            <img src="assets/img/logo.png" alt="CozCafe Logo" width="82" height="67">
            <h1 class="h3 mb-3 fw-normal">Please Login</h1>

            <div class="form-floating mb-3">
                <input name="username" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Email address</label>
                <div class="invalid-feedback">
                    Masukkan email yang valid.
                </div>
            </div>
            <div class="form-floating mb-3">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
                <div class="invalid-feedback">
                    Masukkan password.
                </div>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit_validate" value="abc">Login</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2021 - <?php echo date("Y") ?></p>
        </form>
    </main>

    <script>
        (() => {
            'use strict'

            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>

</html>