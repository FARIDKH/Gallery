<?php
	if(!is_dir("uploads/")) mkdir("uploads/");
	if(!is_dir("uploads/image")) mkdir("uploads/image");
	if(!is_dir("uploads/video")) mkdir("uploads/video");
	if(!is_dir("uploads/audio")) mkdir("uploads/audio");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<style type="text/css">
		body {
			background-image: url('background.png');
			background-repeat: repeat;
		}
		form {
			margin-top: 50px;
		}
	</style>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="author">Name Surname</label>
					<input type="text" class="form-control" id="author" name="author" placeholder="Name Surname">
				</div>
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Title">
				</div>
			  	<div class="form-group">
					<label for="file">Select File</label>
					<input type="file" class="form-control-file" id="file" name="file">
				</div>
				<div class="form-group">
					<input type="submit" class="form-control btn btn-success" id="submit" name="submit" value="Upload">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
<?php
	if (isset($_POST) && isset($_POST["author"]) && isset($_POST["title"]) && isset($_FILES["file"]) && isset($_POST["submit"])) {
		$author = $_POST["author"];
		$title = $_POST["title"];
		$file = $_FILES["file"];
		print_r($_FILES);
		$filetype = pathinfo($file['name'], PATHINFO_EXTENSION);
		
		include 'type.php';

		if(isImage($filetype)) $target_dir = 'uploads/image/';
		else if (isAudio($filetype)) $target_dir = 'uploads/audio/';
		else if (isVideo($filetype)) $target_dir = 'uploads/video/';
		else {
			echo "Invalid file type";
			header("Refresh: 2; index.php");
		}
		
		$target_file = $target_dir . date("dmYHis") . ".$filetype";

		if(move_uploaded_file($file['tmp_name'], $target_file)) {
			include 'db.php';
			if($db_conn) {
				$SQL = "INSERT INTO $db_name (author, title, file_path, file_type) VALUES ('$author', '$title', '$target_file', '$filetype')";
				mysqli_query($db_conn, $SQL);
				header("Location: index.php");
			}
		}
	}
?>