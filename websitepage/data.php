<?php
// ✅ Database connection details
$host = "localhost";
$username = "root";
$password = "";
$database = "turnament";

// ✅ Create connection
$conn = new mysqli($host, $username, $password, $database);

// ✅ Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ✅ Game type from hidden field
    $game = $_POST['game'] ?? '';

    // ✅ Validate game type and set table
    if ($game == "freefire" || $game == "pubg" || $game == "callofdeuty") {
        $table = $game;
    } else {
        die("Invalid game selected");
    }

    // ✅ Collect form data safely using null coalescing operator
    $name = $_POST['name'] ?? '';
    $department = $_POST['department'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $igl = $_POST['igl'] ?? ''; // ✅ FIXED: Prevent "undefined index" warning

    // ✅ Prepare and bind (SQL injection safe)
    $stmt = $conn->prepare("INSERT INTO $table (name, department, contact, igl) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $department, $contact, $igl);

    // ✅ Execute and show result
    if ($stmt->execute()) {
        echo "🎉 Registration successful for <strong>$game</strong>!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    // ✅ Close statement
    $stmt->close();

} else {
    echo "Invalid access!";
}

// ✅ Close connection
$conn->close();
?>
