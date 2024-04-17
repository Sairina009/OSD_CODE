<?php
$host = '192.168.0.102'; 
$port = 8080; 
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "Socket creation failed: " . socket_strerror(socket_last_error()) . "\n";
    exit;
}

// Set socket options
socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 0));

// Connect to the target host
$result = socket_connect($socket, $host, $port);
if ($result === false) {
    echo "Port $port is closed or unreachable\n";
    exit;
}
echo "Port $port is open\n";
$connectedAddress = '';
$connectedPort = 0;
socket_getpeername($socket, $connectedAddress, $connectedPort);
echo "Connected to $connectedAddress on port $connectedPort\n";

socket_close($socket);
?>