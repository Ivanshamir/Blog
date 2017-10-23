<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
       echo "<script>window.location = 'inbox.php';</script>";
    }else{
        $id = $_GET['msgid'];
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Page</h2>
                <div class="block">   
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      echo "<script>window.location = 'inbox.php';</script>";
    }
?>            
                 <form action="" method="post">
                 <?php 
                        $query = "SELECT * FROM tbl_contact WHERE id='$id'";
                        $query = $db->selectDb($query);
                        if ($query) {
                            while ($result = $query->fetch_assoc()) {
                    ?>
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['fname'].' '.$result['lname']; ?>" class="medium" />
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
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $fm->formatdate($result['time']); ?>" class="medium" />
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <label>Body</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    <?php echo $result['body'];?>
                                </textarea>
                            </td>
                        </tr>
                        
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="View" />
                            </td>
                        </tr>
                    </table>
                <?php } }?>
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


