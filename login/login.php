
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <?php
        session_start();

        if (isset($_SESSION['login_error'])) {
            echo '<p class="error-message">' . $_SESSION['login_error'] . '</p>';
            unset($_SESSION['login_error']);
        }
        ?>
        <form action="login-proses.php" method="POST">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <button type="submit" class="btn">Login</button>
        </form>
        <!-- Akhir form login -->

        <!-- Tambahkan link ke halaman registrasi -->
        <a href="regis.php">Registrasi</a>
    </div>
</body>

</html>