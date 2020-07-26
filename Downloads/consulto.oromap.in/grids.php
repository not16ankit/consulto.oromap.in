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
$res=$con->query("SELECT password,recents FROM customers WHERE email='".$email."'");
$row=$res->fetch_assoc();
if(strcmp($row['password'],$password)==0)
{
$recents = explode(",",$row['recents']);
for($x=0;$x<count($recents);$x++)
{
$GLOBALS['json'] = $GLOBALS['json']."{'id':'".$recents[$x]."',";
$resres=$con->query("SELECT name,enrollments FROM gigs WHERE id='".$recents[$x]."'");
$rowrow=$resres->fetch_assoc();
$GLOBALS['json']=$GLOBALS['json']."'title':'".$rowrow['name']."'}";
if(!$x==(count($recents)-1))
{
$GLOBALS['json'] = $GLOBALS['json'].',';
}
}
$arr=array();
for($x=1;$x<=7;$x++)
{
$res=$con->query("SELECT rating,id FROM gigs WHERE id='".$x."'");
$row=$res->fetch_assoc();
$arr[$row['id']]=$row['rating'];
}
sort($arr);
$id=0;
$cusids=array();
for($x=0;$x<3;$x++)
{
$res=$con->query("SELECT id,name FROM gigs WHERE rating='".$arr[$x]."' AND id>'".$id."'");
$row=$res->fetch_assoc();
$GLOBALS['cus']=$GLOBALS['cus']."{'id':'".$row['id']."','rating':'".$arr[$x]."','title':'".$row['name']."'}";
$id=$row['id'];
if($x!=2)
{
$GLOBALS['cus']=$GLOBALS['cus'].',';
}
}
$arr=array();
for($x=1;$x<=7;$x++)
{
$res=$con->query("SELECT enrollments,id FROM gigs WHERE id='".$x."'");
$row=$res->fetch_assoc();
$arr[$row['id']]=$row['enrollments'];
}
rsort($arr);
$id=7;
$cusids=array();
for($x=0;$x<2;$x++)
{
$res=$con->query("SELECT id,name FROM gigs WHERE enrollments='".$arr[$x]."' AND id<='".$id."'");
$row=$res->fetch_assoc();
$GLOBALS['trends']=$GLOBALS['trends']."{'id':'".$row['id']."','enrollments':'".$arr[$x]."','title':'".$row['name']."'}";
$id=$row['id'];
if($x!=1)
{
$GLOBALS['trends']=$GLOBALS['trends'].',';
}
}
echo  
"
{
'num':'4';
'1':'Your Preferences',
'1child':[
".$GLOBALS['json']."
],
'2':'Categories',
'2child':[
{
'title':'Career',
'picture':'career.png',
'id':'2'
},
{
'title':'Fund Management',
'picture':'healthandnutrition.png',
'id':'8'
},
{
'title':'Communication Skills',
'picture':'selfgrooming.png',
'id':'6'
}],
'3':'Trending',
'3child':[
".$GLOBALS['trends']."
],
'4':'Customer Ratings',
'4child':[
".$GLOBALS['cus']."
]
}
";
}
else
{
echo '404';
}
}
?>