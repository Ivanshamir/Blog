<?php
 include 'inc/header.php'; 
 include 'inc/slider.php';
 ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
<!--Pagination -->
<?php 
	$per_page = 3;
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	} else{
		$page = 1;
	}
	$start_form = ($page-1)*$per_page;
?>
<!--Pagination -->
<?php 
	$query = "SELECT * FROM tbl_post LIMIT $start_form, $per_page";
	$post = $db->selectDb($query);
	if ($post) {
		while ($result = $post->fetch_assoc()) {
?>

			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
				<h4><?php echo $fm->formatdate($result['date']); ?> ,By <a href="#"><?php echo $result['author']; ?></a></h4>
				 <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>

				<?php echo $fm->textShorten($result['body']); ?>

				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
				</div>
			</div>
<?php } ?>	
<!--Pagination -->
<?php 
	$query = "SELECT * FROM tbl_post";
	$result = $db->selectDb($query);
	$total_rows = mysqli_num_rows($result);
	$total_pages = ceil($total_rows/$per_page);
	echo "<span class='paggg'><a href='index.php?page=1'>".'First Page'."</a>";
	for ($i=1; $i <=$total_pages ; $i++) { 
		echo "<a href='index.php?page=".$i."'>".$i."</a>";
	}
	echo "<a href='index.php?page=$total_pages'>".'Last Page'."</a></span>";
?>
<!--Pagination -->
<?php  } else{
		header("Location: 404.php");
	}?>
		</div>
		
<?php 
	include 'inc/sidebar.php';
	include 'inc/footer.php';
?>