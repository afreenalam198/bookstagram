<?php
function OpenCon()
 {
    $dbhost = "sql303.epizy.com";
    $dbuser = "epiz_31060967";
    $dbpass = "sfWRxd6JWmN6m";
    $db = "epiz_31060967_bookstagram";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connection failed: %s\n". $conn -> error);
 
 return $conn;
 }
 function CloseCon($conn)
 {
 $conn -> close();
 }

 
/*
 
*/ 
?>