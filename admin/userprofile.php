<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    $userid = Session::get('userId');
    $userrole = Session::get('userRole');
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update User</h2>
                <div class="block">   
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = mysqli_real_escape_string($db->link, $_POST['name']);
                $username = mysqli_real_escape_string($db->link, $_POST['username']);
                $email = mysqli_real_escape_string($db->link, $_POST['email']);
                $details = mysqli_real_escape_string($db->link, $_POST['details']);


                if ($name == "" || $username == "" || $email == "" || $details == "") {
                   echo "<span class='error'>Field muist not be empty</span>";
                }else{
                		$query = "UPDATE tbl_user SET 
									name = '$name',
									username = '$username',
									email = '$email',
									details = '$details'
								WHERE id = '$userid' ";
		                    $updaed_rows = $db->dbUpdate($query);
		                    if ($updaed_rows) {
		                     echo "<span class='success'>User Data Updated Successfully.</span>";
		                    }else {
		                     echo "<span class='error'>User Data can not be Updated !</span>";
		                    }
                	}
	               
	            }
        ?>            
                 <form action="" method="post">
                    <table class="form">
        <?php 
            $userquery = "SELECT * FROM tbl_user WHERE id='$userid' AND role='$userrole'";
            $upuser = $db->selectDb($userquery);
            if ($upuser) {
                while ($result = $upuser->fetch_assoc()) {
        ?>               
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" value="<?php echo $result['username']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" value="<?php echo $result['email']; ?>" class="medium" />
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
                                <input type="submit" name="submit" Value="Update" />
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


