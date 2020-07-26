<?php
$type=$_POST['type'];
$pubkey=$_POST['pubkey'];
$privkey=$_POST['privkey'];
$email=$_POST['email'];
$recents=$_POST['recents'];
$name=$_POST['name'];
$password=hash('sha256',$_POST['password']);
$subs='{"id":"1"},{"id":"2"},{"id":"3"},{"id":"4"},{"id":"5"},{"id":"6"},{"id":"7"},{"id":"8"}';
$con = new mysqli("fdb17.awardspace.net","2458395_datax","Dakota101","2458395_datax");
if($con->connect_error)
{
echo '404';
}
else
{
$res=$con->query("SELECT name,verified,recents,type,password FROM customers WHERE email='".$email."'");
$row=$res->fetch_assoc();
if($type==1)
{
if(strcmp($row['password'],$password)==0)
{
echo "200";
}
else
{
echo '404';
}
}
elseif($type==2)
{
if(strcmp('',$row['password'])==0)
{
$con->query("INSERT INTO customers(name,email,password,verified,recents,type,pubkeys,privkeys,wallet,subs) VALUES('".$name."','".$email."','".$password."','1','".$recents."','2','".$pubkey."','".$privkey."','0','".$subs."')");
echo "200";
}
else{
  if(strcmp($row['password'],$password)==0)
{
echo "200";
}
else
{
echo '404';
}
}
}
elseif($type==3)
{
    if(strcmp('',$row['password'])==0)
{
$con->query("INSERT INTO customers(name,email,password,verified,recents,type,pubkeys,privkeys,wallet,subs) VALUES('".$name."','".$email."','".$password."','1','".$recents."','3','".$pubkey."','".$privkey."','0','".$subs."')");
echo "200";
}
else{
   if(strcmp($row['password'],$password)==0)
{
echo "200";
}
else
{
echo '404';
}
}
}
}
?>