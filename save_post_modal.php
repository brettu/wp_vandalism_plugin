<?php

	//Check in there is a image in the stream
	if(empty($_FILES['image'])) {
	echo "No image stream was found";
	exit;
	}
	//Check if there was an upload error
	if($_FILES['image']['error'] != UPLOAD_ERR_OK) {
	echo "Error writing file to disc". $_FILES['image']['error'];
	}

	//Parse the form paramters
	$file = $_FILES['image']['tmp_name'];
	$type = $_POST['type'];
	$state = $_POST['state'];
	$filename = $_POST['title'];


	//Optional: set a unique filename if the file is saved to a public service and inserted into a database
	//$filename = uniqid();

	//Set the local file path where the image will be saved to	
	$save_path = ($_SERVER['DOCUMENT_ROOT']) . "/wp-content/plugins/wp_vandalism_plugin/edited/". $filename;

	//Copy the temp_image to the path as set before.
	if(!move_uploaded_file($_FILES['image']['tmp_name'], $save_path)) 
	{
		echo "Error moving the uploaded file";
		exit;
	}
	
	
	//include(($_SERVER['DOCUMENT_ROOT']) . "/wp-content/plugins/drawing_app/drawingapp.php");  
		
	//Optional:Insert image information into database and or redirect to a page of some sort
	//header("Location:/wp-includes/comment.php");
	
	
	
?>
<script type="text/javascript">

		if(parent){	
		
			parent.pixlr.overlay.hide();						
		}
		
</script>
