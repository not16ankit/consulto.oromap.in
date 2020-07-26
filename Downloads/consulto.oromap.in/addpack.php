<?php
$email=$_POST['email'];
$password=hash('sha256',$_POST['password']);
$packid=$_POST['packid'];
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
$res=$con->query("SELECT code FROM verifytable WHERE username='".$email."'");
$row=$res->fetch_assoc();
if(strcmp($row['code'],$hash)==0)
{

}
else
{
echo '404';
}
}
?>
