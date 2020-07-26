<?php
$email=$_POST['email'];
$password=hash('sha256',$_POST['password']);
$ud=$_POST['id'];
$user=$_POST['user'];
$review=$_POST['review'];
$rating=$_POST['rating'];
$con = new mysqli("fdb17.awardspace.net","2458395_datax","Dakota101","2458395_datax");
if($con->connect_error)
{
echo '404';
}
else
{
$res=$con->query("SELECT password FROM customers WHERE email='".$email."'");
$row=$res->fetch_assoc();
if(strcmp($row['password'],$password)==0)
{
$res=$con->query("SELECT reviews,rating,ratingnums FROM gigs WHERE id='".$ud."'");
$row=$res->fetch_assoc();
$newrating=($row['rating']+$rating);
$newreview=$row['reviews'].',{"review":"'.$review.'","user":"'.$user.'"}';
$con->query("UPDATE gigs SET reviews='".$newreview."',ratingnums='".($row['ratingnums']+1)."',rating='".$newrating."' WHERE id='".$ud."'");
echo '200';
}
}
?>
