<?php
include "GifCreator.php";

// Create an array containing file paths, resource var (initialized with imagecreatefromXXX), 
// image URLs or even binary code from image files.
// All sorted in order to appear.
$frames = array();

// Create an array containing the duration (in millisecond) of each frames (in order too)
$durations = array();

for($i=0; $i<=$_GET['max']; $i++){
	$durations[] = 2;
	$frames[]= file_get_contents('img/'.$i.'.png');
}

// Initialize and create the GIF !
$gc = new GifCreator\GifCreator();
$gc->create($frames, $durations, 0);

$gifBinary = $gc->getGif();

file_put_contents('animation.gif', $gifBinary);