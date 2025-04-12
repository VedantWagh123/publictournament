<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "turnament";

// Connect
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form se data
$email = $_POST['email'];
$password = $_POST['password'];

// Email aur password register table me exist karta hai ya nahi
$sql = "SELECT * FROM register WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User found, login success
    echo "<h2 style='color: green;'>Login Successful! 🎉</h2>";
} else {
    // Invalid credentials
    echo "<h2 style='color: red;'>Invalid Email or Password 🚫</h2>";
}

$stmt->close();
$conn->close();
?>
