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
    if (!isset($_GET['sliderid']) || $_GET['sliderid'] == NULL) {
       echo "<script>window.location='sliderlist.php';</script>";
    }else{
        $delid = $_GET['sliderid'];

        $delimg = "SELECT * FROM tbl_slider WHERE id='$delid'";
        $delslider = $db->selectDb($delimg);
        if ($delslider) {
        	while ($result = $delslider->fetch_assoc()) {
        		$delimage = $result['image'];
        		unlink($delimage);
        	}
        }
         	$query = "DELETE FROM tbl_slider WHERE id='$delid'";
	        $dellslide = $db->deleteUser($query);
	        if ($dellslide) {
	        	echo "<script>alert('Slider deleted successfully');</script>";
	        	echo "<script>window.location='sliderlist.php';</script>";
	        }else{
	        	echo "<script>alert('Slider deleted unsuccessfull');</script>";
	        	echo "<script>window.location='sliderlist.php';</script>";
	        }

    }


?>