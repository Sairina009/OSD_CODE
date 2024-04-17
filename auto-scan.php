<?php
function scanPort($port) {
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    $result = socket_connect($socket, '127.0.0.1', $port);

    if ($result === false) {
        echo "Port $port is closed.\n";
    } else {
        echo "Port $port is open.\n";
    }

    socket_close($socket);
}
for ($port = 1; $port <= 32; $port++) {
    scanPort($port);
}
?>