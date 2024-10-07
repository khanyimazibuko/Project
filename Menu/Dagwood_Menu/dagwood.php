<?php
// get_item.php

// Include the database connection file
include 'db_connect.php';
header("Access-Control-Allow-Origin: *");
// Check if 'id' parameter is passed via the URL
if (isset($_GET['id'])) {
    // Get the 'id' from the URL
    $id = intval($_GET['id']);
    
    // Prepare the SQL query to select the item from the database
    $sql = "SELECT description, price FROM dagwood WHERE id = ?";
    
    // Initialize the prepared statement
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Bind the parameter to the SQL query
        $stmt->bind_param('i', $id);
        
        // Execute the prepared statement
        $stmt->execute();
        
        // Bind the result to variables
        $stmt->bind_result($description, $price);
        
        // Fetch the result
        if ($stmt->fetch()) {
            // If an item is found, return the result as JSON
            $response = [
                'status' => 'success',
                'description' => $description,
                'price' => $price
            ];
        } else {
            // If no item is found, return an error message
            $response = [
                'status' => 'error',
                'message' => 'Item not found'
            ];
        }
        
        // Close the statement
        $stmt->close();
    } else {
        // Handle the case where the SQL query fails to prepare
        $response = [
            'status' => 'error',
            'message' => 'Query preparation failed'
        ];
    }
    
    // Close the database connection
    $conn->close();
    
    // Return the response in JSON format
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If 'id' parameter is not passed, return an error message
    $response = [
        'status' => 'error',
        'message' => 'No ID provided'
    ];
    
    // Return the response in JSON format
    header('Content-Type: application/json');
    echo json_encode($response);
}

?>