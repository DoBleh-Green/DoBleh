<!DOCTYPE html>
<html>

<head>
    <title>Registrasi</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="regis-proses.php" method="POST" class="container">
        <h2>Registrasi</h2>
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <label for="password-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="password-repeat" required>

        <button type="submit" class="btn">Register</button>
        <a href="login.php">Login</a>
</form>
</body>

</html>
