<?php 
set_time_limit(0);

$image = imagecreatefromjpeg("test.jpg");

if($image)
{
    imagepalettetotruecolor($image);
    list($width, $height, $type, $attr) = getimagesize("test.jpg");
    $result = imagecreatetruecolor($width, $height);

    for($x=0; $x<$width; $x++)
    {
        for($y=0; $y<$height; $y++)
        {
            $rgb = imagecolorat($image, $x, $y);
            $rr = ($rgb >> 16) & 0xFF;
            $gg = ($rgb >> 8) & 0xFF;
            $bb = $rgb & 0xFF;

            $color = round(($rr + $gg + $bb) / 3);

            $value = imagecolorallocate($result, $color, $color, $color);

            imagesetpixel($result, $x, $y, $value);

        }
    }

    header('Content-type: image/jpeg');
    imagejpeg($result);

}

?>