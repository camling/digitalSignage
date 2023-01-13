# digitalSignage
A digital signage solution

## About

A web based digital signage solution using PHP and JavaScript. 
The program gets all of the files in an images folder on the server.
The files need to have a special naming convention, End-Date_filename_Start-Date  Ex.  09-29-2016_My fav image_11_03_2016
Any files who date range the current date falls in get added to a sorted list.
The random.php file randomly displays any of the files in this list before refreshing after 30's or after the video is completed, restarting the process. 
The ordered.php file displays the first slide or video in the sorted list then when it refreshed moves to the next file, it continues to do this until it gets to the end of the sorted list then starts over. 

## Slidelist

A second helper program, the slidelist.php file shows all the images and videos in the images folder that are in the current date range. This makes it easy to see what will be displayed on the digital sigange without having to wait for it to cycle through them all. 


## Installation

Put folder on webserver running PHP and put images or video .mp4 files in the images folder using the end date first naming convention. 


## Contributors

Chris Amling
