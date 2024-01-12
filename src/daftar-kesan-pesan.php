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
     <title>SMKN 1 Yogyakarta</title>
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
               position: fixed;
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
               max-width: 100%;
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

          /* Additional styles for the form */

          .form-section {
               background-color: #f8f8f8;
               padding: 30px;
               border-radius: 10px;
               box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          }

          .form-section h2 {
               font-size: 1.8em;
               margin-bottom: 20px;
          }

          .contact-form {
               display: flex;
               flex-direction: column;
               max-width: 400px;
               margin: 0 auto;
          }

          label {
               margin-bottom: 8px;
               font-weight: bold;
          }

          input,
          textarea {
               padding: 10px;
               margin-bottom: 16px;
               border: 1px solid #ccc;
               border-radius: 5px;
               font-size: 1em;
          }

          button {
               background-color: #3498db;
               color: white;
               padding: 10px 15px;
               border: none;
               border-radius: 5px;
               cursor: pointer;
               font-size: 1em;
          }

          button:hover {
               background-color: #2980b9;
          }

          /* Additional styles for the Daftar Siswa Table */

          .student-list {
               margin-bottom: 30px;
          }

          .student-list h2 {
               font-size: 1.5em;
               margin-bottom: 10px;
          }

          .styled-table {
               width: 100%;
               border-collapse: collapse;
               margin: 25px 0;
               font-size: 18px;
               text-align: left;
          }

          .styled-table th,
          .styled-table td {
               padding: 12px 15px;
               border-bottom: 1px solid #ddd;
          }

          .styled-table th {
               background-color: #3498db;
               color: white;
          }

          .styled-table tbody tr:hover {
               background-color: #f5f5f5;
          }

          .styled-table button {
               padding: 8px 12px;
               background-color: #2ecc71;
               color: white;
               border: none;
               cursor: pointer;
          }

          .styled-table button:hover {
               background-color: #27ae60;
          }

          .card {
               background: linear-gradient(to bottom, #f9f9f9, #e6e6e6);
               box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
               border: 1px solid #ccc;
               border-radius: 12px;
               overflow: hidden;
               transition: transform 0.3s ease-in-out;
          }

          .card:hover {
               transform: scale(1.05);
          }

          .card-header {
               background: linear-gradient(to bottom, #3498db, #297fb8);
               color: #fff;
               padding: 15px;
               font-size: 1.3em;
               text-align: center;
               border-bottom: 1px solid #196b99;
          }

          .card-body {
               padding: 20px;
          }

          .card-text {
               font-size: 1.1em;
               color: #333;
          }

          .card-text p {
               margin: 10px 0;
          }

          .text-bg-light {
               background-color: #f0f0f0;
          }

          .m-3 {
               margin: 1rem;
          }

          .col-md-3 {
               flex: 0 0 25%;
               max-width: 25%;
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
          <section class="student-list">
               <h2>Kesan Pesan</h2>
               <?php
               if (isset($session_login)) {
                    if ($session_login !== 'admin') {
                         echo '
                <nav class="mt-5" style="width:fit-content">
                    <a href="kesan-pesan.php" class="link-warning">[+] Tambah Baru</a>
                </nav>
                ';
                    }
               }
               ?>


               <br />
               <div class="d-flex flex-row flex-wrap justify-content-between" style="display: flex;">
                    <?php
                    $sql = "
            SELECT
                tpk.id_user AS ID_USER,
                CASE 
                WHEN ms.name IS NOT NULL THEN
                    ms.name
            END AS NAMA,
                tpk.id_user AS ID_USER,
                tpk.pesan_kesan AS PESAN_KESAN,
                tpk.created_date AS CREATED_DATE
            FROM
                trx_pesan_kesan tpk
                LEFT JOIN mst_user ms ON ms.id = tpk.id_user
            ORDER BY 
                tpk.created_date DESC
            ";
                    $query = mysqli_query($conn, $sql);
                    $number = 1;
                    while ($pesanKesan = mysqli_fetch_array($query)) {
                         echo '
                              <div class="card text-bg-light m-3 col-md-3" style="max-width: 18rem;">
                              <h6 class="card-header">' . $pesanKesan['NAMA'] . '</h6>
                              <div class="card-body">
                                   <div class="card-text">
                                        <p>' . $pesanKesan['PESAN_KESAN'] . '</p>
                                        <p>' . $pesanKesan['CREATED_DATE'] . '</p>
                                   </div>
                              </div>
                              </div>
                         ';

                         $number++;
                    }
                    ?>
               </div>

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