 <?php
     include '../lib/Session.php';
     Session::checkSession();
 ?>
 <?php
 include '../config/config.php';
 include '../lib/Database.php';
 $db = new Database();
?>

<?php 
    if (!isset($_GET['delpageid']) || $_GET['delpageid'] == NULL) {
    	header("Location: pages.php");
    }else{
        $delid = $_GET['delpageid'];
        $delpagequery = "DELETE FROM tbl_page WHERE id='$delid'";
            $dellpage = $db->deleteUser($delpagequery);
            if ($dellpage) {
                echo "<script>alert('Page deleted successfully');</script>";
                header("Location: addpage.php");
            }else{
                echo "<script>alert('Page deleted unsuccessfull');</script>";
                header("Location: pages.php");
            }
    }
?>