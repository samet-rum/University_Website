<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// MySQL bağlantısı (XAMPP varsayılan ayarları)
$host = "localhost";
$dbname = "universite_website";  // phpMyAdmin'de oluşturulmuş veritabanı
$user = "root";
$password = ""; // XAMPP'de genellikle şifre boş olur

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Formdan gelen veriler
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Email ile kullanıcıyı sorgula
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $user['password'])) {
            echo "Giriş başarılı! Hoş geldiniz, " . htmlspecialchars($user['firstname']) . ".";
            // Gerekirse session aç:
            // session_start();
            // $_SESSION['user_id'] = $user['id'];
            // header("Location: dashboard.php"); exit;
        } else {
            echo "Hatalı şifre girdiniz.";
        }
    } else {
        echo "Bu e-posta ile kayıtlı bir kullanıcı bulunamadı.";
    }

} catch (PDOException $e) {
    echo "Veritabanı bağlantı hatası: " . $e->getMessage();
}
?>
