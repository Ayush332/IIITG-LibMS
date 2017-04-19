<?php
$servername = "127.0.0.1";
$username = "root";
$password = "ayush";
$dbname = "library";
//require 'core.inc.php';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$bookid="729";
$uid="Ayush1401012";

$sql2=" Select date_of_return from issue WHERE book_id='$bookid' AND Username`='$uid' ";
$sth = $conn->prepare("SELECT date_of_return FROM issue WHERE book_id = :id AND Username= :uid");
//echo $sql2;
$sth->bindValue(':id', $bookid);
$sth->bindValue(':uid',$uid);
$sth->execute();
$result = $sth->fetchColumn();

$sths = $conn->prepare("SELECT fine FROM issue WHERE book_id = :id AND Username= :uid");
//echo $sql2;
$sths->bindValue(':id', $bookid);
$sths->bindValue(':uid',$uid);
$sths->execute();
$result1 = $sths->fetchColumn();
print("colour = $result1\n");
echo "dekho magar pyar se";
$fine=20;
$result1=$result1+$fine;
echo $result1;
         $date = "15-04-2017";
         $my_date1 = date('d/m/y', strtotime($date));
         $my_date2 = date('d/m/y', strtotime($result));
         list($d, $m, $y) = explode('-', $date);
         echo $d;
        // echo $my_date2;
         $diff = abs($my_date1 - $my_date2);
// $date11=date_create($my_date1);
//$date22=date_create($my_date1);
//$diff=date_diff($date11,$date22);
echo $diff;
 
// $my_date = date('d/m/y', strtotime($date));
 //echo $my_date;
          
   $conn->null;
   
   ?>
