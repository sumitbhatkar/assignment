
<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "building";


$conn = mysqli_connect($servername, $username, $password, $dbname);


// Check connection
if(!$conn)
{
    echo "connection ok";
}
else
{
    echo "Connection failed".mysqli_connect_error();
}


?>
