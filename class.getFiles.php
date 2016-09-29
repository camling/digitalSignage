<?php

class getFiles{

	protected $dir;
	protected $imageArray;
	

	function __construct()
	{
		$this->get_dir();
		$this->get_images();
	}

	protected function get_dir()
	{
		$this->dir = getcwd();
	}

	protected function get_images()
	{
	
		if(count(scandir($this->dir."/images")) != 2)
		{
			$this->imageArray = scandir($this->dir."/images");
		}
		else
		{
			die("There are no files in the directory");
		}
		
	}

	

	public function getImageArray()
	{
		return $this->imageArray;
	}
}

class sortFiles{

	protected $sortedImageArray = [];


	public function sortImageArray($imageArray)
	{
		foreach ($imageArray as $imageFile ) 
		{  
			if($imageFile !== ".." && $imageFile !== ".")
			{

			$imagePath = $imageFile;
			$imageFile = (substr($imageFile, 0, -4));
			$BeginningPos = strpos($imageFile, '_');
			$beginningDate = (substr($imageFile, 0, $BeginningPos));
			
			$beginningDateformatted = str_replace("-","/", $beginningDate);
			
			$stringToStartTime = strtotime($beginningDateformatted);
			

			$EndingPos = strpos($imageFile, '_', $BeginningPos  + strlen('_'));
			$EndingPos = $EndingPos + 1;
	        $EndingDate = (substr($imageFile, $EndingPos));
	        $EndingDateformatted = str_replace("-","/", $EndingDate);
	        $stringToEndTime = strtotime($EndingDateformatted);
			
			$time = time();

			if($time <= $stringToStartTime && $time >= $stringToEndTime)
				{
					array_push($this->sortedImageArray, $imagePath);
					
				}
			
			}
		
		}

	}

	public function getImageArray()
	{
		if(count($this->sortedImageArray) != 0)
		{
			return $this->sortedImageArray;
		}
		else
		{
			die("There are no files in the time range");
		}
	}

	public function randomImageNum()
	{
		$imageArrayLength = count($this->sortedImageArray);
		$imageRand = rand(0, $imageArrayLength-1);
		return $imageRand;
	}

}

	
?>