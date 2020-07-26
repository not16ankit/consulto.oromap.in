<?php
$id=$_POST['id'];
$email=$_POST['email'];
$password=hash('sha256',$_POST['password']);
$con = new mysqli("fdb17.awardspace.net","2458395_datax","Dakota101","2458395_datax");
if($con->connect_error)

{
echo '404';
}
else
{
$res=$con->query("SELECT password,recents FROM customers WHERE email='".$email."'");
$row=$res->fetch_assoc();
if(strcmp($row['password'],$password)==0)
{
$res=$con->query("SELECT * FROM gigs WHERE id='".$id."'");
$row=$res->fetch_assoc();
echo "
{
'description':'".$row['description']."',
'name':'".$row['name']."',
'rating':'".$row['rating']."',
'ratingnum':'".$row['ratingnums']."',
'reviews':[".$row['reviews']."]
}
";
}
else
{
echo '404';
}
}
?>