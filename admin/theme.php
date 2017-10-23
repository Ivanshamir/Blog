<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Themes</h2>
               <div class="block copyblock"> 
               <?php 
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $theme = mysqli_real_escape_string($db->link, $_POST['theme']);
                            $themequery = "UPDATE tbl_theme SET 
                                theme = '$theme'
                                WHERE id = '1'";
                            $updatetheme = $db->dbUpdate($themequery);
                            if ($updatetheme) {
                                echo "<span class='success'>Theme Updated Successfully!!</span>";
                            }else{
                                echo "<span class='error'>Theme can not be Updated !!</span>";
                            }
                        }
            ?>
            <?php 
                $editquery = "SELECT * FROM tbl_theme WHERE id='1'";
                $themeque = $db->selectDb($editquery);
                if ($themeque) {
                   while ($result = $themeque->fetch_assoc()) {
                   
                
            ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input <?php if ($result['theme'] == 'default') { echo "checked"; } ?> type="radio" name="theme" value="default">Default
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <input <?php if ($result['theme'] == 'green') { echo "checked"; } ?> type="radio" name="theme" value="green">Green
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <input <?php if ($result['theme'] == 'red') { echo "checked"; } ?> type="radio" name="theme" value="red">Red
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Set" />
                            </td>
                        </tr>
                    </table>
                    </form>
            <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>