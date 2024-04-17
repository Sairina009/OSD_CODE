<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['folder_path']) && isset($_POST['folder_name'])) {
        $folderPath = $_POST['folder_path'];
        $folderName = $_POST['folder_name'];

        // Output the selected folder name and path
        echo "Selected folder name: $folderName <br>";
        echo "Selected folder path: $folderPath";
    } else {
        echo "No folder selected!";
    }
} else {
    echo "Invalid request method!";
}
?>