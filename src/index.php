<?php
include 'config.php';

session_start();

$session_login;
// periksa apakah sudah ada session login
if (isset($_SESSION['admin'])) {
     $session_login = "admin";
} elseif (isset($_SESSION['user'])) {
     $session_login = "user";
     $data = $_SESSION[$session_login];
     $nama = $data['name'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Perpustakaan BacaBersama</title>
     <style>
          body {
               margin: 0;
               font-family: 'Arial', sans-serif;
          }

          .navbar {
               background-color: #3498db;
               color: white;
               padding: 15px;
               display: flex;
               justify-content: space-between;
               align-items: center;
          }

          .logo {
               font-size: 1.5em;
          }

          .nav-links {
               list-style: none;
               display: flex;
          }

          .nav-links li {
               margin-right: 20px;
          }

          .nav-links a {
               text-decoration: none;
               color: white;
          }

          .login-btn {
               background-color: #2ecc71;
               color: white;
               padding: 10px 15px;
               border-radius: 5px;
               cursor: pointer;
          }

          .container {
               padding: 20px;
          }

          .footer {
               background-color: #34495e;
               color: white;
               padding: 10px;
               bottom: 0;
               width: 100%;
               text-align: center;
          }

          .school-info {
               font-size: 0.8em;
          }

          /* Add these styles to your existing CSS file */

          .container {
               padding: 20px;
          }

          .hero {
               text-align: center;
               margin-bottom: 30px;
          }

          .hero h1 {
               font-size: 2em;
          }

          .hero p {
               font-size: 1.2em;
               color: #555;
          }

          .hero img {
               max-width: 60%;
               height: auto;
               margin-top: 20px;
          }

          .about,
          .features {
               margin-bottom: 30px;
          }

          .about h2,
          .features h2 {
               font-size: 1.5em;
               margin-bottom: 10px;
          }

          .features ul {
               list-style: none;
               padding: 0;
          }

          .features li {
               margin-bottom: 8px;
          }

          .login-type {
               display: flex;
          }

          .login-type div:first-child {
               display: grid;
               place-content: center;
               padding: 0 20px;
          }
     </style>
</head>

<body>

     <!-- Navbar -->
     <nav class="navbar">
          <div class="logo">Perpustakaan BacaBersama</div>
          <ul class="nav-links">
               <li><a href="index.php">Halaman depan</a></li>
               <li><a href="daftar-buku.php">Daftar Buku</a></li>
               <li><a href="daftar-kesan-pesan.php">Kesan dan Pesan</a></li>
          </ul>
          <div class="login-type">
               <div>
                    <?php
                    if (isset($session_login)) {
                         echo $session_login == "admin" ? "admin" : $nama;
                    }
                    ?>
               </div>
               <div class="login-btn">
                    <?php
                    if (isset($session_login)) {
                         echo '<a href="logout.php">Logout</a>';
                    } else {
                         echo '<a href="login.php">Login</a>';
                    }
                    ?>
               </div>
          </div>

     </nav>

     <!-- Page Content -->
     <div class="container">
          <section class="hero">
               <h1>Selamat Datang di Perpustakaan BacaBersama</h1>
               <p>Perpustakaan BacaBersama: Menyatu dalam Dunia Ilmu, Membuka Cakrawala Pengetahuan Bersama-sama!</p>
               <img src="img/1.jpg" alt="Gambar Sekolah">
          </section>
          <section class="about">
               <h2>Tentang Kami</h2>
               <p>Perpustakaan BacaBersama adalah tempat yang didedikasikan untuk mempromosikan cinta literasi dan pengetahuan di kalangan masyarakat. Kami percaya bahwa akses mudah terhadap buku dan informasi adalah hak setiap individu, dan itulah yang mendasari terbentuknya perpustakaan ini.
                    Perpustakaan BacaBersama dikelola oleh tim yang berdedikasi, terdiri dari para pustakawan berpengalaman dan sukarelawan yang peduli terhadap peningkatan literasi masyarakat. Kami senantiasa berusaha memberikan pelayanan yang terbaik dan memberikan bantuan dalam pencarian dan pemahaman informasi.
                    Terima kasih telah menjadi bagian dari Perpustakaan BacaBersama. Mari bersama-sama mengeksplorasi dunia ilmu pengetahuan dan meningkatkan kualitas hidup melalui keajaiban kata-kata di setiap halaman buku.
               </p>
          </section>
          <section class="features">
               <h2>Fasilitas Kami</h2>
               <p>
                    Perpustakaan BacaBersama telah didesain untuk memberikan pengalaman membaca dan belajar yang maksimal bagi semua pengunjung. Kami menyediakan berbagai fasilitas yang dirancang untuk memenuhi kebutuhan beragam pembaca dan memberikan kenyamanan dalam mengeksplorasi dunia literasi.
               </p>
               <p>
                    Kami berkomitmen untuk terus meningkatkan fasilitas kami demi memberikan pengalaman berharga bagi setiap pengunjung Perpustakaan BacaBersama. Mari bergabung, berkembang, dan bersama-sama mengeksplorasi dunia pengetahuan dan imaginasi!
               </p>
          </section>
     </div>
     <!-- Sticky Footer -->
     <footer class="footer">
          <div class="school-info">
               <p>Perpustakaan BacaBersama</p>
          </div>
     </footer>

</body>

</html>