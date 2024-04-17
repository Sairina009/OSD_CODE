<?php 
include_once 'cachestart.php';
require_once 'uheader.php';

// Fetch banner information from the database
$banner_query = mysqli_query($kvmdata->conn, "SELECT * FROM kvmname where id=1");
$banner_info = mysqli_fetch_assoc($banner_query);
$banner = $banner_info['banner'];
$bannertime = $banner_info['bannertime'];

// Convert bannertime to seconds
$bannertimeInSeconds = $bannertime; // Assuming bannertime is in minutes, convert it to seconds

$sql = $kvmdata->user();
$i = 0; 
while ($result = mysqli_fetch_array($sql)) {
    $portname = $result['portname'];
    $connect = $result['connect']; 
    $portLimit = 3; // Maximum number of connections allowed
    $enableValue = $result['enable' . $_SESSION['id']];
    $maxConnectionsMessage = '';
    $viewOnlyMessage = '';
  $disabled = $connect >= $portLimit ? 'disabled' : '';
    // Display maxConnectionsMessage and viewOnlyMessage only if the banner is active
    if ($banner == "ON") {
        // Logic for maximum connections reached message
        if ($connect >= $portLimit) {
            $maxConnectionsMessage = 'Channel Occupy';
        }
        
        // Logic for view only message
        if (($connect == 1 || $connect == 2) && $_SESSION['id'] != 1) {
            $viewOnlyMessage = 'You can only view the encoder';
        }
    }

    // Ensure $port_id is defined and not null
    $port_id = isset($result['id']) ? $result['id'] : null;
    if ($port_id !== null) {
        // Fetch the authority based on the user ID
        $result1 = mysqli_query($kvmdata->conn, "SELECT * FROM portname WHERE id='$port_id'");
        $row = mysqli_fetch_assoc($result1);
        $user_id = (int)$_SESSION['id'];
        $authority = isset($row["a$user_id"]) ? $row["a$user_id"] : ''; // Handle authority
    } else {
        // Handle the case where $port_id is null
        $authority = ''; // or any other appropriate default value
    }

    // Fetch the decoder_id based on user_id
    $user_id = (int)$_SESSION['id'];
    $decoder_count_query = mysqli_query($kvmdata->conn, "SELECT decoder_count FROM decoder WHERE user_id = '$user_id'");
    if ($decoder_count_query) {
        $decoder_count_row = mysqli_fetch_assoc($decoder_count_query);
        $decoder_id = isset($decoder_count_row['decoder_count']) ? $decoder_count_row['decoder_count'] : ''; // Handle decoder_id
    } else {
        // Handle the case where the query failed
        $decoder_id = ''; // or any other appropriate default value
    }

    ?>
    <form action="" method="post" name="form<?php echo $i; ?>" id="form<?php echo $i; ?>">
        <tr align=center>
            <td style="padding:10px">
                <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                <?php echo $result['id']; ?>
            </td>
            <td><?php echo $result['scan' . $_SESSION['id']]; ?></td>
            <td>
                <?php echo $portname; ?>
                <?php if ($banner == "ON"): ?>
                    <?php if (!empty($maxConnectionsMessage)): ?>
                        <br>
                        <span id="maxConnections_<?php echo $i; ?>" style="color: red;"><?php echo $maxConnectionsMessage; ?></span>
                        <script>
                            setTimeout(function() {
                                document.getElementById("maxConnections_<?php echo $i; ?>").innerHTML = "";
                            }, <?php echo $bannertimeInSeconds * 1000; ?>);
                        </script>
                    <?php elseif (!empty($viewOnlyMessage)): ?>
                        <br>
                        <span id="viewOnly_<?php echo $i; ?>" style="color: blue;"><?php echo $viewOnlyMessage; ?></span>
                        <script>
                            setTimeout(function() {
                                document.getElementById("viewOnly_<?php echo $i; ?>").innerHTML = "";
                            }, <?php echo $bannertimeInSeconds * 1000; ?>);
                        </script>
                    <?php endif; ?>
                <?php endif; ?>
            </td> <!-- Display portname with max connections or view-only message -->
            <td><?php echo $result['type']; ?></td>
            <td><?php echo $result['pc_online']; ?></td> <!-- Display PC online status -->
            <td>
                <input type="button" class="button" name="save" value="Connect" onclick="connectToIndex(<?php echo $result['id']; ?>, '<?php echo $authority; ?>', '<?php echo $decoder_id; ?>')" <?php echo $disabled; ?> <?php if ($enableValue == '') echo ' disabled'; ?>>
            </td>
        </tr>
        <input type="hidden" name="portname" value="<?php echo $portname; ?>"> <!-- Hidden portname field -->
        <input type="hidden" id="decoder_id_<?php echo $i; ?>" name="decoder_id" value="<?php echo $decoder_id; ?>"> <!-- Hidden decoder_id field -->
    </form>
    <?php 
    $i++; 
} 
?>

</table>
<br>
<script type="text/javascript">
function connectToIndex(id, authority, decoder_id) {
    console.log("Button clicked with id: " + id + ", authority: " + authority + ", decoder_id: " + decoder_id); 
 updateDatabase(id);
    
    // Send an AJAX request to check the user's authority status
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'check_authority.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
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
            } else if (viewOnly === "1" || viewOnly === "2" ) {
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
    xhr.onreadystatechange = function () {
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

<?php 
require_once 'userfooter.php';
include_once 'cacheend.php';
?>
</body>
</html>
