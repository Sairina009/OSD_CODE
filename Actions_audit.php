<?php
session_start();
require_once 'DBConnection.php';

class Actions extends DB_con {
    function __construct() {
        parent::__construct();
    }

    function __destruct() {
        parent::__destruct();
    }

    function save_log($data = array()) {
        if (count($data) > 0) {
            extract($data);
            if(isset($_SESSION['id'])) {
                $log['user_id'] = $_SESSION['id'];
            } else {
                $log['user_id'] = ''; 
            }
            $log['action_made'] = $action_made;
            $log['event'] = $event;
            $sql = "INSERT INTO `logs` (`user_id`,`action_made`,`event`) VALUES ('{$log['user_id']}','{$log['action_made']}','{$log['event']}')";
            $save = $this->conn->query($sql);
            if (!$save) {
                die($sql . " <br> ERROR:" . $this->conn->error);
            }
        }
        return true;
    }

    function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Sanitize and validate input parameters
            $username = mysqli_real_escape_string($this->conn, $username);
            $password = mysqli_real_escape_string($this->conn, $password);

            // Query to fetch user details
            $query = "SELECT * FROM username WHERE username = '$username'";
            $result = mysqli_query($this->conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                // Verify password
                if (password_verify($password, $user['password'])) {
                    // Set session variables
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['authority'] = $user['authority'];
                    $_SESSION['view'] = $user['view'];

                    // Update user_id in decoder table
                    $user_id = $user['id'];
                    $update_query = "UPDATE decoder SET user_id = '$user_id' WHERE user_id IS NULL LIMIT 1";
                    mysqli_query($this->conn, $update_query);

                    // Log the login action
                    $this->save_log(['action_made' => 'Logged in', 'event' => 'Access Login']);

                    // Redirect to appropriate page
                    if ($user['authority'] == 'Admin') {
                        header("location: " . ($user['view'] == 'OFF' ? 'user.php' : 'demo.php'));
                    } elseif ($user['authority'] == 'User') {
                        header("location: " . ($user['view'] == 'OFF' ? 'onlyuser.php' : 'userdemo.php'));
                    }
                } else {
                    $error = "Invalid username or password.";
                    header("location: index.php?error=$error");
                }
            } else {
                $error = "Invalid username or password.";
                header("location: index.php?error=$error");
            }
        }
    }

    function logout($user_id = '') {
    if(empty($user_id)) {
        if(isset($_SESSION['id'])) {
            $user_id = $_SESSION['id'];
        } else {
            $user_id = ''; 
        }
    }

    // Delete rows from the decoder_status table for the logged-out user
    $sql_delete_status = "DELETE FROM decoder_status WHERE user_id = '{$user_id}'";
    $delete_result_status = $this->conn->query($sql_delete_status);
    if (!$delete_result_status) {
        die("Error deleting user from decoder_status table: " . $this->conn->error);
    }

    // Delete rows from the decoder table for the logged-out user
    $sql_delete_decoder = "DELETE FROM decoder WHERE user_id = '{$user_id}'";
    $delete_result_decoder = $this->conn->query($sql_delete_decoder);
    if (!$delete_result_decoder) {
        die("Error deleting user from decoder table: " . $this->conn->error);
    }

    // Reorder IDs in the decoder_status table
    $sql_reorder = "SET @count = 0";
    $this->conn->query($sql_reorder);

    $sql_update = "UPDATE decoder_status SET id = @count:= @count + 1";
    $update_result = $this->conn->query($sql_update);
    if (!$update_result) {
        die("Error updating IDs in decoder_status table: " . $this->conn->error);
    }

    // Reset auto-increment value for decoder_status table
    $sql_reset_auto_increment = "ALTER TABLE decoder_status AUTO_INCREMENT = 1";
    $reset_result = $this->conn->query($sql_reset_auto_increment);
    if (!$reset_result) {
        die("Error resetting auto-increment value for decoder_status table: " . $this->conn->error);
    }

    // Audit log
    $log['action_made'] = "Logged out.";
    $log['event'] = "Access Logout";
    $this->save_log($log);

    // Destroy session and redirect to index.php
    session_destroy();
    header("location:index.php");
}

}

$a = isset($_GET['a']) ? $_GET['a'] : '';
$action = new Actions();
switch ($a) {
    case 'login':
        echo $action->login();
        break;
    case 'logout':
        echo $action->logout();
        break;
    default:
        echo "No Action given";
        break;
}
?>
