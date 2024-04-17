<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (!defined('host')) { define('host', "localhost"); }
if (!defined('username')) { define('username', "kvm"); }
if (!defined('password')) { define('password', "kvm2023"); }
if (!defined('db_tbl')) { define('db_tbl', "kvm"); }
Class DB_con
{
   
    public $conn;
    public $error;
    function __construct()
    {
        $this->conn = new mysqli(host, username, password, db_tbl);
        if (!$this->conn) {
            die("Database Connection Error. ".$this->conn->error);
        }
    }
    function __destruct()
    {
         $this->conn->close();
    }
 
public function logindata($username, $password) {
    $result = mysqli_query($this->conn, "SELECT * FROM username WHERE username ='$username' AND password='$password'");
    $result1 = mysqli_fetch_object($result);
    $result3 = mysqli_query($this->conn, "SELECT * FROM `portname`");
    $result2 = mysqli_fetch_object($result3);
    $count = mysqli_num_rows($result);

    if ($count > 0) { 
        if ($result1->active == '1' && $result1->id) {
            // Set session variables
            $_SESSION['id'] = $result1->id;
            $_SESSION['username'] = $result1->username;

            $active_decoders_count = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM decoder_status WHERE user_id IS NOT NULL"));

            if ($active_decoders_count < 4) {
                // Log in the user directly
                $this->logUserIn($result1->id); 

                $_SESSION['authority'] = $result1->authority;
                $_SESSION['view'] = $result1->view;
                $_SESSION['enable1'] = $result2->enable1;
                $_SESSION['enable2'] = $result2->enable2;
                $_SESSION['enable3'] = $result2->enable3;
                $_SESSION['enable4'] = $result2->enable4;
                $_SESSION['enable5'] = $result2->enable5;
                $_SESSION['enable6'] = $result2->enable6;
                $_SESSION['enable7'] = $result2->enable7;
                $_SESSION['enable8'] = $result2->enable8;
                $_SESSION['enable9'] = $result2->enable9;
                $_SESSION['enable10'] = $result2->enable10;
                $_SESSION['enable11'] = $result2->enable11;
                $_SESSION['enable12'] = $result2->enable12;
                $_SESSION['enable13'] = $result2->enable13;
                $_SESSION['enable14'] = $result2->enable14;
                $_SESSION['enable15'] = $result2->enable15;
                $_SESSION['enable16'] = $result2->enable16;

                // Update decoder table
                $decoder_name = ''; // Set to default or fetch from user data
                $user_authority = ''; // Set to default or fetch from user data
                $this->updateDecoderTable($decoder_name, $username, $user_authority);

                if ($result1->authority == 'Admin') {
                    if ($result1->view == 'OFF') {
                        header("location: user.php");
                    } else {
                        header("location: demo.php");
                    }
                } elseif ($result1->authority == 'User') {
                    if ($result1->view == 'OFF') {
                        header("location: user.php");
                    } else {
                        header("location: demo.php");
                    }
                }
            } else {
                // Add user to waiting list
                $this->addToWaitingList($result1);
                echo $error = "Maximum number of active sessions reached. You have been added to the waiting list.";
                return $error;
            }
        } elseif ($result1->active == '0') {
            echo $error = "User is disabled";
            return $error;
        } else {
            $error = "Invalid Username and Password";
            return $error;
        } 
    } else {
        $error = "Invalid Username and Password";
        return $error;
    }
}

private function updateDecoderTable($username, $user_authority) {
    // Get the current number of rows in the decoder table
    $decoder_count_query = "SELECT COUNT(*) AS decoder_count FROM decoder";
    $decoder_count_result = mysqli_query($this->conn, $decoder_count_query);
    $decoder_count_row = mysqli_fetch_assoc($decoder_count_result);
    $decoder_count = $decoder_count_row['decoder_count'] + 1;

    // Limit the insertion to only 4 rows
    if ($decoder_count <= 4) {
        // Insert data into the decoder table with blank values for other columns
        $login_time = date("Y-m-d H:i:s");
        $insert_query = "INSERT INTO decoder (decoder_count, ip_address, encoder_id, decoder_name, decoder_type, user_id, mac_address, banner, thumbnailview, lastupdatedby, user_authority) 
                         VALUES ('$decoder_count', '', '1', '$username', '', '{$_SESSION['id']}', '', '', '', '$login_time', '')";
        $result = mysqli_query($this->conn, $insert_query);
        if (!$result) {
            die(mysqli_error($this->conn)); // Output any error that occurs
        }
    } else {
        echo "Maximum number of decoders reached.";
    }
}


public function logUserIn($user_id) {
    // Get the next available decoder_id
    $next_decoder_query = "SELECT MAX(decoder_id) AS max_decoder_id FROM decoder_status";
    $next_decoder_result = mysqli_query($this->conn, $next_decoder_query);
    $next_decoder_row = mysqli_fetch_assoc($next_decoder_result);
    $next_decoder_id = $next_decoder_row['max_decoder_id'] + 1;

    // Insert the login record with the next decoder_id
    $login_time = date("Y-m-d H:i:s");
    $query = "INSERT INTO decoder_status (decoder_id, user_id, login_time) VALUES ('$next_decoder_id', '$user_id', '$login_time')";
    mysqli_query($this->conn, $query);

    // Update the decoder table with the user's ID and assigned decoder_id
    $update_query = "UPDATE decoder SET user_id = '$user_id', decoder_id = '$next_decoder_id' WHERE decoder_count = '$next_decoder_id'";
    mysqli_query($this->conn, $update_query);

    // Log the login action
    $log['action_made'] = "Logged in.";
    $log['event'] = "Access Login";
    $this->save_log($log);
}

private function save_log($data = array()) {
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

private function addToWaitingList($user) {
    // Add user to waiting list
    $login_time = date("Y-m-d H:i:s");
    mysqli_query($this->conn, "INSERT INTO waiting_list (user_id, login_time) VALUES ('$user->id', '$login_time')"); // Fix accessing object properties
}
    public function audit()
    {
        $per_page_record = 15;        
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
            $page=1;    
        }    
        $start_from = ($page-1) * $per_page_record;     
        $result1=mysqli_query($this->conn, "SELECT l.*,u.username FROM `logs` l inner join username u on l.user_id = u.id LIMIT $start_from, $per_page_record"); 
        return $result1;
    }
    public function port()
    {
        $per_page_record = 8;          
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
            $page=1;    
        }    
        $start_from = ($page-1) * $per_page_record;     
        $result1=mysqli_query($this->conn, "SELECT * FROM portname LIMIT $start_from, $per_page_record");
        return $result1;
    }
    public function portcount()
    {
        $result1=mysqli_query($this->conn, "SELECT COUNT(*) FROM portname");
        return $result1;
    }
    public function logcount()
    {
        $result1=mysqli_query($this->conn, "SELECT COUNT(*) FROM logs");
        return $result1;
    }
    public function upgradecount()
    {
        $result1=mysqli_query($this->conn, "SELECT COUNT(*) FROM upgradehistory");
        return $result1;
    }
    public function audio()
    {
        $per_page_record = 8;          
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
            $page=1;    
        }    
        $start_from = ($page-1) * $per_page_record;      
        $result1=mysqli_query($this->conn, "SELECT audio, format, portname, id FROM portname LIMIT $start_from, $per_page_record");
        return $result1;
    }
    public function resolution()
    {
        $per_page_record = 8;          
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
            $page=1;    
        }    
        $start_from = ($page-1) * $per_page_record;     
        $result1=mysqli_query($this->conn, "SELECT resolution, portname, id, framerate FROM portname LIMIT $start_from, $per_page_record");
        return $result1;
    }
    public function link()
    {
        $per_page_record = 8;          
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
            $page=1;    
        }    
        $start_from = ($page-1) * $per_page_record;      
        $result1=mysqli_query($this->conn, "SELECT linktype, portname, id FROM portname LIMIT $start_from, $per_page_record");
        return $result1;
    }
    public function dongle()
    {
        $per_page_record = 8;          
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
            $page=1;    
        }    
        $start_from = ($page-1) * $per_page_record;      
        $result1=mysqli_query($this->conn, "SELECT id , portname, version, path FROM portname LIMIT $start_from, $per_page_record");
        return $result1;
    }
    public function virtual()
    {
        $per_page_record = 8;          
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
            $page=1;    
        }    
        $start_from = ($page-1) * $per_page_record;     
        $result1=mysqli_query($this->conn, "SELECT id , portname, media FROM portname LIMIT $start_from, $per_page_record");
        return $result1;
    }
    public function portenable()
    {
        $per_page_record = 8;          
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
            $page=1;    
        }    
        $start_from = ($page-1) * $per_page_record;     
        $result1=mysqli_query($this->conn, "SELECT * FROM portname LIMIT $start_from, $per_page_record");
        return $result1;
    }
    public function user()
    {
        $per_page_record = 8;          
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
            $page=1;    
        }    
        $start_from = ($page-1) * $per_page_record;     
        $result1=mysqli_query($this->conn, "SELECT * from portname LIMIT $start_from, $per_page_record");
        return $result1;
    }
      public function macadd()
    {
        $per_page_record = 8;          
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
            $page=1;    
        }    
        $start_from = ($page-1) * $per_page_record;      
        $result1=mysqli_query($this->conn, "SELECT id , portname, macaddr FROM portname LIMIT $start_from, $per_page_record");
        return $result1;
    }
    public function upgradehistory()
    {
        $per_page_record = 15;          
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
            $page=1;    
        }    
        $start_from = ($page-1) * $per_page_record;     
        $result1=mysqli_query($this->conn, "SELECT type , user , starttime, endtime ,perversion, upgradeversion, result from upgradehistory LIMIT $start_from, $per_page_record");
        return $result1;
    }
    public function scan()
    {
        $per_page_record = 8;          
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
            $page=1;    
        }    
        $start_from = ($page-1) * $per_page_record;      
        $result1=mysqli_query($this->conn, "SELECT * FROM portname  LIMIT $start_from, $per_page_record");
        return $result1;
    }
    public function userport()
    {
        $result =mysqli_query($this->conn, "SELECT * FROM `username` INNER JOIN `portname` ON username.id = portname.id where portname.id<=8");
        return $result;
    }
    public function portdata()
    {
        $result1=mysqli_query($this->conn, "SELECT id , type , portname , media, linktype,resolution,audio ,format,macaddr from portname where id<=8");
        return $result1;
        $this->conn->close();
    }
    public function thumbnailview()
    {
        $per_page_record = 8;          
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
            $page=1;    
        }    
        $start_from = ($page-1) * $per_page_record;      
        $result1=mysqli_query($this->conn, "SELECT thumbnail FROM portname  LIMIT $start_from, $per_page_record");
        return $result1;
    }
