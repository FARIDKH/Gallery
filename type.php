<?php
	function isImage($filetype)
	{
		if($filetype == "jpg" || $filetype == "jpeg" || $filetype == "png") return true;
		else return false;
	}

	function isAudio($filetype) {
		if ($filetype == "mp3") return true;
		else return false;
	}

	function isVideo($filetype) {
		if ($filetype == "mp4" || $filetype == "mov") return true;
		else return false;
	}

?>