<?php include('embeds/header.php'); ?>

<?php 
/* --------------------------------------------------

@script:        Pixel Vac
@date:          28/10/2012
@author:        Sean Bullock
@url:           http://bluespore.com               
@twitter:       bluespore

@description:
An experimental script to recreate images pixel by pixel, using a box shadow.

@usage:
Just point it to an image.

@recognise:
It'd be rad if you tweeted at me to show appreciation.

-------------------------------------------------- */

	//It's a beast - did I metion this was experimental?
	ini_set('memory_limit', '256M');

	//Vars
	$filename = 'img/fireman.jpg';
	list($width, $height, $type) = getimagesize($filename);
	$arr = array();

	//Create image
	switch($type)
	{
		//GIF
		case 1:
			$img = imagecreatefromgif($filename);
		break;

		//JPEG
		case 2:
			$img = imagecreatefromjpeg($filename);
		break;

		//PNG
		case 3:
			$img = imagecreatefrompng($filename);
            imagealphablending($srcImage, true);
            imagesavealpha($srcImage, true);
		break;

		default:
			echo "Only JPG, GIF & PNG extentions supported.";
	}

	//Retrieve colours
	for($i=1;$i<=$height;$i++)
	{
		for($j=1;$j<=$width;$j++)
		{
			$rgb = imagecolorat($img, $j, $i);
			$colors = imagecolorsforindex($img, $rgb);

			array_push($arr, $colors);
		}
	}

	//Element with box shadow applied to it
	echo '<div id="img"></div>';

	//CSS for that element
	echo '<style type="text/css">#img{height:1px;width:1px;box-shadow:';
	$count = 0;

	//Create box shadows (fasten your seatbelts)
	for($i=1;$i<=$height;$i++)
	{
	    for($j=1;$j<=$width;$j++)
	    {
	        $count++;

	        echo ''. $j . 'px '. $i .'px 0px 1px rgba('. $arr[$count]['red'] .','. $arr[$count]['green']
	                . ','. $arr[$count]['blue'] . ', 1)';

	        if($count === count($arr))
	        {
                echo ';';
	        }
	        else
	        {
                echo ', ';
	        }            
	    }
	}

	echo ';}</style>';

?>

<?php include('embeds/footer.php'); ?>