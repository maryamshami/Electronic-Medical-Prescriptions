<?php
session_start();

$identification_number = $_POST['identification_number'];
$password = $_POST['password'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check patients table
$sql = "SELECT * FROM patients WHERE identification_number = '$identification_number' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $_SESSION['identification_number'] = $identification_number;
  echo ("<script>alert('Login successful'); window.location.href='home.html';</script>");
  mysqli_close($conn);
  exit();
}

// Check doctors table
$sql = "SELECT * FROM doctors WHERE identification_number = '$identification_number' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $_SESSION['identification_number'] = $identification_number;
  echo ("<script>alert('Login successful'); window.location.href='home.html';</script>");
  mysqli_close($conn);
  exit();
}

// Check pharmacists table
$sql = "SELECT * FROM pharmacists WHERE identification_number = '$identification_number' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $_SESSION['identification_number'] = $identification_number;
  echo ("<script>alert('Login successful'); window.location.href='home.html';</script>");
  mysqli_close($conn);
  exit();
}

// If no record found, show error message
echo ("<script>alert('Invalid identification_number or password'); window.location.href='login.html';</script>");
mysqli_close($conn);
?>
