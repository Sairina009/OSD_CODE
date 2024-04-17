<?php
// Assuming you have session_start() in your main PHP script
session_start();

// Check if decoder_id is passed via POST request
if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    $conn = mysqli_connect("localhost", "kvm", "kvm2023", "kvm");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch the user authority based on decoder_id
    $query = "SELECT view_only, a1, a2, a3, a4, a5, a6, a7, a8, a9, a10, a11, a12, a13, a14, a15, a16 FROM portname WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $view_only = $row['view_only'];

        // Get the authority column corresponding to the user ID
        $authority_column = 'a' . $_SESSION['id'];
        $authority_value = $row[$authority_column];

        // Create an associative array to hold the authority and view_only values
        $response = array(
            'authority' => $authority_value,
            'view_only' => $view_only
        );

        // Encode the array as JSON and return it
        echo json_encode($response);
    } else {
        echo "Decoder not found";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Decoder ID not provided";
}
?>
