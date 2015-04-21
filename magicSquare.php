<?php 
/*
## PHP Magic Square (2014)
## Author:  Siamak Aghaeipour Motlagh
## Email:   siamak.aghaeipour@gmail.com
## Website: http://blacksrc.com
*/
function magicSquare($dimension, $imgOutput = true, $options = null) {
	if($dimension%2!=0) {
		$first = ($dimension-1)/2;
		$min = 2;
		$max = $dimension*$dimension;
		$row = 0;
		$col = $first;
		$mt[$row][$col] =  1;
		for($i=$min;$i<=$max;$i++) {
			// save the current point
			$lrow = $row;
			$lcol = $col;
			// find the next point
			$row = $row - 1;
			$col = $col - 1;
			if($row < 0)
				$row = $dimension-1;	
			if($col < 0)
				$col = $dimension-1;	
			// if it was not null
			if(isset($mt[$row][$col])) {
				$row = $lrow+1;
				$col = $lcol;
			}
			// fill the array
			$mt[$row][$col] = $i;
		}
		// sort the arrays
		ksort($mt);
		for($i=0;$i<=$dimension-1;$i++) {
			ksort($mt[$i]);
		}
		if($imgOutput==false) {
			return $mt;
		} else {
			$default_options = array (
				'sideGap' => 20,
				'columnGap' => 35,
				'fontSize' => 8,
				'sumGap' => 50,
				'fontPath' => 'tahoma.TTF',
				'bgColor' => array(230,230,230),
				'lineColor' => array(100,100,100),
				'digitColor' => array(0,0,0),
				'centerDigitColor' => array(255,0,0)
			);
			if($options != null) {
				$default_options = array_merge($default_options,$options);
			}
			$sidegap = $default_options['sideGap'];
			$colgap = $default_options['columnGap'];
			$font_size = $default_options['fontSize'];
			$sumgap = $default_options['sumGap'];
			$font = $default_options['fontPath'];
			$edggap = $sidegap/2;
			$max_x = ($dimension*$colgap)+$sidegap;
			$max_y = $max_x;
			$img = imagecreatetruecolor($max_x+$sumgap, $max_y+$sumgap);
			$linec = imagecolorallocate($img, $default_options['lineColor'][0], $default_options['lineColor'][1], $default_options['lineColor'][2]);
			$digitOC = imagecolorallocate($img,$default_options['digitColor'][0], $default_options['digitColor'][1], $default_options['digitColor'][2]);
			$digitCC = imagecolorallocate($img, $default_options['centerDigitColor'][0], $default_options['centerDigitColor'][1], $default_options['centerDigitColor'][2]);
			$bgc = imagecolorallocate($img, $default_options['bgColor'][0], $default_options['bgColor'][1], $default_options['bgColor'][2]);
			imagefill($img, 0, 0, $bgc);
			// draw col lines
			$x1 = $edggap;
			$y1 = $edggap;
			$x2 = $edggap;
			$y2 = $max_y - $edggap;
			for($i=0; $i<=$dimension; $i++) {
				imageline($img, $x1, $y1, $x2, $y2, $linec);
				$x1 = $x1 + $colgap;
				$x2 = $x2 + $colgap;
			}
			// draw row lines
			$x1 = $edggap;
			$y1 = $edggap;
			$x2 = $max_x - $edggap;
			$y2 = $edggap;
			for($i=0; $i<=$dimension; $i++) {
				imageline($img, $x1, $y1, $x2, $y2, $linec);
				$y1 = $y1 + $colgap;
				$y2 = $y2 + $colgap;
			}
			// write digits into cells
			$txt_point_x = ($colgap/2)+($edggap/4);
			$txt_point_y = $colgap;
			$jj=0;
			$ii=0;
			$sum_x=0;
			for($i=1; $i<=($dimension*$dimension);$i++) {
				// write the digits
				if($i%((($dimension*$dimension)+1)/2) == 0 /*&& ($dimension%2!=0)*/) 
					$digitc = $digitCC;	
				else 
					$digitc = $digitOC;
				imagettftext($img, $font_size, 0, $txt_point_x, $txt_point_y, $digitc, $font, $mt[$ii][$jj]);
				// sum of rows
				$sum_x = $sum_x + $mt[$ii][$jj];
				if($i%$dimension==0) {
					// write sum of rows
					imagettftext($img, $font_size, 0, $txt_point_x+$sumgap/2, $txt_point_y, $digitc, $font, ' = '.$sum_x);
					$txt_point_y += $colgap;
					$txt_point_x = ($colgap/2)+($edggap/4);
					$jj=0;
					$ii++;
					$sum_x=0;
				} else {
					$txt_point_x += $colgap;
					$jj++;
				}
			}
			// img output
			header ('Content-Type: image/jpeg');  	
			imagejpeg($img);
			imagedestroy($img);
		}
	} else {
		return 'The algorithm is not ready for even numbers yet!';
	}
}
?>

