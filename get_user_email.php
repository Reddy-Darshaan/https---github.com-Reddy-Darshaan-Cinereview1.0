<?php
session_start();

// Check if the user's email is stored in the session
if (isset($_SESSION['email'])) {
    echo $_SESSION['email'];
} else {
    echo 'Guest';
}
?>
