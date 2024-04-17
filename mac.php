<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'kvm';
$encoder_adapter_name = 'VMware Virtual Ethernet Adapter for VMnet1';
function get_encoder_mac() {
    $output = shell_exec('getmac');
    $mac_regex = '/\b([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})\b/';
    preg_match_all($mac_regex, $output, $matches);
        if (!empty($matches[0])) {
        $mac_addresses = $matches[0];
        foreach ($mac_addresses as $mac_address) {
            $output = shell_exec('ipconfig /all');
            $encoder_adapter_name = 'VMware Virtual Ethernet Adapter for VMnet1';
        if (strpos($output, $encoder_adapter_name) !== false) {
                return $mac_address;
            }
        }
    }
    
    return null;
}

function update_mac_address($mac_address) {
    $db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'kvm';
    $connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
    
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $update_query = "UPDATE portname SET macaddr = '$mac_address' WHERE id = 11"; // Assuming encoder ID is 1
    
    if (mysqli_query($connection, $update_query)) {
        echo "MAC address updated successfully.";
    } else {
        echo "Error while updating MAC address: " . mysqli_error($connection);
    }
    
    // Close the database connection
    mysqli_close($connection);
}
while (true) {
    $mac_address = get_encoder_mac();
    
    if ($mac_address) {
        update_mac_address($mac_address);
    }

    sleep(10); 
}