public function getPortData($portNumber)
{
    $query = "SELECT * FROM portname WHERE id = $portNumber";
    $result = mysqli_query($this->conn, $query);

    if (!$result) {

        return false;
    }
return $result;
   $this->conn->close();
}
    public function caps()
    {
        $query = mysqli_query($this->conn,"UPDATE `kvmname` SET `hotkey`='< Caps Lock>' WHERE id='1'");
        return $query;
      
    }
    public function thumb($value, $id)
    {
        $query = mysqli_query($this->conn,"UPDATE `portname` SET `thumbnail`='$value' WHERE id='$id'");
        return $query;
      
    }
    public function control()
    {
        $query = mysqli_query($this->conn,"UPDATE `kvmname` SET `hotkey`='< Ctrl>' WHERE id='1'");
       
        return $query;
        
    }
    public function scroll()
    {
        $query = mysqli_query($this->conn,"UPDATE `kvmname` SET `hotkey`='< Scroll Lock>' WHERE id='1'");
        return $query;
    }
    public function english()
    {
        $query = mysqli_query($this->conn,"UPDATE `kvmname` SET `language`='English' WHERE id='1'");
        return $query;
    }
    public function french()
    {
        $query = mysqli_query($this->conn,"UPDATE `kvmname` SET `language`='French' WHERE id='1'");
        return $query;
    }
    public function german()
    {
        $query = mysqli_query($this->conn,"UPDATE `kvmname` SET `language`='German' WHERE id='1'");
        return $query;
    }
    public function portupdate($value , $value1,$id)
    {
        $query = mysqli_query($this->conn, "UPDATE `portname` SET `audio`='$value', format='$value1' , lastUpdatedBy=NOW() WHERE id='$id'"); 
        return $query;
        $this->conn->close();
    }
    public function virtualupdate($path , $id)
    {
        $query = mysqli_query($this->conn,"UPDATE `portname` SET `media`='$path', lastUpdatedBy=NOW() WHERE id='$id'");
        return $query;
    }
    public function portenableupdate($value, $id, $u)
    {
        $query = "UPDATE `portname` SET `enable$u`='$value' WHERE id='$id'";
        $result = mysqli_query($this->conn, $query);
        
        if (!$result) {
             echo "Update query failed: " . mysqli_error($this->conn);
            return false;
        }
        
        return $result;
    }
    
    public function scanupdate($value , $id , $u)
    {
        $query = mysqli_query($this->conn,"UPDATE `portname` SET `scan$u`='$value' WHERE id='$id'");
        return $query;
    }
    public function portautupdate($value , $id , $u)
    {
        $query = mysqli_query($this->conn,"UPDATE `portname` SET `a$u`='$value' WHERE id='$id'");
        return $query;
    }


    public function connect($user_id, $portname, $decoder_name, $id, $username) {
    
    $port_id = $id;

    // Fetch the decoder count based on the user_id
    $decoder_count_query = mysqli_query($this->conn, "SELECT decoder_count, decoder_name FROM decoder WHERE user_id = '$user_id'");
    $decoder_count_row = mysqli_fetch_assoc($decoder_count_query);
    $decoder_id = $decoder_count_row['decoder_count'];
        $decoder_name = $decoder_count_row['decoder_name'];

    // Fetch the maximum decoder ID from the connect table
    $max_decoder_query = mysqli_query($this->conn, "SELECT MAX(decoder_id) AS max_id FROM connect");
    $max_decoder_row = mysqli_fetch_assoc($max_decoder_query);
    $max_decoder_id = $max_decoder_row['max_id'];
    $next_decoder_id = $max_decoder_id + 1; // Increment the maximum decoder ID by 1

    // Check if connect is less than 3
    $result = mysqli_query($this->conn, "SELECT * FROM connect WHERE port_id='$port_id'");

    if (!$result) {
        echo "Error: " . mysqli_error($this->conn); // Log MySQL error
        return false; // Handle database query error
    }

    $connect_count = mysqli_num_rows($result);

    $result1 = mysqli_query($this->conn, "SELECT * FROM portname WHERE id='$port_id'");
    $row = mysqli_fetch_assoc($result1);
    $connect = $row['connect'];
    $user_id = (int)$user_id;
    $authority = $row["a$user_id"];

    if ($connect_count < 3) {
        $connect += 1;

        // Insert into connect table with the next available decoder ID
        $insertQuery = mysqli_query($this->conn, "INSERT INTO connect (port_id, portname, decoder_name, username, user_id, decoder_id, count, user_authority, created_at) VALUES ('$port_id', '$portname', '$decoder_name', '$username', '$user_id', '$decoder_id', '$connect', '$authority', CURRENT_TIMESTAMP)");

        if (!$insertQuery) {
            echo "Error inserting into connect table: " . mysqli_error($this->conn); // Log MySQL error
            return false; // Handle database query error
        } else {
            echo "Inserted into connect table successfully"; // Log success
        }

        if ($connect == 1) {
            // First decoder accessing the encoder
            echo "First decoder accessing the encoder";
            // Implement access logic for the first decoder here
            // For example, grant full access to the encoder

            // Update portname status for admin user with full access
 $updateQuery = mysqli_query($this->conn, "UPDATE portname SET status='busy', connect = $connect, decoder_name='$decoder_name', decoder_count='$decoder_id', view_only='0' WHERE id='$port_id'");
             $updateDecoderQuery = mysqli_query($this->conn, "UPDATE decoder SET encoder_id='$port_id' WHERE decoder_count='$decoder_id'");
   
            
            if (!$updateQuery && !$updateDecoderQuery) {
                echo "Error updating portname: " . mysqli_error($this->conn); // Log MySQL error
                return false; // Handle database query error
            } else {
                echo "Portname updated with full access for admin successfully"; // Log success
            }
        } elseif ($connect == 2) {
            // Second or third decoder accessing the encoder
            echo "Second or third decoder accessing the encoder";
            // Implement access logic for the second and third decoders here
            // For example, grant view-only access to the encoder
            
                // Update portname status with view_only
                $updateQuery = mysqli_query($this->conn, "UPDATE portname SET status='busy', connect = $connect, decoder_name='$decoder_name', decoder_count='$decoder_id', view_only='1' WHERE id='$port_id'");
                
                if (!$updateQuery) {
                    echo "Error updating portname: " . mysqli_error($this->conn); // Log MySQL error
                    return false; // Handle database query error
                } else {
                    echo "Portname updated with view_only successfully"; // Log success
                }
            
        }
        elseif ($connect == 3) {
            // Second or third decoder accessing the encoder
            echo "Second or third decoder accessing the encoder";
            // Implement access logic for the second and third decoders here
            // For example, grant view-only access to the encoder
            
                // Update portname status with view_only
                $updateQuery = mysqli_query($this->conn, "UPDATE portname SET status='busy', connect = $connect, decoder_name='$decoder_name', decoder_count='$decoder_id', view_only='2' WHERE id='$port_id'");
                
                if (!$updateQuery) {
                    echo "Error updating portname: " . mysqli_error($this->conn); // Log MySQL error
                    return false; // Handle database query error
                } else {
                    echo "Portname updated with view_only successfully"; // Log success
                }
            
        }

        // Return true to indicate that operation succeeded
        return true;
    } else {
        echo "Maximum connections reached for this encoder"; // Log error
        return false; // Maximum connections reached
    }
}

    public function start($startupTimestamp , $event , $details)
    {
    $query=mysqli_query($this->conn,"INSERT INTO logs (date_created, action_made, event) VALUES ('$startupTimestamp', '$event', '$details')");

    echo "Audit log entry added successfully.";
    return $query;
    }

    public function connectdata()
    {
        $query = mysqli_query($this->conn,"SELECT * from username where id=$_SESSION[id]");
        return $query;
    }
    public function userdata()
    {    
        $result1=mysqli_query($this->conn, "select * from username");
      
        return $result1;
        $this->conn->close();
    }
    public function userhiddata()
    {    
        $result1=mysqli_query($this->conn, "SELECT hid from username");
        return $result1;
        $this->conn->close();
    }
    public function usermassdata()
    {    
        $result1=mysqli_query($this->conn, "SELECT mass from username");
        return $result1;
        $this->conn->close();
    }
    public function time($time)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE kvmname SET time='$time' WHERE id =1");
        return $updaterecord;
        header("time.php");
    }
    public function encryption($value)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE kvmname SET encryption='$value' WHERE id =1");
        return $updaterecord;
    }
    public function view($value)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE username SET view='$value'");
        return $updaterecord;
    }
    public function hid($value ,$u)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE `username` SET `hid`='$value' WHERE id='$u'");
        return $updaterecord;
    }
    public function mass($value ,$m)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE `username` SET `mass`='$value' WHERE id='$m'");
        return $updaterecord;
    }
    public function card($value ,$c)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE `username` SET `card`='$value' WHERE id='$c'");
        return $updaterecord;
    }
    public function virtua($value ,$v)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE `username` SET `virtual`='$value' WHERE id='$v'");
        return $updaterecord;
    }
    public function dongleupgrade($type ,$username, $value ,$path)
    {
        $updaterecord=mysqli_query($this->conn,"INSERT INTO `upgradehistory`(`type`, `user`, `starttime`, `endtime`, `perversion`, `upgradeversion`, `result`, `path`) 
      VALUES ('$type',' $username ',NOW(),NOW(),'$value','','successful','$path')");
      return $updaterecord;
    } 
    public function dongupgrade($path , $id)
    {
        $updaterecord=mysqli_query($this->conn,"UPDATE `portname` SET `upgrade`=1, lastUpdatedBy=NOW(),`path`= '$path' WHERE id='$id'");
      return $updaterecord;
    } 
    public function help()
    {
        $updaterecord=mysqli_query($this->conn, "SELECT version from portname WHERE id=8");
        return $updaterecord;
    }
    public function auditlog()
    {
        $updaterecord=mysqli_query($this->conn, "SELECT id , action_made , date_created FROM `logs` where id<=15");
        return $updaterecord;
    }   
    public function banner($value, $time)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE kvmname SET banner='$value', bannertime='$time' WHERE id =1");
        return $updaterecord;
        header("banner.php");
    }
    public function enable($value , $id)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE username SET active='$value', lastUpdatedBy=NOW()  WHERE id ='$id'");
        return $updaterecord;
    }  
    public function authority($value , $id)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE username SET authority='$value', lastUpdatedBy=NOW()  WHERE id ='$id'");
        return $updaterecord;
    }     
    public function username($value, $userid, $aes_encrypted_data, $triple_des_encrypted, $des_encrypted)
    {
$updaterecord=mysqli_query($this->conn, "UPDATE username SET aesname='$aes_encrypted_data' , desname='$des_encrypted' , 3desname='$triple_des_encrypted' , username='$value' WHERE id =$userid");
        return $updaterecord; 
    }
    public function pass($id)
    {
        $updaterecord=mysqli_query($this->conn, "SELECT aespass, despass,3despass, password from username WHERE id=$id");
        return $updaterecord;
    }
    public function passupdate($value, $aes_encrypted, $triple_des_encrypted, $des_encrypted, $id)
    {
$updaterecord=mysqli_query($this->conn, "UPDATE username set aespass='$aes_encrypted' , despass='$des_encrypted' , 3despass='$triple_des_encrypted', password='$value' WHERE id='$id'");
        return $updaterecord;
    }

    public function kvmupdate($name)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE kvmname SET kvmname='$name' WHERE id =1");
        return $updaterecord;
        header("kvmname.php");
    }
    public function portname($value, $id, $aes_encrypted_data, $triple_des_encrypted, $des_encrypted) 
    {
    $updaterecord=mysqli_query($this->conn, "UPDATE portname SET  aesportname='$aes_encrypted_data' , desportname='$des_encrypted' , 3desportname='$triple_des_encrypted' , portname='$value' WHERE id =$id");
        return $updaterecord;
    }
    public function resolutionedit($value , $id)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE portname SET resolution='$value' , lastUpdatedBy=NOW() WHERE id='$id'");
        return $updaterecord;
    }
     public function frame($value , $id)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE portname SET framerate='$value' , lastUpdatedBy=NOW() WHERE id='$id'");
        return $updaterecord;
    }
    public function mac($value , $id)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE portname SET macaddr='$value' , lastUpdatedBy=NOW() WHERE id='$id'");
        return $updaterecord;
    }
    public function linkedit($value , $id)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE portname SET linktype='$value' , lastUpdatedBy=NOW() WHERE id ='$id'");
        return $updaterecord;
    }
    public function audioedit($value , $value1, $id)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE portname SET audio='$value' , format='$value1' , lastUpdatedBy=NOW() WHERE id ='$id'");
        return $updaterecord;
    }
    public function kvmdata()
    {
        $result1=mysqli_query($this->conn, "SELECT * from kvmname ");
        return $result1;
        $this->conn->close();
    }
    public function fetchonerecord($userid)
    {
        $oneresult=mysqli_query($this->conn, "select id ,username , password  from username where id='$userid'");
        return $oneresult;
        $this->conn->close();
    }
    public function onlyuser()
    {
        $per_page_record = 8;          
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
            $page=1;    
        }    
        $start_from = ($page-1) * $per_page_record;  
        $oneresult=mysqli_query($this->conn, "SELECT * from portname LIMIT $start_from, $per_page_record");
       return $oneresult;
     
    }
    public function hotkeyupdate($hotkey)
    {
        $updaterecord=mysqli_query($this->conn, "UPDATE kvmname SET hotkey='$hotkey' WHERE id =1");
        return $updaterecord;
        $this->conn->close();
    }
    public function upgradedata()
    {
        $result1=mysqli_query($this->conn, "SELECT type , user , starttime, endtime ,perversion, upgradeversion, result, path from upgradehistory where no<=15 ");
        return $result1;
        $this->conn->close();
    }  
    public function upgrade()
    {
        $result1=mysqli_query($this->conn, "SELECT path from upgradehistory");
        return $result1;
        $this->conn->close();
    }
    public function kvmupgrade($type , $username, $path)
    {
        $result1=mysqli_query(
            $this->conn, "INSERT INTO `upgradehistory`(`type`, `user`, `starttime`, `endtime`, `perversion`, `upgradeversion`, `result`, `path`) 
      VALUES ('$type','$username',NOW(),NOW(),'','','successful','$path')"
        );
        $updaterecord=mysqli_query($this->conn, "UPDATE kvmname SET path='$path' WHERE id =1");
        return $result1;
        return $updaterecord;
        header("kvmupgrade.php");
        $this->conn->close();
    }
}

?>