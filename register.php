<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "cdx_registration";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$name     = $_POST['name'];
$email    = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
  echo "<h2 style='color: lime;'>Pendaftaran berhasil!<br><a href='home.html'>Lanjut ke Home</a></h2>";
} else {
  echo "<h2 style='color: red;'>Gagal mendaftar: " . $stmt->error . "</h2>";
}

$stmt->close();
$conn->close();
?>
