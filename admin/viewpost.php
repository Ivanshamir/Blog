<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    if (!isset($_GET['viewpoid']) || $_GET['viewpoid'] == NULL) {
       echo "<script>window.location='index.php'</script>";
    }else{
        $id = $_GET['viewpoid'];
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Post</h2>
                <div class="block">   
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                 echo "<script>window.location='postlist.php'</script>";
           }
        ?>            
                 <form action="" method="post">
                    <table class="form">
        <?php 
            $editquery = "SELECT * FROM tbl_post WHERE id='$id' ORDER BY id DESC";
            $showpost = $db->selectDb($editquery);
            if ($showpost) {
                while ($postresult = $showpost->fetch_assoc()) {
        ?>               
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $postresult['title']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option>Select Category</option>
                            <?php 
                                $query = "SELECT * FROM tbl_category";
                                $category = $db->selectDb($query);
                                if ($category) {
                                    while ($result = $category->fetch_assoc()) {
                            ?>
                                    <option 
									<?php
                             		if ($postresult['cat'] == $result['id']) {  ?>
                             			selected="selected"
                             		<?php	} ?>
                                    value="<?php echo $result['id']; ?>">
                                    <?php echo $result['name']; ?>
                                    	
                                    </option>
                             <?php } } ?>
                             
                                </select>
                           
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Image</label>
                            </td>
                            <td>
                            	<img src="<?php echo $postresult['image']; ?>" width="200px" height="100px" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce">
                                	<?php echo $postresult['body']; ?>
                                </textarea>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $postresult['tags']; ?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $postresult['author']; ?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                            </td>
                            <td>
                                <input type="hidden" name="userid" value="<?php echo Session::get('userId'); ?>" class="medium" />
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


