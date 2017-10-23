<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<style>
.leftblock{float: left;width: 70%}
.rightblock{float: left;width: 20%}
</style>
  
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>

<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $title = $fm->validation($_POST['title']);
        $slogan = $fm->validation($_POST['slogan']);

        $title = mysqli_real_escape_string($db->link, $title);
        $slogan = mysqli_real_escape_string($db->link, $slogan);
        


        $permited  = array('png');
        $file_name = $_FILES['logo']['name'];
        $file_size = $_FILES['logo']['size'];
        $file_temp = $_FILES['logo']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = 'logo'.'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;
        if ($title == "" || $slogan == "" ) {
           echo "<span class='error'>Field muist not be empty</span>";
        }else{
            if(!empty($file_name)){
                 if($file_size >1048567) {
                 echo "<span class='error'>Image Size should be less then 1MB!</span>";
                } elseif (in_array($file_ext, $permited) === false) {
                     echo "<span class='error'>You can upload only:-".implode(' ', $permited)."</span>";
                } else{
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE title_slogan SET 
                            title = '$title',
                            slogan = '$slogan',
                            logo = '$uploaded_image'
                        WHERE id = '1' ";
                    $updaed_rows = $db->dbUpdate($query);
                    if ($updaed_rows) {
                     echo "<span class='success'>Data Updated Successfully.</span>";
                    }else {
                     echo "<span class='error'>Data can not be Updated !</span>";
                    }
                }
            }else{
                $query = "UPDATE title_slogan SET 
                            title = '$title',
                            slogan = '$slogan'
                        WHERE id = '1' ";
                    $updaed_rows = $db->dbUpdate($query);
                    if ($updaed_rows) {
                     echo "<span class='success'>Data Updated Successfully.</span>";
                    }else {
                     echo "<span class='error'>Data can not be Updated !</span>";
                    }
            }
           
        }
   }
?>
        <div class="block sloginblock"> 

    <?php 
        $query = "SELECT * FROM title_slogan WHERE id='1'";
        $seltitle = $db->selectDb($query);
        if ($seltitle) {
            while ($result = $seltitle->fetch_assoc()) { 
    ?>  
   
        <div class="leftblock">    
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">					
                <tr>
                    <td>
                        <label>Website Title</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['title']; ?>"  name="title" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Website Slogan</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['slogan']; ?>" name="slogan" class="medium" />
                    </td>
                </tr>
				 
				<tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="logo" />
                    </td>
                </tr>
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
         </div>   
         <div class="rightblock">
             <img src="<?php echo $result['logo']; ?>" alt="" width="200px" height="200px">
         </div>   
    <?php } } ?> 
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>
