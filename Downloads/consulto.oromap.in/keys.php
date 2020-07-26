<?php
$email=$_POST['email'];
$password=hash('sha256',$_POST['password']);
$a=$_POST['pub'];
$b=$_POST['priv'];
$con = new mysqli("fdb17.awardspace.net","2458395_datax","Dakota101","2458395_datax");
if($con->connect_error)
{
echo '404';
}
else
{
$res=$con->query("SELECT password,privkeys,pubkeys FROM customers WHERE email='".$email."'");
$row=$res->fetch_assoc();
if(strcmp($row['password'],$password)==0)
{
if($a==1)
{
$json = "{
'pubkey':'".$row['pubkeys']."'";
if($b==1)
{
$json = $json.", 'privkey':'".$row['privkeys']."'}";
}
else
{
$json=$json."}";
}
}
else if($b==1)
{
$json = "{
'privkey':'".$row['privkeys']."'}";
}
echo $json;
}
else
{
echo '404';
}
}
?>