<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $interface = $_POST['interface'];
    $newMac = $_POST['new_mac'];
    $command = "sudo ifconfig $interface down && sudo ifconfig $interface hw ether $newMac && sudo ifconfig $interface up";
    exec($command, $output, $returnVar);
if ($returnVar === 0) {
        $message = "MAC address changed successfully.";
    } else {
        $message = "Error while changing MAC address.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change MAC Address</title>
</head>
<body>
    <h1>Change MAC Address</h1>
    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="interface">Interface:</label>
        <input type="text" name="interface" id="interface" required>
        <label for="new_mac">New MAC Address:</label>
        <input type="text" name="new_mac" id="new_mac" required>
        <button type="submit">Change MAC Address</button>
    </form>
</body>
</html>
<?php
exec('sudo ip link set dev lo down');
exec('sudo macchanger -m XX:XX:XX:XX:XX:XX lo');
// Replace XX:XX:XX:XX:XX:XX with the desired MAC address you want to assign to the loopback interface

// Enable the loopback interface again
exec('sudo ip link set dev lo up');
?>