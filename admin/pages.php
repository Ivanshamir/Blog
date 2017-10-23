<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
       header("Location: index.php");
    }else{
        $id = $_GET['pageid'];
    }
?>


<style>
    .delpage{margin-left: 10px}
    .delpage a {
  background: #f0f0f0 none repeat scroll 0 0;
  border: 1px solid #ddd;
  color: #444;
  cursor: pointer;
  font-size: 20px;
  font-weight: normal;
  padding: 3px 17px;
}
</style>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Page</h2>
                <div class="block">   
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = mysqli_real_escape_string($db->link, $_POST['name']);
                $body = mysqli_real_escape_string($db->link, $_POST['body']);


                if ($name == "" || $body == "" ) {
                   echo "<span class='error'>Field muist not be empty</span>";
                }else{
                    $upagequery = "UPDATE tbl_page SET 
                                name = '$name',
                                body = '$body'
                                WHERE id = '$id'";
                    $updatePages = $db->dbUpdate($upagequery);
                    if ($updatePages) {
                     echo "<span class='success'>Page Updated Successfully.</span>";
                    }else {
                     echo "<span class='error'>Page can not be Updated !</span>";
                    }
                }
            }
        ?>            
                 <form action="" method="post">
                    <?php 
                        $query = "SELECT * FROM tbl_page WHERE id='$id'";
                        $datapages = $db->selectDb($query);
                        if ($datapages) {
                            while ($result = $datapages->fetch_assoc()) {
                    ?>
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                    
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    <?php echo $result['body']; ?>
                                </textarea>
                            </td>
                        </tr>
                        
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                                <span class="delpage"><a onclick="return confirm('Are you want to sure Delete?')" href="deletepage.php?delpageid=<?php echo $result['id']; ?>">Delete</a></span>
                            </td>
                        </tr>
                    </table>
            <?php } } ?>
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


