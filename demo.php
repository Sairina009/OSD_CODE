<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$current_page = isset($_SESSION['current_page']) ? $_SESSION['current_page'] : 1;

require_once 'header.php';
include_once 'cachestart.php';

if (isset($_POST['id'])) {
    $i = 0;
    $imageId = $_POST['id'];
    $sql = $updatedata->connect($imageId, $value);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['PAGETITLE']; ?></title>
    <style type="text/css">
         #videoOG {
            position: fixed;
            z-index: -1;
        }
        #display {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-left: 69px;
            margin-top: -790px;
        }
        .image-container {
            position: relative;
            width: calc(25% - 15px); 
            box-sizing: border-box;
        }
        .image-info {
            position: absolute;
            bottom: 50px;
            left: 115px;
            background: rgba(255, 255, 255, 0.8);
            padding: 5px;
            
        }
        .max-connections-message {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 0, 0, 0.5);
            color: white;
            padding: 5px;
            border-radius: 5px;
            display: none;
        }
    </style>
</head>

<body>
    <div id="display">
        <?php
        $i = 0; 
        require_once 'DBConnection.php';
        $kvmdata = new DB_con();
        $sql = $kvmdata->user();
        
        $user_id = (int)$_SESSION['id'];
        $decoder_count_query = mysqli_query($kvmdata->conn, "SELECT decoder_count FROM decoder WHERE user_id = '$user_id'");
        $decoder_count_row = mysqli_fetch_assoc($decoder_count_query);
        $decoder_id = $decoder_count_row['decoder_count'];

        while ($data = mysqli_fetch_array($sql)) {
            $thumbnailId = $data['id'];
            $thumbnailName = $data['image_name'];
            $screenName = $data['portname'];
            $screenType = $data['type'];
            $connectionStatus = $data['pc_online'];
            $connect = $data['connect']; 
            $maxConnectionsMessage = "Maximum connections reached";

            // Determine if the image click should be disabled
            $disableClick = $connect >= 3 ? 'pointer-events: none;' : '';
            // Message to display if maximum connections reached
            $maxConnectionsMessage = $connect >= 3 ? '<span class="max-connections-message">Maximum connections reached</span>' : '';

            $i++; // Increment $i for each iteration
            
            ?>
            <div class="image-container">
                <!-- Modify the image container to include a connect button -->
                <img src='view_thumbnail.php?id=<?php echo $thumbnailId; ?>&timestamp=<?php echo time(); ?>' alt='<?php echo $thumbnailName; ?>' style="width: 95%; height: auto; margin-bottom: 20px; <?php echo $disableClick; ?>" class="button connect-button" data-id="<?php echo $thumbnailId; ?>" onclick="connectToIndex(<?php echo $thumbnailId; ?>)">
               <!-- Display max connections message if applicable -->
                <div class="image-info">
                    <p>Encoder Name:<?php echo $screenName; ?></p>
                    <p>Connection Type: <?php echo $screenType; ?></p>
                    <p>Status: <?php echo $connectionStatus; ?></p>
                     <p>Connection: <?php echo $maxConnectionsMessage; ?> </p>
                </div>
            </div>
            <!-- Add hidden input field for decoder_id with unique ID -->
            <input type="hidden" id="decoder_id_<?php echo $i; ?>" name="decoder_id" value="<?php echo $decoder_id; ?>">
        <?php
        }
        ?>
    </div>
    <script type="text/javascript" src="/public/jsmpeg.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <div class="page-content container">
        <div id="remoteVideos" oncontextmenu="return false;" style="display: none;">
            <canvas class="camera" id="videoCanvas"></canvas>
            <div id="canvasButtonContainer">
                <button class="button" id="closeBtn" onclick="closeCanvas()">Close</button>
            </div>
        </div>
    </div>
<script type="text/javascript">
    function connectToIndex(id) {
        var decoder_id = document.getElementById('decoder_id_' + id).value; // Fetch the decoder_id from the hidden input field
        console.log("Button clicked with id: " + id + ", decoder_id: " + decoder_id);
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
                    window.location.href = "index.html?id=" + id + "&decoder_id=" + decoder_id; // Pass decoder_id as URL parameter
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
        xhr.send('id=' + id); // Send id and decoder_id in the request body
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
    function startStream(thumbnailId) {
        $.ajax({
            type: "GET",
            url: "view_thumbnail.php?id=" + thumbnailId + "&timestamp=" + new Date().getTime(),
            success: function(data) {
                  $("#image-container").html('<img src="data:image/png;base64,' + data + '" />');
            },
            error: function(xhr, status, error) {
                console.error("Ajax request failed:", status, error);
            }
        });
    }

    function closeCanvas() {
            document.getElementById("remoteVideos").style.display = "none";
            canvasVisible = false;
             if (player) {
                player.stop();
            }
            if (ws && ws.readyState === WebSocket.OPEN) {
                ws.close();
            }
        }
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
   function refreshThumbnails() {
        $.ajax({
            type: "GET",
            url: "refresh_thumbnails.php", 
            success: function(data) {
                $("#display").html(data);
            }
        });
    }

    var refreshRate = 5000; 
    var refreshInterval = setInterval(refreshThumbnails, refreshRate);

    function stopRefresh() {
        clearInterval(refreshInterval);
    }

    window.addEventListener("beforeunload", stopRefresh);

</script>

    <?php
    require_once 'demofooter.php';
    include_once 'cacheend.php';
    ?>
</body>

</html>
