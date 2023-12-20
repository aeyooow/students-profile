<?php
include_once("../db.php"); // Include the Database class file
include_once("../town_city.php"); // Include the TownCity class file

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id']; // Retrieve the 'id' from the URL

    // Instantiate the Database and TownCity classes
    $db = new Database();
    $town = new TownCity($db);

    // Check if the user has confirmed the deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        // User confirmed, perform the deletion
        if ($town->delete($id)) {
            echo "Record deleted successfully.";
            header("Location: town_city.view.php");
            exit();
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
                    window.location.href = 'town_city.view.php'; // Cancelled, redirect to town_city.view.php
                }
              </script>";
    }
}
?>
