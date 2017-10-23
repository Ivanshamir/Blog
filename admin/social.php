<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $fb = $fm->validation($_POST['fb']);
            $tw = $fm->validation($_POST['tw']);
            $ln = $fm->validation($_POST['ln']);
            $gp = $fm->validation($_POST['gp']);

            $fb = mysqli_real_escape_string($db->link, $fb);
            $tw = mysqli_real_escape_string($db->link, $tw);
            $ln = mysqli_real_escape_string($db->link, $ln);
            $gp = mysqli_real_escape_string($db->link, $gp);


            if ($fb == "" || $tw == "" || $ln == "" || $gp == "") {
                echo "<span class='error'>Field muist not be empty</span>";
            }else{
                $socialquery = "UPDATE tbl_social SET 
                        fb = '$fb',
                        tw = '$tw',
                        ln = '$ln',
                        gp = '$gp'
                     WHERE id = '1' ";
                $updaed_rows = $db->dbUpdate($socialquery);
                if ($updaed_rows) {
                 echo "<span class='success'>Data Updated Successfully.</span>";
                }else {
                 echo "<span class='error'>Data can not be Updated !</span>";
                }
            }
    }
?>
        <div class="block">               
         <form action="" method="post">
            <table class="form">
<?php 
        $query = "SELECT * FROM tbl_social WHERE id='1'";
        $social = $db->selectDb($query);
        if ($social) {
            while ($result = $social->fetch_assoc()) { 
?> 					
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" name="fb" value="<?php echo $result['fb']; ?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" name="tw" value="<?php echo $result['tw']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>LinkedIn</label>
                    </td>
                    <td>
                        <input type="text" name="ln" value="<?php echo $result['ln']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>Google Plus</label>
                    </td>
                    <td>
                        <input type="text" name="gp" value="<?php echo $result['gp']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
<?php } } ?>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?> 