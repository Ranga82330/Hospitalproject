<?php
$conn=mysqli_connect("localhost","root","","project");
if($conn){
  echo "Connected";
}
else{
echo "Failed";
}
$username=$_POST['username'];
$useremail=$_POST['email'];
$password=$_POST['password'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$dateofbirth=$_POST['dateofbirth'];
$phonenumber=$_POST['phonenumber'];
$State=$_POST['State'];
$address=$_POST['address'];
$datain = "INSERT INTO data (doctorname, doctorspecialist, username, email, password, age, gender, dateofbirth, phonenumber, State, address) 
VALUES ('N/A', 'N/A', '$username', '$useremail', '$password', '$age', '$gender', '$dateofbirth', '$phonenumber', '$State', '$address')";
$check = mysqli_query($conn, $datain);
if($check){
    header("location:Exp12-Loginpage.html");
}
else{
echo "Data not send";
}
?>
