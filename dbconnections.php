<?php
$host='localhost';
$user='root';
$pass='';
$dbname='assignment';

if( $mycon = mysqli_connect($host,$user,$pass,$dbname)){
	//echo'connect db';
}else{
	echo'not connect db';
}
