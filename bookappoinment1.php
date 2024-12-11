<?php
// Start the session
session_start();

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "project");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve user ID from the session
$user_id = $_SESSION['user_id'];

// SQL query to retrieve user data
$sql = "SELECT * FROM data WHERE id = ?";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameter
$stmt->bind_param("i", $user_id);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

?>


<html>
<head>
<style>
body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;

}

.container {
  display: flex;
  margin-left: 22%;
  align-items: center;
  min-height: 60vh;
}

.content {
  background-color: #fff;
  padding: 30px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  text-align: center;
}

h1 {
  margin-bottom: 20px;
}

p {
  margin-bottom: 30px;
}
body{
  background-image: url(images\ \(3\).jpeg);
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% ;
  background-position: center;
}
img{
  margin-top: 5%;
  margin-left: 2%;
  width: 55%;
}
.signout {
  position: absolute;
  right: 0;
  top: 0;
  margin-top: 60px;
  margin-right: 35px;
}
.buttons {
  display: flex;
  justify-content: center;
  gap: 20px;
}

button {
  background-color: #007bff;
  color: #040404;
  padding: 12px 20px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s;
}
button:hover {
  background-color: #0056b3;
}
a{
  text-decoration: none;
  color: white;
}
/* a{
  text-decoration: none;
  color: rgb(14, 13, 13);
  } */
  .dropbtn {
  color: rgb(242, 236, 236);
  padding: 16px;
  font-size: 16px;
  border: none;
  right: 0;
  top: 0;
  }

  .dropdown{
    position:absolute;
    margin-left: 82%;
    top: 40;
    border: none;
    right: 45;
  }
 .dropdown-content {
  display: none;
  position: absolute;
  background-color: #8d8d8dd2;
  border-radius: 20px;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 99999;
  }
  .dropdown-content a {
  color: rgb(14, 11, 11);
  padding: 12px 16px;
  text-decoration: none;
  color: rgb(253, 253, 253);
  display: block;
  border-radius: 5px;
  }
  .dropdown-content a:hover {background-color: rgb(24, 203, 223);border-radius: 5px;color:black;}

.dropdown:hover .dropdown-content{display: block;border-radius: 5px;}
</style>
</head>
<title> Appointment </title>
<body>
  <img src="main logo.png" alt="image not found">
<div></div>
<div class="container">
  <div class="content">
  <?php
    if ($result->num_rows > 0) {
        // Fetch the user data
        $row = $result->fetch_assoc();
        // Display the user data
        
        echo "<h1>" . $row['doctorname'] . "</h1>";
        // echo "<span1>specialist :</span1> <span>" . $row['doctorspecialist'] . "</span> <br>";
        echo "<span>". $row['doctorname'] ."</span> <span> welcomes you! </span><br>";
    } else {
        echo "No user found.";
    }
    ?>
    <br>
    <div class="buttons">
      <button><a href="appoinnmentpage.html">Book Appointment</a></button>
    </div>
  </div>
</div>
<div class="dropdown">
  <span class="dropbtn"><img src="profile1.png" width="100px"; alt="img not found "></span>
  <div class="dropdown-content">
  <a href="profile.php">Profile</a>
            <a href="update_profile.php">Update Profile</a>
            <a href="index.html">Sign Out</a>
  </div>
</div>

</body>
</html>