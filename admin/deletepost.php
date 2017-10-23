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
    if (!isset($_GET['delpoid']) || $_GET['delpoid'] == NULL) {
       header("Location: postlist.php");
    }else{
        $delid = $_GET['delpoid'];

        $delimg = "SELECT * FROM tbl_post WHERE id='$delid'";
        $delimgall = $db->selectDb($delimg);
        if ($delimgall) {
        	while ($result = $delimgall->fetch_assoc()) {
        		$delimage = $result['image'];
        		unlink($delimage);
        	}
        }
         	$query = "DELETE FROM tbl_post WHERE id='$delid'";
	        $dellpost = $db->deleteUser($query);
	        if ($dellpost) {
	        	echo "<script>alert('Data deleted successfully');</script>";
	        	header("Location: postlist.php");
	        }else{
	        	echo "<script>alert('Data deleted unsuccessfull');</script>";
	        	header("Location: postlist.php");
	        }

    }


?>