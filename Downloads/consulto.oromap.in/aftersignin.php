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
$res=$con->query("SELECT name,verified,type,password,subs,privkeys,pubkeys,wallet FROM customers WHERE email='".$email."'");
$row=$res->fetch_assoc();
if(strcmp($row['password'],$password)==0)
{
echo "
{
    'name':'".$row['name']."',
    'verified':'".$row['verified']."',
    'type':'".$row['type']."',
    'pubkey':'".$row['pubkeys']."',
    'privkey':'".$row['privkeys']."',
    'mysubscriptions':[".$row['subs']."],
    'wallet':'".$row['wallet']."'
    }
";
}
else
{
echo '404';
}
}
?>
