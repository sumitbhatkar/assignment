<?php

include 'dbconnect.php';

$id = 1; 
$new_name = "Ravi Bhatkar";
$new_email = "ravibhatkar@gmail.com";

 $sql = "UPDATE users SET name='$new_name', email='$new_email' WHERE id=$id";


   if (mysqli_query($conn, $sql)) {
       echo "Record updated successfully";
    } else {
       echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }


mysqli_close($conn);

?>
