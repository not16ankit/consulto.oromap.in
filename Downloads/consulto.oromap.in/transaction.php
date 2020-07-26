<?php
$email=$_POST['email'];
$password=hash('sha256',$_POST['password']);
$query=$_POST['query'];
$status=$_POST['status'];
$orderid=$_POST['orderid'];
$type=$_POST['type'];
$amount=$_POST['amount'];
$hash=$_POST['hash'];
$txnid=$_POST['txnid'];
$response=$_POST['response'];
$date=$_POST['date'];
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
$con->query("INSERT INTO transactions(user,status,orderid,type,amount,response,date,txnid) VALUES('".$email."','".$status."','".$orderid."','".$type."','".$amount."','".$response."','".$date."','".$txnid."')");
$res=$con->query("SELECT wallet,trannum FROM customers WHERE email='".$email."'");
$row=$res->fetch_assoc();
$trannum=$row['trannum']+1;
$con->query("UPDATE customers SET trannum='".$trannum."' WHERE email='".$email."'");
$money=$row['wallet'];
if(strcmp($status,"TXN_SUCCESS")==0)
{
$money=$money+$amount;
$con->query("UPDATE customers SET wallet='".$money."' WHERE email='".$email."'");
}
echo $money;
}
else
{
echo 'hacker or what?';
}
}
else
{
echo '404';
}
}
?>
