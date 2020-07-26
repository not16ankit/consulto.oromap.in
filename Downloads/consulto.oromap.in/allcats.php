<?php
$con = new mysqli("fdb17.awardspace.net","2458395_datax","Dakota101","2458395_datax");
if($con->connect_error)
{
echo '404';
}
else
{
$json = "{'cats':[";
for($x=1;$x<=8;$x++)
{
$res=$con->query("SELECT name FROM gigs WHERE id='".$x."'");
$row=$res->fetch_assoc();
$json = $json."{'title':'".$row['name']."','id':'".$x."'}";
if($x!=8)
{
$json=$json.',';
}
}
echo $json.']}';
}
?>