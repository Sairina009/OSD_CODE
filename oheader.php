<?php  require_once "header.php"; ?>
<?php
if (isset($_POST["save"])) { 
    $id =$_POST['id']; 
    $portname = $_POST['portname'];
    $banner = $_POST['banner'];
    $time = $_POST['time'];
    $idd = $_SESSION['id'];
    $decoder_name = $_POST['decoder_name'];
    if($_SESSION['a' . $idd] == 'Share' && $banner == 'ON' && $id == $_POST['id']){
    
        echo "   <script>
        setTimeout(() => {
        const box = document.getElementById('box');
        box.style.display = 'none';
    
    }, $time);
        </script>";

        echo "<div id=box >
        Channel Occupy &nbsp;&nbsp; Channel no: $id  &nbsp; &nbsp;Portname:&nbsp; $portname
        </div>";        
            } else {

            }
    $updatedata=new DB_con(); 
    $sql=$updatedata->connect($id , $portname,$decoder_name, $idd); 
 
}
?>
<!DOCTYPE html>
<html lang=en>

<head>
    <meta charset=UTF-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['PAGETITLE']; ?></title>
      <script>
        function startWebSocket() {
            var ws = new WebSocket("ws://127.0.0.1:9999");
            ws.onopen = function () {
                console.log("WebSocket connection opened");
             
                ws.send("start-app");
            };
            ws.onmessage = function (event) {
                console.log("Message from server:", event.data);
                };
            ws.onclose = function () {
                console.log("WebSocket connection closed");
            };
        }
            function toggleFullScreen() {
            var canvas = document.getElementById("videoCanvas");
            if (canvas.requestFullscreen) {
                canvas.requestFullscreen();
            } else if (canvas.mozRequestFullScreen) { 
                canvas.mozRequestFullScreen();
            } else if (canvas.webkitRequestFullscreen) {
                canvas.webkitRequestFullscreen();
            } else if (canvas.msRequestFullscreen) { 
                canvas.msRequestFullscreen();
            }
        }
    </script>
  <style>
        
        #remoteVideos {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: black;
        }
        #videoCanvas {
            display: block;
            margin: 0 auto;
            width: 100%;
            height: 100%;
        }
        #closeButton {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>

<body>
    <table id=table cellpadding=2 cellspacing=0 border=3
        style=line-height:3;width:70%;margin-left:89px;margin-top:-800px>
        <tr style=height:40px;background-color:lightsteelblue>
            <th style=text-align:center;width:65px><?php echo $lang['A6']; ?></th>
            <th style=text-align:center;width:70px><?php echo $lang['G1']; ?></th>
            <th style=text-align:center><?php echo $lang['G2']; ?></th>
            <th style=text-align:center;width:128px><?php echo $lang['G3']; ?></th>
            <th style=text-align:center;width:135px><?php echo $lang['G4']; ?></th>
            <th style=text-align:center;width:130px><?php echo $lang['G5']; ?></th>
        </tr>
        <?php
        require_once 'DBConnection.php';
        $kvmdata=new DB_con();