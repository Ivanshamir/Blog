<div class="slidersection templete clear">
        <div id="slider">
        <?php 
			$query = "SELECT * FROM tbl_slider";
			$slideimg = $db->selectDb($query);
			if ($slideimg) {
				while ($result = $slideimg->fetch_assoc()) {
		?>
            <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['title']; ?>" title="<?php echo $result['title']; ?>" /></a>
        <?php } } ?>
        </div>

</div>