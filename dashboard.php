<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "project");

// If session is not set but the login token cookie exists
if (!isset($_SESSION['user_id']) && isset($_COOKIE['login_token'])) {
    $token = $_COOKIE['login_token'];

    // Query the database for the token
    $token_stmt = $conn->prepare("SELECT id FROM data WHERE login_token = ?");
    $token_stmt->bind_param("s", $token);
    $token_stmt->execute();
    $result = $token_stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user ID and log the user in by setting the session
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
    } else {
        // Invalid token, clear the cookie
        setcookie('login_token', '', time() - 3600, "/");
    }
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if no session or valid token found
    header("Location: Exp12-Loginpage.html");
    exit();
}
?>
