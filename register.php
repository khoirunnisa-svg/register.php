<?php
// Konfigurasi Database
$host = 'localhost';
$dbname = 'db_registrasi';
$username = 'root';
$password = '';

$pesan = "";
$tipe_pesan = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $pass = $_POST['password'];

    if (!empty($nama) && !empty($email) && !empty($pass)) {
        try {
            // Koneksi ke database menggunakan PDO
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Cek apakah email sudah terdaftar
            $stmtCek = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmtCek->execute([$email]);
            
            if ($stmtCek->rowCount() > 0) {
                $pesan = "Email sudah terdaftar. Silakan gunakan email lain.";
                $tipe_pesan = "danger";
            } else {
                // Enkripsi password menggunakan PASSWORD_DEFAULT
                $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

                // Query untuk menyimpan data
                $sql = "INSERT INTO users (nama, email, password) VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$nama, $email, $hashed_password]);

                $pesan = "Registrasi berhasil! Data telah disimpan ke database.";
                $tipe_pesan = "success";
            }
        } catch (PDOException $e) {
            $pesan = "Koneksi atau query gagal: " . $e->getMessage();
            $tipe_pesan = "danger";
        }
    } else {
        $pesan = "Semua kolom wajib diisi!";
        $tipe_pesan = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; margin: 0; padding: 50px; }
        .container { max-width: 400px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); margin: auto; }
        h2 { text-align: center; color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; color: #666; }
        input[type="text"], input[type="email"], input[type="password"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; background-color: #28a745; color: white; padding: 10px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #218838; }
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 4px; text-align: center; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Registrasi</h2>

    <?php if (!empty($pesan)): ?>
        <div class="alert alert-<?php echo $tipe_pesan; ?>">
            <?php echo htmlspecialchars($pesan); ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Daftar</button>
    </form>
</div>

</body>
</html>