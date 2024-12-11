<?php
// Start session for storing user info
session_start();

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "project");

if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Failed to connect to the database']);
    exit();  
}

// Get username and password from POST request
$username = $_POST['username'];
$password = $_POST['password'];

// Set the content type to JSON
header('Content-Type: application/json');

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT id FROM data WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    echo json_encode(['success' => false, 'message' => 'Error executing query']);
    exit();
}

$count = $result->num_rows;

if ($count >0) {
    // Fetch the user ID
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id']; // Store user ID in session
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid Username or Password']);
}

// Close the connection
$conn->close();
?>