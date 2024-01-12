<?php
include 'config.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

     $input_username = $_POST['username'];
     $input_password = $_POST['password'];
     $input_name = $_POST['name'];

     $encryptedPassword = md5($input_password);

     $sql_user = "INSERT INTO mst_user (username, name, password) VALUE ('$input_username', '$input_name', '$encryptedPassword')";
     $query_user = mysqli_query($conn, $sql_user);

     // apakah query berhasil?
     if ($query_user) {
          // kalau berhasil alihkan ke halaman login dengan status=success
          header('Location: login.php?status=success');
     } else {
          // kalau gagal alihkan ke halaman login dengan status=gagal
          header('Location: register.php?status=failed');
     }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Sign Up - Perpustakaan BacaBersama</title>
     <style>
          /* Reset some default styles */
          body,
          html {
               margin: 0;
               padding: 0;
          }

          body {
               font-family: 'Arial', sans-serif;
               background-color: #f0f0f0;
          }

          .login-container {
               display: flex;
               justify-content: center;
               align-items: center;
               height: 100vh;
          }

          .login-form {
               display: flex;
               flex-direction: column;
               background-color: #ffffff;
               padding: 30px;
               border-radius: 8px;
               box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
               max-width: 400px;
               width: 100%;
               text-align: center;
          }

          h2 {
               margin-bottom: 20px;
               color: #333;
          }

          label {
               display: block;
               margin-bottom: 8px;
               color: #555;
          }

          input {
               width: 100%;
               padding: 10px;
               margin-bottom: 20px;
               box-sizing: border-box;
               border: 1px solid #ccc;
               border-radius: 4px;
          }

          button {
               background-color: #3498db;
               color: #fff;
               padding: 12px 20px;
               border: none;
               border-radius: 4px;
               cursor: pointer;
               font-size: 16px;
               margin-bottom: 10px;
          }

          button:hover {
               background-color: #2980b9;
          }
     </style>
</head>

<body>

     <div class="login-container">
          <form action="#" class="login-form" method="POST">
               <h2>Sign Up to Perpustakaan BacaBersama</h2>
               <label for="username">Username:</label>
               <input type="text" id="username" name="username" placeholder="Enter your username" required>

               <label for="password">Password:</label>
               <input type="password" id="password" name="password" placeholder="Enter your password" required>

               <label for="name">Name:</label>
               <input type="text" id="name" name="name" placeholder="Enter your name" required>

               <button type="submit">Sign Up</button>

               <span>Sudah memiliki akun? Login <a href="login.php">disini</a></span>
          </form>
     </div>

</body>

</html>