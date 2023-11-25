<!DOCTYPE html>
<html>

<head>
    <title>Registrasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
        <h2>Registrasi</h2>
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

        <button type="submit" class="btn">Register</button>
        <a href="login.php">Login</a>
    </div>
</body>

</html>