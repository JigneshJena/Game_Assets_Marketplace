<?php 

$servername="localhost";
$username="root";
$password="";
$dbname="game_assets";


$conn=new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){ //   '->'  this is object operator used to access properties(variable) and Methods
    die("Connection Failed: ".$conn->connect_errno);
    // die() is a built in funciton used to stop the execution of the scrip immediately . We can use alternatives like exit()
}

?>