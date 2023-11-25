<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $username = $_POST['uname'];
    $password = $_POST['psw'];
    $repeatPassword = $_POST['psw_repeat'];
    $role = $_POST['role']; // Ambil peran dari form

    // Lakukan validasi tambahan jika diperlukan, seperti kecocokan kata sandi, validasi panjang kata sandi, dll.

    // Pastikan kata sandi sama dengan pengulangan kata sandi
    if ($password !== $repeatPassword) {
        echo "Kata sandi tidak cocok. Silakan coba lagi.";
    } else {
        // Query untuk mengecek apakah username sudah ada di database
        $checkUserQuery = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($checkUserQuery);

        // Setelah proses registrasi berhasil
        if ($conn->query($insertUserQuery) === TRUE) {
            echo "Registrasi berhasil!";
            // Redirect berdasarkan peran (role)
            if ($role === 'admin') {
                header("Location: ../admin");
                exit();
            } else if ($role === 'buyer') {
                header("Location: ../");
                exit();
            }
        } else {
            echo "Error: " . $insertUserQuery . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-decoration: none;
        }

        .container {
            width: 300px;
            padding: 16px;
            background-color: white;
            margin: 0 auto;
            margin-top: 100px;
            border: 1px solid black;
            border-radius: 4px;
        }

        input[type=text],
        input[type=password] {
            width: 270px;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:focus,
        input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .btn:hover {
            opacity: 1;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <button type="submit" class="btn">Login</button>
        <a href="regis.php">Registrasi</a>
    </div>
</body>

</html>