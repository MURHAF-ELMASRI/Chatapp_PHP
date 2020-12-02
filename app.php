<?php
session_start();
header("Content-Type: application/json;charset=utf-8");
if(!isset($_SESSION['chat']))$_SESSION['chat']=array();
if(isset($_POST['send'])) {
    $_SESSION['chat'][]=$_POST['send'];
}
$data=$_SESSION['chat'];
echo(json_encode($data)); 

