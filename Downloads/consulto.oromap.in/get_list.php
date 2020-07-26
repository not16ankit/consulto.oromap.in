<?php
$email=$_POST['email'];
$password=hash('sha256',$_POST['password']);
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
$res=$con->query("SELECT trannum FROM customers WHERE email='".$email."'");
$row=$res->fetch_assoc();
$num=$row['trannum'];
$res=$con->query("SELECT * FROM transactions WHERE user='".$email."'");
$json="{'transactions':[";
for($x=0;$x<$num;$x++)
{
$row=$res->fetch_assoc();
$json=$json."{'status':'".$row['status']."','orderid':'".$row['orderid']."','type':'".$row['type']."','amount':'".$row['amount']."','response':'".$row['response']."','date':'".$row['date']."','txnid':'".$row['txnid']."'}";
if($x!=($num-1))
{
$json=$json.',';
}
}
$json=$json.']}';
echo $json;
}
else
{
echo '404';
}
}
?>
