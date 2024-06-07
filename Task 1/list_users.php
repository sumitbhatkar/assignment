<?php

include 'dbconnect.php';

$sql = "SELECT id, name, email, created_at FROM users";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["id"] . "<br>";
        echo "Name: " . $row["name"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "Created At: " . $row["created_at"] . "<br><br>";
    }
} else {
    echo "0 results";
}


mysqli_close($conn);

?>
