<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "project");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM data WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<html>
<head>
    <title> Profile Data </title>
    <link rel="stylesheet" href="mystyles2.css">
    <style>
        .newform{
                padding: 10px;
                border-radius: 40px;
                border-width: 10px;
                border-color: #b95d52;
                border-style: double;
                width: 40%;
                margin-top: 5%;
                margin-bottom: 5%;
                padding-top: 20px;
                padding-bottom: 30px;
                box-shadow: 2px 2px 4px 2px rgb(0,20,30);
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
         span{
            font-size:25Px;
            color : black;
         }
         span1{
            font-size:30px;
            color:black;
            font-weight: bolder;
         }
         button ,a{
            text-decoration:none ;
            
         }
         h1{
            color:black;
         }
    </style>
</head>
<center>
<body class="mainbody">
<section class="newform">
    <h1> PROFILE INFO </h1>
    <hr>
    <?php
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        echo "<span1>Username:</span1> <span>" . $row['username'] . "</span><br>";
        echo "<span1>Email:   </span1> <span>" . $row['email'] . "</span><br>";
        echo "<span1>Age:</span1> <span>" . $row['age'] . "</span><br>";
        echo "<span1>Gender:</span1> <span>" . $row['gender'] . "</span><br>";
        echo "<span1>Date of Birth:</span1> <span>" . $row['dateofbirth'] . "</span><br>";
        echo "<span1>Phone number:</span1> <span>" . $row['phonenumber'] . "</span><br>";
        echo "<span1>State:</span1> <span>" . $row['State'] . "</span><br>";
        echo "<span1>Address:</span1> <span>" . $row['address'] . "</span><br>";
        echo "<span1>Doctor Name:</span1> <span>" . $row['doctorname'] . "</span><br>";
        echo "<span1>sepcialist :</span1> <span>" . $row['doctorspecialist'] . "</span><br>";

    } else {
        echo "No user found.";
    }
    ?>
    <br>
    <form action="loginsucess.html">
        <br>
        <button class="update">Back</button>
    </form>
    </section>
</body>
</center>
</html>
<?php
$stmt->close();
$conn->close();
?>