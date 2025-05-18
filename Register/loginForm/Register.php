<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// PHPMailer include karo
require __DIR__ . '/../../project-folder/phpmailer/PHPMailer.php';
require __DIR__ . '/../../project-folder/phpmailer/SMTP.php';
require __DIR__ . '/../../project-folder/phpmailer/Exception.php';

// DB connection
$host = "localhost";
$username = "root";
$password = "";
$database = "turnament";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Form data
$email = $_POST['email'];
$pass = $_POST['password'];

// Check if email already exists
$checkQuery = "SELECT * FROM register WHERE email = ?";
$checkStmt = $conn->prepare($checkQuery);
$checkStmt->bind_param("s", $email);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    echo "<h3 style='color: orange;'>⚠️ This email is already registered.</h3>";
    exit;
}

// Insert into DB
$sql = "INSERT INTO register (email, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $pass);

if ($stmt->execute()) {
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'gullytournament222@gmail.com';  // ✅ Gmail sender
        $mail->Password   = 'ekdz iyjg bnuf xzab';           // ✅ App password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('gullytournament222@gmail.com', 'Gully Tournament');  // ✅ Match with SMTP sender
        $mail->addAddress($email);
        $mail->addReplyTo('gullytournament222@gmail.com', 'Support Team');

        $mail->isHTML(true);
        $mail->Subject = '🎮 Welcome to Gully Tournament!';
        $mail->Body    = "
        <div style='font-family: Arial, sans-serif; background-color: #111; color: #eee; padding: 20px; border-radius: 10px;'>
            <h2 style='color: #00ffff;'>Welcome to Gully Tournament, Gamer! 🎮</h2>
            <p>Thanks for registering with us. You're officially in!</p>
            <ul>
                <li>🔥 Upcoming tournaments & updates</li>
                <li>🏆 Compete for prizes & leaderboard spots</li>
                <li>📰 News, schedules & game modes</li>
            </ul>
            <p>Stay connected on our <a href='https://yourwebsite.com' style='color: #00ffff;'>official site</a> or follow us on Instagram for sneak peeks.</p>
            <br>
            <p>All the best,<br><strong>Gully Tournament Team</strong></p>
            <hr style='border: 0; border-top: 1px solid #444;'>
            <p style='font-size: 12px; color: #888;'>This is an automated email. Please don’t reply directly. You're receiving this because you signed up for Gully Tournament.</p>
        </div>";
        $mail->AltBody = "You're registered for Gully Tournament. Visit our site for more.";

        $mail->send();
        echo "<h3 style='color: green;'>✔️ Registered Successfully & Email Sent to $email</h3>";
    } catch (Exception $e) {
        echo "<h3 style='color: orange;'>Registered but Mail Failed: {$mail->ErrorInfo}</h3>";
    }
} else {
    echo "<h3 style='color: red;'>❌ Error: " . $stmt->error . "</h3>";
}

$stmt->close();
$conn->close();
?>
