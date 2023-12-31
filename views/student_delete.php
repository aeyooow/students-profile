<?php
include_once("../db.php"); // Include the Database class file
include_once("../student.php"); // Include the Student class file
include_once('../student_details.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id']; // Retrieve the 'id' from the URL

    // Instantiate the Database and Student classes
    $db = new Database();
    $student = new Student($db);
    $studentDetails = new StudentDetails($db);

    // Check if the user has confirmed the deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        // User confirmed, perform the deletion
        if ($student->delete($id) && $studentDetails->studentDelete($id)) {
            echo "Record deleted successfully.";
            header("Location: students.view.php");
            exit();
        } else {
            echo "Failed to delete the record or related details.";
        }
    } else {
        // Display a JavaScript confirmation prompt
        echo "<script>
                var userConfirmed = confirm('Are you sure you want to delete this record?');
                if (userConfirmed) {
                    window.location.href = '?id=$id&confirm=yes'; // Confirm, stay on the same page
                } else {
                    window.location.href = 'students.view.php'; // Cancelled, redirect to students.view.php
                }
              </script>";
    }
}
?>
