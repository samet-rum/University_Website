<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// MySQL Bağlantısı (XAMPP uyumlu)
$host = "localhost";
$dbname = "universite_website"; // phpMyAdmin'de oluşturulacak veritabanı adı
$user = "root";
$password = ""; // XAMPP varsayılan şifresi boş

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $email     = $_POST['email'];
    $password_hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (firstname, lastname, email, password) 
            VALUES (:firstname, :lastname, :email, :password)";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':firstname' => $firstname,
        ':lastname'  => $lastname,
        ':email'     => $email,
        ':password'  => $password_hashed
    ]);

    echo "Kayıt başarılı!";
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
?>
