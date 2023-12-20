<?php
include_once("../db.php"); // Include the Database class file
include_once("../province.php"); // Include the Province class file

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id']; // Retrieve the 'id' from the URL

    // Instantiate the Database and Province classes
    $db = new Database();
    $prov = new Province($db);

    // Check if the user has confirmed the deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        // User confirmed, perform the deletion
        if ($prov->delete($id)) {
            echo "Record deleted successfully.";
            header("Location: province.view.php");
            exit(); // Make sure to exit to prevent further execution
        } else {
            echo "Failed to delete the record.";
        }
    } else {
        // Display a JavaScript confirmation prompt
        echo "<script>
                var userConfirmed = confirm('Are you sure you want to delete this record?');
                if (userConfirmed) {
                    window.location.href = '?id=$id&confirm=yes'; // Confirm, stay on the same page
                } else {
                    window.location.href = 'province.view.php'; // Cancelled, redirect to province.view.php
                }
              </script>";
    }
}
?>
