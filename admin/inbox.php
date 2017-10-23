<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
 <?php 
    if (isset($_GET['seenid'])) {
        $id = $_GET['seenid'];
        $query = "UPDATE tbl_contact  SET 
                        status = '1'
                        WHERE id = '$id'";
                    $updateCat = $db->dbUpdate($query);
                    if ($updateCat) {
                        echo "<span class='success'>Message sent to sentbox!!</span>";
                    }else{
                        echo "<span class='error'Something went wrong!!</span>";
                    }
    }
?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Time</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$query = "SELECT * FROM tbl_contact WHERE status='0' ORDER BY id DESC";
						$inboxmsg = $db->selectDb($query);
						if ($inboxmsg) {
							$i=0;
							while ($result = $inboxmsg->fetch_assoc()) {
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['fname'].' '.$result['lname'];?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textShorten($result['body'],30); ?></td>
							<td><?php echo $fm->formatdate($result['time']); ?></td>
							<td><a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> || <a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a> || <a onclick="return confirm('Are you want to sure See this msg?')" href="?seenid=<?php echo $result['id']; ?>">Seen</a></td>
						</tr>
					<?php } } ?>	
					</tbody>
				</table>
               </div>
            </div>


       <div class="box round first grid">
                <h2>Seen message</h2>
 <?php
 if (isset($_GET['delid'])) {
        $delid = $_GET['delid'];
        $delmsg= "DELETE FROM tbl_contact WHERE id='$delid'";
        $deldata = $db->deleteUser($delmsg);
        if ($deldata) {
            echo "<span class='success'>Message Deleted Successfully!!</span>";
    	}else{
            echo "<span class='error'>Message can not be Deleted !!</span>";
        }
   }
 ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Time</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$query = "SELECT * FROM tbl_contact WHERE status='1' ORDER BY id DESC";
						$inboxmsg = $db->selectDb($query);
						if ($inboxmsg) {
							$i=0;
							while ($result = $inboxmsg->fetch_assoc()) {
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['fname'].' '.$result['lname'];?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textShorten($result['body'],30); ?></td>
							<td><?php echo $fm->formatdate($result['time']); ?></td>
							<td><a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a>  || <a onclick="return confirm('Are you want to sure Delete?')" href="?delid=<?php echo $result['id']; ?>">Delete</a></td>
						</tr>
					<?php } } ?>	
					</tbody>
				</table>
               </div>
          </div>
   </div>
<script type="text/javascript">

    $(document).ready(function () {
        setupLeftMenu();

    $('.datatable').dataTable();
        setSidebarHeight();
});
</script>

<?php include 'inc/footer.php';?> 