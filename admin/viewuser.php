<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    if (!isset($_GET['userid']) || $_GET['userid'] == NULL) {
       echo "<script>window.location= 'userlist.php';</script>";
    }else{
        $id = $_GET['userid'];
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <div class="block">   
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               
	               echo "<script>window.location= 'userlist.php';</script>";
	            }
        ?>            
                 <form action="" method="post">
                    <table class="form">
        <?php 
            $userquery = "SELECT * FROM tbl_user WHERE id='$id'";
            $upuser = $db->selectDb($userquery);
            if ($upuser) {
                while ($result = $upuser->fetch_assoc()) {
        ?>               
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['username']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>


                        
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="details" ">
                                	<?php echo $result['details']; ?>
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                <?php } } ?>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


