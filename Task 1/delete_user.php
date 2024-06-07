<?php

include 'dbconnect.php';

$id = 1; 

$sql = "DELETE FROM users WHERE id=$id";


if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);


?>
