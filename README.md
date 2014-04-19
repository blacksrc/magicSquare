magicSquare
===========

Simple PHP function to generate odd dimentional magic square within GD library.

### How To Do:
FirstDownload `magicSquare.php` and tahmoa.ttf files. Then include the magicSquare.php to the page.
```php
  include './magicSquare.php';
```
Then use it like this (the number must be odd):
```php
  magicSquare(11);
```
Output will be:<br>
![](https://cloud.githubusercontent.com/assets/1394580/2749448/27ff6752-c803-11e3-8413-40ac383b828a.jpg "")

Also you can just create the output as an array without creating the image.
```php
magicSquare(11, false);
```
You can change some options too.
```php
$options = array (
			'sideGap' => 20,
			'columnGap' => 35,
			'fontSize' => 8, // font size
			'sumGap' => 50,
			'fontPath' => 'tahoma.TTF',
			'bgColor' => array(230,230,230), // color RGB
			'lineColor' => array(100,100,100), // color RGB
			'digitColor' => array(0,0,0), // color RGB
			'centerDigitColor' => array(255,0,0) // color RGB
		);
magicSquare(11, true, $options);
```

