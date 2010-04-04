<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	

	<?php

	/*Parse the query paramters
	$image = $_GET['image'];
	$type = $_GET['type'];
	$state = $_GET['state'];
	$filename = $_GET['title'];


	//Verify that the URL is pointing to a file @ pixlr.com"
	if (strpos($image, "pixlr.com") == 0){
	//Handle the error:
	echo "Invalid referrer";
	exit;
	}

	//Verify that the file is an image
	$headers = get_headers($image, 1);
	$content_type = explode("/", $headers['Content-Type']);
	if ($content_type[0] != "image"){
	//Handle the error
	echo "Invalid file type";
	exit;
	}

	//Optional: set a unique filename if the file is saved to a public service and inserted into a database
	//$filename = uniqid();

	//Set the local file path where the image will be copied to
	$save_path = "/wp-content/uploads/". $filename;

	//Copy the images to the local server as set before.
	copy($image,$save_path);

	//Optional:Insert image information into database and or redirect to a page of some sort


	header("Location:joylesswhitepeople.php");*/
	

	?>
	<title>Exit Pixlr</title>
	<script type="text/javascript">
		if(parent){
			parent.pixlr.overlay.hide();
		}
	</script>
</head>
<body bgcolor="#000000">
</body>
</html>