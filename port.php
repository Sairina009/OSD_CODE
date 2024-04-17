
<?php
require_once 'DBConnection.php';
$fetchdata = new DB_con();

// Fetch hotkey data
$hotkey_sql = $fetchdata->kvmdata();
$hotkey_row = mysqli_fetch_array($hotkey_sql);
$hotkey = isset($hotkey_row['hotkey']) ? $hotkey_row['hotkey'] : '';

// Start session
session_start();

// Define $portLimit with an appropriate value
$portLimit = 3; // Maximum number of connections allowed

// Fetch portname data based on the 'port' parameter from the URL
$portNumber = isset($_GET['port']) ? $_GET['port'] : 1;
$port_sql = $fetchdata->getPortData($portNumber);
$i = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Over IP KVM</title>
</head>

<body>
    <?php
    // Loop through portname data
    while ($result = mysqli_fetch_array($port_sql)) {
        // Check if the keys exist in the $result array before accessing them
        $portname = isset($result['portname']) ? $result['portname'] : '';
        $connect = isset($result['connect']) ? $result['connect'] : '';
        $enableValue = isset($result['enable' . $_SESSION['id']]) ? $result['enable' . $_SESSION['id']] : '';
        $maxConnectionsMessage = $connect >= $portLimit ? 'Maximum connections reached' : '';
        $viewOnlyMessage = ($connect == 1 || $connect == 2) && $_SESSION['id'] != 1 ? 'You can only view the encoder' : '';

        // Disable button and set message if maximum connections reached
        $disabled = $connect >= $portLimit ? 'disabled' : '';
        $connectButtonValue = $connect >= $portLimit ? 'Maximum decoders connected' : 'Connect';

        // Ensure $port_id is defined and not null
        $port_id = isset($result['id']) ? $result['id'] : null;
        if ($port_id !== null) {
            // Fetch the authority based on the user ID
            $result1 = mysqli_query($fetchdata->conn, "SELECT * FROM portname WHERE id='$port_id'");
            $row = mysqli_fetch_assoc($result1);
            $user_id = (int)$_SESSION['id'];
            $authority = isset($row["a$user_id"]) ? $row["a$user_id"] : ''; // Handle authority
        } else {
            // Handle the case where $port_id is null
            $authority = ''; // or any other appropriate default value
        }

        // Fetch the decoder_id based on user_id
        $user_id = (int)$_SESSION['id'];
        $decoder_count_query = mysqli_query($fetchdata->conn, "SELECT decoder_count FROM decoder WHERE user_id = '$user_id'");
        if ($decoder_count_query) {
            $decoder_count_row = mysqli_fetch_assoc($decoder_count_query);
            $decoder_id = isset($decoder_count_row['decoder_count']) ? $decoder_count_row['decoder_count'] : ''; // Handle decoder_id
        } else {
            // Handle the case where the query failed
            $decoder_id = ''; // or any other appropriate default value
        }

        // Display hotkey
        if ($hotkey == '< Caps Lock>') {
            include 'caps.html';
        } elseif ($hotkey == '< Ctrl>') {
            include 'key.html';
        } else {
            echo 'scroll';
        }

        // Display portname data
    ?>
        <div class="image-container">
            <img src="view_thumbnail.php?id=<?php echo $result['id']; ?>&timestamp=<?php echo time(); ?>" alt="<?php echo $result['image_name']; ?>" style="width: 1800px; height: 730px; margin-bottom: 20px;" class="button connect-button" data-id="<?php echo $result['id']; ?>" onclick="connectToIndex(<?php echo $result['id']; ?>, '<?php echo $authority; ?>', '<?php echo $decoder_id; ?>')" <?php echo $disabled; ?><?php if ($enableValue == '') echo ' disabled'; ?>>
        </div>
    <?php
    }
    ?>
    <script type="text/javascript">
        function connectToIndex(id, authority, decoder_id) {
            console.log("Button clicked with id: " + id + ", authority: " + authority + ", decoder_id: " + decoder_id);
            updateDatabase(id);

            // Send an AJAX request to check the user's authority status
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'check_authority.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    console.log("Response:", response);

                    // Extract authority and view_only from the response
                    var userAuthority = response.authority;
                    var viewOnly = response.view_only;

                    console.log("Authority: " + userAuthority + ", View Only: " + viewOnly);

                    // Check authority and view_only to determine access
                    if ((userAuthority === "Share" && viewOnly === "0") || (userAuthority === "View" && viewOnly === "0")) {
                        // If user has Share authority and view_only is 0, or View authority and view_only is 0, proceed to index.html
                        console.log("User has full access. Redirecting to index.html.");
                        window.location.href = "index.html?id=" + id + "&decoder_id=" + decoder_id;
                    } else if (viewOnly === "1" || viewOnly === "2") {
                        // If view_only is 1, block access
                        console.log("User has full access. Redirecting to index.html.");
                        window.location.href = "index.html?id=" + id + "&decoder_id=" + decoder_id;
                    } else {
                        // For all other cases, block access
                        console.log("Access blocked.");
                        alert("You do not have access.");
                    }
                }
            };

            xhr.send('id=' + id + '&authority=' + authority + '&decoder_id=' + decoder_id);
        }

        // Function to update data in the database
        function updateDatabase(id) {
            // Additional data to pass to the PHP script
            var data = new FormData();
            data.append('id', id); // Assuming port_id corresponds to the 'id' field in the database
            data.append('save', 'true'); // Adding this line to indicate saving

            // Send an AJAX request to update the database
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'uheader.php', true); // Specify the PHP script to handle database update
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = xhr.responseText;
                    //console.log("Response from uheader.php:", response);

                    // Handle response if needed
                }
            };
            // Send the data to the PHP script
            xhr.send(data);
            }
        
    </script>
</body>
</html>
