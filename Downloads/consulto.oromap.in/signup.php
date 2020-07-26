<?php
$name=$_POST['name'];
$pubkey=$_POST['pubkey'];
$privkey=$_POST['privkey'];
$email=$_POST['email'];
$recents=$_POST['recents'];
$subs='{"id":"1"},{"id":"2"},{"id":"3"},{"id":"4"},{"id":"5"},{"id":"6"},{"id":"7"},{"id":"8"}';
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
if(strcmp($row['password'],'')==0)
{
$con->query("INSERT INTO customers(name,email,password,verified,recents,type,pubkeys,privkeys,wallet,subs) VALUES('".$name."','".$email."','".$password."','0','".$recents."','1','".$pubkey."','".$privkey."','0','".$subs."')");
echo "
200
";
}
else
{
echo 'na';
}
}
?>