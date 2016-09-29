<?php

include "class.getFiles.php";

$images = new getFiles();
// list of all files in the images folder (includes videos)
$imageArray = $images->getImageArray();

$sortedImages = new sortFiles();
$sortedImages->sortImageArray($imageArray);

// remove files not in the correct time period
$imageArray = $sortedImages->getImageArray();
$randImage = $sortedImages->randomImageNum();

$fileName = $imageArray[$randImage];

$info = new SplFileInfo($fileName);



?>
 <!DOCTYPE html>
<html>
<head>
<title>Fiction Slideshow</title>
<link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
<?php 

if($info->getExtension() == "mp4")
{
	echo '<video id="vid" class="videoDisplay" autoplay>
  <source src="images/'.$fileName.'" type="video/mp4">
  Your browser does not support the video tag.
</video>';

   echo '<script type="text/javascript">
	var vid = document.getElementById("vid");
	vid.addEventListener("ended", function(){
		window.location.reload();
	});
   </script>';

}
else
{
	echo '<img class="imageDisplay" src="images/'.$fileName.'" />';
	echo '<script type="text/javascript">
	setTimeout(function(){
		window.location.reload();
	}, 30000);
   </script>';

}
 ?>
</body>

</html> 