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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ambil data dari formulir
    $id = $_POST['id_buku'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];

    // buat query
    if ($_POST['isEdit'] == "no") {
        $sql = "INSERT INTO mst_buku (judul, pengarang, penerbit) VALUE ('$judul', '$pengarang', '$penerbit')";
    } else {
        $sql = "UPDATE mst_buku SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit' WHERE id=$id";
    }
    //     var_dump($sql);
    // exit;
    $query = mysqli_query($conn, $sql);

    // apakah query simpan berhasil?
    if ($query) {
        // kalau berhasil alihkan ke halaman sebelumnya dengan status=success
        $status = $_POST['isEdit'] == "yes" ? "successEdit" : "success";
        header('Location: daftar-buku.php?status=' . $status);
    } else {
        // kalau gagal alihkan ke halaman sebelumnya dengan status=gagal
        $status = $_POST['isEdit'] == "yes" ? "failedEdit" : "failed";
        header('Location: daftar-buku.php?status=failed');
    }
}

$id = isset($_GET['id']) ? $_GET['id'] : false;

if ($id) {
    // buat query untuk ambil data dari database
    $sql = "SELECT * FROM mst_buku WHERE id=$id";
    $query = mysqli_query($conn, $sql);
    $buku = mysqli_fetch_assoc($query);

    // jika data yang di-edit tidak ditemukan
    if (mysqli_num_rows($query) < 1) {
        die("data tidak ditemukan...");
    }
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
        <section class="form-section">
            <h2><?php echo isset($buku) ? "Edit Buku" : "Tambah buku"; ?></h2>

            <form action="#" method="post" class="contact-form" style="margin-bottom:100px">
                <label for="judul">Judul:</label>
                <input type="text" id="judul" name="judul" value="<?php echo isset($buku) ? $buku['judul'] : ''; ?>" required>

                <label for="pengarang">Pengarang:</label>
                <input type="text" id="pengarang" name="pengarang" value="<?php echo isset($buku) ? $buku['pengarang'] : ''; ?>" required>

                <label for="penerbit">Penerbit:</label>
                <input type="text" id="penerbit" name="penerbit" value="<?php echo isset($buku) ? $buku['penerbit'] : ''; ?>" required>

                <input type="text" id="isEdit" name="isEdit" value="<?php echo isset($buku) ? "yes" : "no"; ?>" hidden>

                <input type="text" id="id_buku" name="id_buku" value="<?php echo isset($buku) ? $buku['id'] : ''; ?>" hidden>

                <button type="submit"><?php echo isset($buku) ? "Edit Buku" : "Tambah buku"; ?></button>
            </form>
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