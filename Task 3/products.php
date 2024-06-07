<?php

include 'dbconnect.php';


header('Content-Type: application/json');

// Function to sanitize input
function sanitize($conn, $input) {
    return mysqli_real_escape_string($conn, $input);
}

// Check request method
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Retrieve products
        if (isset($_GET['id'])) {
            // Retrieve specific product
            $id = sanitize($conn, $_GET['id']);
            $sql = "SELECT * FROM products WHERE id = $id";
        } else {
            // Retrieve all products
            $sql = "SELECT * FROM products";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            echo json_encode($rows);
        } else {
            echo json_encode(array("message" => "No products found."));
        }
        break;
    
    case 'POST':
        // Add new product
        $data = json_decode(file_get_contents("php://input"), true);
        $name = sanitize($conn, $data['name']);
        $description = sanitize($conn, $data['description']);
        $price = sanitize($conn, $data['price']);

        $sql = "INSERT INTO products (name, description, price) VALUES ('$name', '$description', '$price')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array("message" => "Product added successfully."));
        } else {
            echo json_encode(array("message" => "Error: " . $sql . "<br>" . $conn->error));
        }
        break;

    case 'PUT':
        // Update product
        parse_str(file_get_contents("php://input"), $put_vars);
        $id = sanitize($conn, $put_vars['id']);
        $name = sanitize($conn, $put_vars['name']);
        $description = sanitize($conn, $put_vars['description']);
        $price = sanitize($conn, $put_vars['price']);

        $sql = "UPDATE products SET name='$name', description='$description', price='$price' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array("message" => "Product updated successfully."));
        } else {
            echo json_encode(array("message" => "Error updating product: " . $conn->error));
        }
        break;

    case 'DELETE':
        // Delete product
        parse_str(file_get_contents("php://input"), $delete_vars);
        $id = sanitize($conn, $delete_vars['id']);

        $sql = "DELETE FROM products WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array("message" => "Product deleted successfully."));
        } else {
            echo json_encode(array("message" => "Error deleting product: " . $conn->error));
        }
        break;

    default:
        
        echo json_encode(array("message" => "Invalid request method."));
        break;
}


$conn->close();
?>
