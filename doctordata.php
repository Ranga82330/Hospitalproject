<?php
session_start(); // Start the session to access session variables
$conn = mysqli_connect("localhost", "root", "", "project");

if ($conn) {
  echo "Connected";
} else {
  echo "Failed";
}

// Retrieve the doctor name and specialist from the submitted form
$doctorname = $_POST['doctorname'];
$doctorspecialist = $_POST['doctorspecialist'];
$user_id = $_SESSION['user_id']; // Get the logged-in user's ID from the session

// Prepare the update query using the user ID
$updateQuery = "UPDATE data SET doctorname = '$doctorname', doctorspecialist = '$doctorspecialist' WHERE id = '$user_id'"; // Assuming 'id' is the primary key

$updateResult = mysqli_query($conn, $updateQuery);

if ($updateResult) {
  echo "Doctor information updated successfully";
  header("Location: bookappoinment1.php");
  exit();
} else {
  echo "Failed to update doctor information: " . mysqli_error($conn);
}
?>
