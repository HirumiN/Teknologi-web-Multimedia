<?php

// Koneksi ke database
$host = "localhost";
$user = "hirumi";
$pass = "12345678";
$db = "Login";

$conn = mysqli_connect($host, $user, $pass, $db);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil data email dan password dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']); // Menggunakan 'email' sebagai nama input
    $password = $_POST['password'];

    // Hash password menggunakan MD5
    $hashed_password = md5($password);

    // Query untuk mencari user berdasarkan email dan password
    $sql = "SELECT * FROM akun WHERE email=? AND password=?"; // Menggunakan 'email' sebagai kolom dalam database

    // Gunakan prepared statement
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $hashed_password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        // Login berhasil, arahkan ke dashboard.php
        session_start();
        $_SESSION['logged_in'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        // Login gagal, arahkan kembali ke halaman login dengan pesan kesalahan
        header("Location: index.php?error=1");
        exit;
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-950">
        <div class="bg-white dark:bg-gray-900 shadow-md rounded-lg px-8 py-6 max-w-md">
            <h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-200">Login page</h1>
            <?php
            // Tampilkan pesan kesalahan
            if (isset($_GET['error']) && $_GET['error'] == 1) {
                echo "<p style='color: red;'>Email atau password salah!</p>";
            }
            ?>
            <form action="" method="post">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                <input type="email" id="email" name="email"
                    class="mb-4 shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="your email" required> <!-- Mengganti placeholder -->
                <label for="password"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                <input type="password" id="password" name="password"
                    class="mb-4 shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Enter your password" required>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</button>
            </form>
        </div>

    </div>
</body>

</html>