<?php
include('db.php');

// Get form data
$table = $_POST['table']; // Assuming you have a select input in your form to choose the table
$additionalFields = $_POST['additionalFields'];

// Construct the SQL query based on the selected table and additional fields
$query = "INSERT INTO $table (Name";
$values = "(";

// Add additional fields if provided
if (!empty($additionalFields)) {
    foreach ($additionalFields as $fieldName => $fieldValue) {
        if (!empty($fieldValue)) { // Ensure field value is not empty
            $query .= ", $fieldName";
            $values .= ", '$fieldValue'";
        }
    }
}

$query .= ") VALUES $values)";

// Execute the query
if (mysqli_query($connection, $query)) {
    echo "Item added successfully!";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
}

mysqli_close($connection);
?>
