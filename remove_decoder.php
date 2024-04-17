<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection parameters
    $host = "localhost";
    $user = "kvm";
    $password = "kvm2023";
    $dbname = "kvm";

    // Connect to the database
    $conn = mysqli_connect($host, $user, $password, $dbname);

    // Check connection
    if (!$conn) {
        echo "Error connecting to the database: " . mysqli_connect_error();
        exit;
    }

    // Process POST data
    $portname = $_POST['portname'];
    $id = $_POST['id'];
    $decoder_id = $_POST['decoder_id'];

    // Update portname connect count
    $update_query = "UPDATE portname SET connect = connect - 1 WHERE id = '$id'";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo "Portname connect count updated successfully. ";
    } else {
        echo "Error updating the connect count: " . mysqli_error($conn);
        exit;
    }

    // Update view_only value
    $select_query = "SELECT view_only FROM portname WHERE id = '$id'";
    $select_result = mysqli_query($conn, $select_query);

    if ($select_result) {
        $row = mysqli_fetch_assoc($select_result);
        $view_only = $row['view_only'];
        
        // Update view_only based on the condition
        if ($view_only == 2 || $view_only == 1) {
            $new_view_only = $view_only - 1;
            $update_view_query = "UPDATE portname SET view_only = '$new_view_only' WHERE id = '$id'";
            $update_view_result = mysqli_query($conn, $update_view_query);

            if ($update_view_result) {
                echo "View_only value updated successfully.";
            } else {
                echo "Error updating the view_only value: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Error selecting view_only value: " . mysqli_error($conn);
    }

    // Remove decoder from connect table
    $delete_query = "DELETE FROM connect WHERE decoder_id = $decoder_id";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        echo "Decoder removed successfully";
    } else {
        echo "Error removing decoder: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    echo "Invalid request";
}
?>
