<?php
include "class.getFiles.php";


$images = new getFiles();
// list of all files in the images folder (includes videos)
$imageArray = $images->getImageArray();

$sortedImages = new sortFiles();
$sortedImages->sortImageArray($imageArray);

// remove files not in the correct time period
$imageArray = $sortedImages->getImageArray();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Images and videos in time range</title>
    <style> 

.images_thumbs {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
}

.images_thumbs div{
    flex-basis: 25%;
}

.images_thumbs div img{
    width: 100%;
}

.images_thumbs div video{
    width: 100%;
}

.event_dates{
    text-align: center;
}

</style>
</head>
<body>

<h1> Images in time range</h1>
<p><?php echo "Today is " . date("m/d/Y"); ?> </p>

<div class="images_container">
<div class="images_list">
<h2>Text List</h2>
<ul>
<?php
foreach($imageArray as $imageFileName)
{
    echo "<li>";
    echo "<a href='./images/".$imageFileName->image_path."'>";
    echo $imageFileName->image_path;
    echo "</a>";
    echo "</li>";
}

?>

</ul>
</div>
<h2>Image List</h2>
<div class="images_thumbs">
    <?php
foreach($imageArray as $imageFileName)
{
    $ext = pathinfo($imageFileName->image_path, PATHINFO_EXTENSION);
    echo "<div>";
    echo "<a href='./images/".$imageFileName->image_path."'>";
    if($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif")
    {
        echo "<img src='./images/".$imageFileName->image_path."'/>";
    }
    elseif ($ext == "mp4")
    {
        echo '<video id="vid" class="videoDisplay">
            <source src="images/'.$imageFileName->image_path.'" type="video/mp4">
            Your browser does not support the video tag.
            </video>';
    }
   
    echo "</a>";
    echo "<p class='event_dates'>Start Date: ".gmdate("F d, Y", $imageFileName->end_date)."  -  End Date: " . gmdate("F d, Y",$imageFileName->start_date). "</p>";
    echo "</div>";
} 
?>
</div>
</div>
</body>
</html>