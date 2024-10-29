<?php
session_start(); // Start session to store messages
// Initialize message variables
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connect to database
    $conn = new mysqli('localhost', 'root', '', 'moviereview');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the email already exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Email exists, show error message
        $message = "This email is already registered. Please log in.";
        $messageType = 'error'; // Set error message type
    } else {
        // Insert new user
        $passwordHash = password_hash($password, PASSWORD_BCRYPT); // Hash the password
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$passwordHash')";

        if ($conn->query($sql) === TRUE) {
            $message = "Sign up successful! You can now log in.";
            $messageType = 'success'; // Set success message type
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
            $messageType = 'error'; // Set error message type
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineReview - Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="page.css">
</head>

<body>
    <div class="bg-container-1 text-center">
        <img src="https://up.yimg.com/ib/th?id=OIP.TG6Z4hNZd1emQOIkOHod5gHaHM&pid=Api&rs=1&c=1&qlt=95&w=110&h=107" alt="Star Icon" class="star-icon" />
        <h1 class="heading-1">Sign Up for CineReview</h1>
        <img src="https://up.yimg.com/ib/th?id=OIP.TG6Z4hNZd1emQOIkOHod5gHaHM&pid=Api&rs=1&c=1&qlt=95&w=110&h=107" alt="Star Icon" class="star-icon" />

        <!-- Display Success or Error Messages -->
        <?php if (!empty($message)) { ?>
            <div class="alert alert-<?php echo $messageType === 'success' ? 'success' : 'danger'; ?>">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <form class="form-signup" action="signup.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-warning">Sign Up</button>
        </form>
        <button id="backButton" class="btn btn-outline-warning mt-4" onclick="window.location.href='index.html'">Back</button>
    </div>

    <footer>
        <p>&copy; 2024 CineReview. All rights reserved.</p>
    </footer>

    <script src="scripts.js"></script>
</body>

</html>
