<?php
function modulus($re, $im){
	return sqrt($re*$re + $im*$im);
}
function point($x, $y, $c_re, $c_im){
	$i = 0;
	$z_re = $x/250;
	$z_im = $y/250;
	do{
		$tmp = $z_re;
		$z_re = $tmp*$tmp - $z_im*$z_im + $c_re;
		$z_im = $tmp*$z_im + $tmp*$z_im + $c_im;
		$i++;
		
	}while(modulus($z_re, $z_im)<2 && $i < 255);
	return $i;
}

$size = 500;
$c_re = -0.15;
$c_im = -0.75;

$img = imagecreate( $size, $size );
$background = imagecolorallocate( $img, 255, 255, 255 );
$black = imagecolorallocate($img, 0, 0, 0); 

for($i = 0; $i < $size; $i++){
	for($j = 0; $j < $size; $j++){
		$col = point($i, $j, $c_re, $c_im);
		$color = imagecolorexact($img, $col , $col, $col);
			 if($color==-1) {
				  //color does not exist; allocate a new one
				  $color = imagecolorallocate($img, $col, $col, $col);
			 }
		imagesetpixel($img, round($i),round($j), $color);
	}
}

header( "Content-type: image/png" );
imagepng( $img );
imagecolordeallocate( $background );
imagedestroy( $img );