<?php
	include 'db.php';
	include 'type.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gallery</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<style>
		body {
			background-color: #FAFAFA;
		}
		.card {
			padding: 18px;
			margin-top: 25px;
			background-color: #fff;
		    	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.08),0 0px 0px 1px rgba(0, 0, 0, 0.02);
		    	border-radius: 2px;
		}
		.padding {
			padding: 0 !important;
		}
		.col-xs-10 .col-sm-6:nth-child(odd) {
			padding-left: 0;
		}
		.col-xs-10 .col-sm-6:nth-child(even) {
			padding-right: 0;
		}
		@media only screen and (max-width: 767px) {
			.col-xs-10 .col-xs-12 {
				padding-left: 0;
				padding-right: 0;
			}
		}
		#percent {
			margin-bottom: 10px;
			color: green;
			font-size: 24px;
		}
	</style>
</head>
<body>
	<div class="container">
		<a href="upload.php" style="margin-top: 30px;" class="btn btn-success">File yukle</a>
		<?php
			$i = 0;
			$all = getAll();
			if($all->num_rows == 0) {
		?>
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 padding">
					<div class="alert alert-danger" style="margin-top:25px;">
						<strong>Bazada file yoxdur.</strong>
					</div>
				</div><!-- col-xs-10 col-xs-offset-1 padding -->
			</div><!-- row -->
		<?php
			} else {
				while ($result = mysqli_fetch_assoc($all)) {
					if ($i % 2 == 0) { 
						echo '<div class="row"><div class="col-xs-10 col-xs-offset-1 padding">';
					}
					$filetype = $result["file_type"];
		?>
					<div class="col-xs-12 col-sm-6">
						<div class="card">
							<div class="img-wrapper">
					<?php if(isImage($filetype)) { ?> <a href="<?=$result["file_path"]?>"><img class="img-responsive" src="<?=$result["file_path"]?>"></a> <?php } ?>
					<?php if(isAudio($filetype)) { ?> 
						<center>
							<audio controls>
								<source src="<?=$result["file_path"]?>" type="audio/mpeg">
								Your browser does not support the audio tag.
							</audio>
						</center>
					<?php } ?>
					<?php if(isVideo($filetype)) { ?> 
						<center>
							<video width="320" height="240" controls>
								<source src="<?=$result["file_path"]?>" type="video/mp4">
								Your browser does not support the video tag.
							</video>
						</center>
					<?php } ?>
							</div><!-- img-wrapper -->
							<div class="img-content">
								<h3><strong><?=$result["title"]?></strong></h3>
								<h5><?=$result["author"]?></h5>
								<h6><?=$result["date"]?></h6>
							</div><!-- img-content -->
						</div><!-- card -->
					</div><!-- col-xs-6 -->
		<?php 
					$i++;
					if($i % 2 == 0) {
						echo '</div></div>';
					}
				} 
			} 
		?>		
	</div><!-- container -->
</body>
</html>