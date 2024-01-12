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
    $id = $_POST['id'];

    // buat query
    $sql = "DELETE FROM mst_buku WHERE `mst_buku`.`id` = $id";

    // exit;
    $query = mysqli_query($conn, $sql);

    // apakah query simpan berhasil?
    if ($query) {
        header('Location: daftar-buku.php?status=success');
    } else {
        header('Location: daftar-buku.php?status=failed');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan BacaBersama</title>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
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
            position: absolute;
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

        /* Additional styles for the Daftar Buku Table */

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

        .styled-table .panel-delete button {
            background-color: red;
        }

        .styled-table .panel-delete button:hover {
            background-color: #af0404;
        }

        .styled-table button:hover {
            background-color: #27ae60;
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
            <h2>Daftar Buku</h2>
            <?php
            if (isset($session_login)) {
                if ($session_login == 'admin') {
                    $nama = $_SESSION['admin'];
                    echo '
                <nav class="mt-5" style="width:fit-content">
                    <a href="buku.php" class="link-warning">[+] Tambah Baru</a>
                </nav>
                ';
                }
            }
            ?>
            <br />
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <?php
                        if (isset($session_login) && $session_login == 'admin') {
                            echo "<th></th><th></th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>

                    <!-- Add your student data rows here -->
                    <!-- Add more rows as needed -->

                    <?php
                    $sql = "SELECT * FROM mst_buku";
                    $query = mysqli_query($conn, $sql);
                    $number = 1;
                    while ($buku = mysqli_fetch_array($query)) {
                        echo "<tr>";

                        echo "<td>" . $number . "</td>";
                        echo "<td>" . $buku['judul'] . "</td>";
                        echo "<td>" . $buku['pengarang'] . "</td>";
                        echo "<td>" . $buku['penerbit'] . "</td>";

                        if (isset($session_login) && $session_login == 'admin') {
                            $nama = $_SESSION['admin'];
                            echo '<td> <a href="buku.php?id=' . $buku['id'] . '"><button>Edit</button></a> </td>';
                            echo '<td class="panel-delete"> <form action="#" method="post"><input type="text" id="id" name="id" value="' . $buku['id'] . '" hidden required><button type="submit">Delete</button></form>';
                        }
                        echo "</tr>";
                        $number++;
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
    <!-- Sticky Footer -->
    <footer class="footer">
        <div class="school-info">
            <p>Perpustakaan BacaBersama</p>
        </div>
    </footer>

    <script>
        $(document).ready(function() {
            $('.delete-btn').on('click', function() {
                // URL where you want to send the POST request
                const url = '#';

                // Data to be sent in the POST request (replace with your data)
                const data = {
                    id: this.name
                };

                // Perform the POST request using the fetch API
                $.ajax({
                    url: url,
                    type: 'POST',
                    contentType: 'application/json', // Set the content type based on your API requirements
                    data: JSON.stringify(data), // Convert data to JSON format
                    success: function(response) {
                        console.log('POST request successful:', response);
                        // Handle the response data as needed
                    },
                    error: function(error) {
                        console.error('Error during POST request:', error);
                        // Handle errors
                    }
                });
            });
        });
    </script>
</body>

</html>