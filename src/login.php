<?php
include 'config.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $admin_id = "admin";
     $admin_password = "password";

     $input_username = $_POST['username'];
     $input_password = $_POST['password'];

     // cek username password
     if ($input_username === $admin_id && $input_password === $admin_password) {
          $_SESSION['admin'] = $admin_id;
          header("Location: index.php");
          exit();
     } else {
          // cek jenis user sebagai user atau pegawai
          $encryptedPassword = md5($input_password);

          // Search in mst_user table
          $sql_user = "SELECT * FROM mst_user WHERE username='$input_username' AND password = '$encryptedPassword'";
          $query_user = mysqli_query($conn, $sql_user);
          $user = mysqli_fetch_assoc($query_user);
          $user_count = mysqli_num_rows($query_user);

          if ($user_count > 0) {
               $_SESSION['user'] = $user;
               header("Location: index.php");
               exit();
          } else {
               // Alert if credentials not found in both tables
               echo '<script language="javascript"> alert("Nomor induk atau password salah!");</script>';
          }
     }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login - SMKN 1 Jogjakarta</title>
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
               flex-direction: column;
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

          .check {
               background-color: #0ad406;
               padding: 10px 30px;
               border-radius: 8px;
               box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
               max-width: 400px;
               width: 100%;
               text-align: center;
               display: flex;
               align-items: center;
               margin: 20px 0;
               color: #ffffff;
               font-weight: bold;
          }
     </style>
</head>

<body>

     <div class="login-container">
          <?php
          if (isset($_GET['status'])) {
               echo "<div class='check'><span>Register Berhasil, Silahkan Login</span></div>";
          }
          ?>
          <form action="#" class="login-form" method="POST">
               <h2>Login to Perpustakaan BacaBersama</h2>
               <label for="username">Username:</label>
               <input type="text" id="username" name="username" placeholder="Enter your username" required>

               <label for="password">Password:</label>
               <input type="password" id="password" name="password" placeholder="Enter your password" required>

               <button type="submit">Login</button>

               <span>Belum memiliki akun? Daftar <a href="register.php">disini</a></span>
          </form>
     </div>

</body>

</html>