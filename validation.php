<?php
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "ayush";
$dbname = "library";
//require 'core.inc.php';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$uid=$_POST['u'];
$pass=$_POST['p'];
$f=0;
$sql = " Select Username, Password from login where Username='$uid' And Password= '$pass' ";
foreach ($conn->query($sql) as $row) {
$f=1;
if($f==1)
{
        print $row['Username'] . "\t";  
        $_SESSION['Username']=$uid; 
        header('Location: home.php');
}     
}
if($f==0)
{
	//print "You have Entered Wrong Credentials";
	header('Location: error.html');
} 

// Check connection
/*
echo "Connected successfully";*/
 $conn = null;
 
?>
