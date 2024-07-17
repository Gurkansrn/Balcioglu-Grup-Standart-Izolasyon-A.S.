<?php
// Veritabanı bağlantı bilgileri
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

// Formdan gelen verileri al
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$position = $_POST['position'];

// Veritabanına bağlan
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanı bağlantı hatası: " . $conn->connect_error);
}

// Veri eklemek için SQL sorgusu
$sql = "INSERT INTO job_applications (name, email, phone, message, position) VALUES ('$name', '$email', '$phone', '$message', '$position')";

if ($conn->query($sql) === TRUE) {
    // Başvuru başarıyla kaydedildiğini bildir
    echo "Başvuru başarıyla kaydedildi.";

    // E-posta gönderimi için gerekli bilgiler
    $to = /* "mail"*/
    $subject = "Yeni İş Başvurusu";
    $message = "Yeni bir iş başvurusu alındı.\n\nAdı Soyadı: $name\nE-posta: $email\nTelefon: $phone\nİş Pozisyonu: $position\nÖn Yazı:\n$message";
    $headers = "From: sender@example.com";

    // E-posta gönderme işlemi
    if (mail($to, $subject, $message, $headers)) {
        echo "<br>E-posta başarıyla gönderildi.";
    } else {
        echo "<br>E-posta gönderilirken bir hata oluştu.";
    }
} else {
    echo "Hata oluştu: " . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
