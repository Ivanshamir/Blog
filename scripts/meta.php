<?php 
    if (isset($_GET['pageid'])) {
        $id = $_GET['pageid'];
        $pagequery = "SELECT * FROM tbl_page WHERE id='$id'";
            $pages = $db->selectDb($pagequery);
            if ($pages) {
               while ($result = $pages->fetch_assoc()) {
?>

			<title><?php echo $result['name']; ?>-<?php echo TITLE; ?></title>


<?php 
		} } }elseif(isset($_GET['id'])){
				$id = $_GET['id'];
				$query = "SELECT * FROM tbl_post WHERE id='$id'";
					$post = $db->selectDb($query);
					if ($post) {
						while ($result = $post->fetch_assoc()) { ?>
		
				<title><?php echo $result['title']; ?>-<?php echo TITLE; ?></title>

<?php } } }else { ?>

			<title><?php echo $fm->formattitle(); ?>-<?php echo TITLE; ?></title>


<?php 		} ?>
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
<?php 
    if (isset($_GET['id'])) {
        $keyid = $_GET['id'];
        $mkeyword = "SELECT * FROM tbl_post WHERE id='$keyid'";
         $keywrd = $db->selectDb($mkeyword);
         if ($keywrd) {
             while ($result = $keywrd->fetch_assoc()) {
?>
		<meta name="keywords" content="<?php echo $result['tags']; ?>">
	<?php } } }else{ ?>
		<meta name="keywords" content="<?php echo KEYWORD; ?>">
	<?php } ?>
	<meta name="author" content="Delowar">