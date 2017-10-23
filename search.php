<?php
 include 'inc/header.php'; 
 ?>


 <div class="contentsection contemplete clear">
		<div class="maincontent clear">
<?php 
	if (!isset($_POST['search']) || $_POST['search'] == NULL) {
		header("Location: 404.php");
	}else {
		$search = $_POST['search'];
	}

?>

<?php 
	$query = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
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

<?php  } else{ ?>
		<p>No results found!!</p>
<?php	}?>
	
	</div>

<?php 
	include 'inc/sidebar.php';
	include 'inc/footer.php';
?>