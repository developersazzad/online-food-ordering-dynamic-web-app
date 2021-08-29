<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<?php
echo "<pre>";
//bollean//
$var=true;
var_dump($var);
///string//
$str="sazzad";
var_dump($str);
//integar//
$int=12;
var_dump($int);
// integar
$val='12';
var_dump($val);
// array
$arr=array("sazzad","mahir","manik","sekab");
var_dump($arr);
// Float
$float=12.5;
var_dump($float);

//object//
class subject{
  public $data="I am web developer";
}

$my_obj=new subject();
 echo "<br />";
 var_dump($my_obj);
 $nall=Null;
 var_dump($nall);
 ?>

 <h1>Constant</h1>
 <?php
//difine
define("name","sazzad hossain rahath");
echo name;
//constant
echo "<br />";
const friend_name="Mahir Tangim";
echo friend_name;
echo "<h1>Oprator</h1>";

echo"<br />";
$nb=12;
echo "name".$nb."val";
echo"<br />";
$a = 5;


echo $a-- . "<br>";

echo $a . "<br>";

echo --$a . "<br>";

echo $a++ . "<br>";

//fuction========//
echo "<h2>Function</h2>";
function userpre($name,$mbl){
  echo "name  is =".$name;
  echo"<br />";
  echo $name." Phone Number is =".$mbl;
  echo"<br />";
}

userpre('sazzad','01835558000');
userpre('mahir','89999797276');
userpre('manik','8238979723');
userpre('tarek','1111111111');
?>
  </body>
</html>
