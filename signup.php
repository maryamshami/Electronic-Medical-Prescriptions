<?php
session_start();
$identification_number = $_POST['identification_number'];
$user_type = $_POST['user_type'];
$email=$_POST['email']; 
$PASSWORD=$_POST['password'];
$name=$_POST['name'];
$date=$_POST['age'];
$address=$_POST['address'];
$phone=$_POST['tele'];
$age=$_POST['age'];

$servername = "localhost";
$username = "root";
$password ="";
$dbname = "medical";

$conn = new mysqli($servername,$username,$password,$dbname);

if ($conn->connect_error) {
die("Connection failed: " .$conn->connect_error); } 












// Check if the email exists in any of the three tables
$sql = "SELECT * FROM patients WHERE identification_number = '$identification_number'
        UNION
        SELECT * FROM doctors WHERE identification_number = '$identification_number'
        UNION
        SELECT * FROM pharmacists WHERE identification_number = '$identification_number'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo ("<script>alert('Email already exists'); window.location.href='signup.html';</script>");
} else {
  // Insert the data into the appropriate table based on user type
  switch ($user_type) {
    case "patient":
      $sql = "INSERT INTO patients (identification_number , email, password, name, address, tele, age) VALUES ('$identification_number','$email', '$password', '$name','$address','$phone','$age')";
      break;
    case "doctor":
      $sql = "INSERT INTO doctors (identification_number , email, password, name, address, tele, age) VALUES ('$identification_number','$email', '$password', '$name','$address','$phone','$age')";
      break;
    case "pharmacist":
      $sql = "INSERT INTO pharmacists (identification_number , email, password, name, address, tele, age) VALUES ('$identification_number','$email', '$password', '$name','$address','$phone','$age')";
      break;
    default:
      echo ("<script>alert('Invalid user type'); window.location.href='signup.html';</script>");
      break;
  }
  
  if ($conn->query($sql) === TRUE) {
    $_SESSION['email'] = $email;
    echo ("<script>alert('Successful sign up'); window.location.href='login.html';</script>");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}














mysqli_close($conn);
	
?>