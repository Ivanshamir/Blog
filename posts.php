<?php
 include 'inc/header.php'; 
 ?>


 <div class="contentsection contemplete clear">
		<div class="maincontent clear">
<?php 
	if (!isset($_GET['category']) || $_GET['category'] == NULL) {
		header("Location: 404.php");
	}else {
		$id = $_GET['category'];
	}

?>

<?php 
	$query = "SELECT * FROM tbl_post WHERE cat='$id' LIMIT 3";
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
		<p>No posts Available!!</p>
<?php	}?>
	
	</div>

<?php 
	include 'inc/sidebar.php';
	include 'inc/footer.php';
?>