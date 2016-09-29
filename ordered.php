<?php
if(isset($_GET["count"]))
{
	$count = $_GET["count"];
}
else
{
	$count = 0;
}

include "class.getFiles.php";

$images = new getFiles();
$imageArray = $images->getImageArray();

$sortedImages = new sortFiles();

// remove files not in the correct time period
$sortedImages->sortImageArray($imageArray);
$imageArray = $sortedImages->getImageArray();

if($count >= count($imageArray))
{
	$count = 0;
}

$fileName = $imageArray[$count];
$info = new SplFileInfo($fileName);

?>
 <!DOCTYPE html>
<html>
<head>
<title>Fiction Slideshow</title>
<link rel="stylesheet" type="text/css" href="main.css">
 <script type="text/javascript">


function reloadWindow(mycount)
	{
		
		var url = window.location.href;
		var query = window.location.search;
		if(query === "")
		{
			url = url + "?count="+mycount;
		} 
		else
		{
			url = location.origin + location.pathname + "?count="+mycount;
		}

		window.location.href = url;
	}

function myCount(count)
{
	var mycount = count;
	Number(mycount);
	mycount++;
	return mycount;
}	

function forImages(count)
{
	var mycount = myCount(count);
	setTimeout(function(){
		reloadWindow(mycount);
	}, 30000);
}

function forVideos(count)
{
	var vid = document.getElementById("vid");
	var mycount = myCount(count);
	vid.addEventListener("ended", function()
	{
		reloadWindow(mycount);
	});
}

 </script>
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
	forVideos('.$count.');
   </script>';

}
else
{
	echo '<img class="imageDisplay" src="images/'.$fileName.'" />';
	echo '<script type="text/javascript">
	forImages('.$count.');
   </script>';

}



 ?>


</body>

</html> 