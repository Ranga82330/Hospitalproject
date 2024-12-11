<?php
session_start(); // Start the session to access session variables

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You are not logged in!");
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'project');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the logged-in user's ID from the session
$user_id = $_SESSION['user_id'];
$select = mysqli_query($conn, "SELECT * FROM data WHERE id = '$user_id'") or die('query failed');
if (mysqli_num_rows($select) > 0) {
    $fetch = mysqli_fetch_assoc($select);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the POST variables are set and not empty
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $phonenumber = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';

    // Update user data in the database
    if (!empty($password)) {
        // If password is provided, hash it
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE data SET email = ?, password = ?, phonenumber = ?, address = ? WHERE id = ?";

        // Prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $email, $password, $phonenumber, $address, $user_id);
    } else {
        // Update without changing the password
        $sql = "UPDATE data SET email = ?, phonenumber = ?, address = ? WHERE id = ?";

        // Prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $email, $phonenumber, $address, $user_id);
    }

    // Execute the query
    if ($stmt->execute()) {
        $successFlag = true;
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<html>
<head>
    <title>Profile Update</title>
    <link rel="stylesheet" href="mystyles2.css"/>
    <style>
        form {
            padding: 10px;
            border-radius: 30px;
            border-width: 10px;
            border-color: #b95d52;
            border-style: double;
            width: 35%;
            margin-top: 5%;
            padding-top: 5px;
            box-shadow: 2px 2px 4px 2px rgb(0,20,30);
        }
        h1 {
            padding-top: 10px;
        }
        .button:hover {
            background-color: darkcyan;
            color: white;
        }
        .update:hover{
                background-color: darkcyan;
                color: white;
                font-size:20px ; 
                border-radius: 10px;
         }
         .update{
            font-size:20px ; 
            border-radius: 10px;
            color: darkblue:
         }
         .update a{
          text-decoration: none;
          font-size:20px;
          font-weight: lighter;
         }
         .success-message {
            display: none; /* Hidden by default */
            background-color: #28a745;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body class="mainbody">
<center>
    <form action="update_profile.php" method="POST">
    <div class="success-message" id="successMessage">
        Profile updated successfully!
    </div>
        <h1>Profile Update</h1>
        <br>
        <table>
            <tr>
                <td>EMAIL ID:</td>
                <td><input type="email" name="email" value="<?php echo $fetch['email']; ?>"></td>
            </tr>
            <tr>
                <td>PASSWORD:</td>
                <td><input type="text" name="password" value="<?php echo $fetch['password']; ?>"></td>
            </tr>
            <tr>
                <td>PHONE NUMBER:</td>
                <td><input type="tel" name="phonenumber" pattern="[0-9]{10}" value="<?php echo $fetch['phonenumber']; ?>"></td>
            </tr>
            <tr>
                <td>ADDRESS:</td>
                <td><textarea name="address"><?php echo $fetch['address']; ?></textarea></td>
            </tr>
        </table>
        <br>
        <br>
        <input type="submit" class="button" value="Update" style="font-size: 120%; border-radius: 10px;">
        <br>
        <br>
        <button class="update"><a href="bookappoinment1.php">Back</a></button>

  </form>
</center>
<footer>
    <marquee>
        <p>&copy; 2024 Pure Medical HealthCare. All rights reserved.</p>
    </marquee>
</footer>
<script>
    <?php if ($successFlag) : ?>
        document.getElementById("successMessage").style.display = "block";
        setTimeout(() => {
            document.getElementById("successMessage").style.display = "none";
            window.location.href = "update_profile.php?refreshed=1";
        }, 3000);
       
    <?php endif; ?>
</script>
</body>
</html>
