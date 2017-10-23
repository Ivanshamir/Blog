<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
       header("Location: catlist.php");
    }else{
        $id = $_GET['catid'];
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
               <?php 
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $name = $_POST['name'];
                        $name = mysqli_real_escape_string($db->link, $name);
                        if (empty($name)) {
                           echo "<span class='error'>Field muist not be empty</span>";
                        }else{
                            $query = "UPDATE tbl_category SET 
                                name = '$name'
                                WHERE id = '$id'
                            ";
                            $updateCat = $db->dbUpdate($query);
                            if ($updateCat) {
                                echo "<span class='success'>Category Updated Successfully!!</span>";
                            }else{
                                echo "<span class='error'>Category can not be Updated !!</span>";
                            }
                        }
                        
                    }
            ?>
            <?php 
                $editquery = "SELECT * FROM tbl_category WHERE id='$id'";
                $showque = $db->selectDb($editquery);
                if ($showque) {
                   while ($result = $showque->fetch_assoc()) {
                   
                
            ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
            <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>