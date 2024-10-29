<?php
session_start();
include 'db_connect.php'; // Include the DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Get the user from the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Check if the password matches the hashed password in the DB
        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email']; // Store the email in the session correctly
            header("Location: home.html"); // Use PHP for the home page instead of a .html file if you need dynamic data
            exit();
        } else {
            $_SESSION['message'] = "Incorrect password!";
            header("Location: login.html"); // Redirect back to login.html
            exit();
        }
    } else {
        $_SESSION['message'] = "No account found with this email!";
        header("Location: login.html"); // Redirect back to login.html
        exit();
    }
}
?>
