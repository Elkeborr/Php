<?php

function detectColors($image, $num, $level = 5)
{
    $level = (int) $level;
    $palette = array();
    $size = getimagesize($image);
    if (!$size) {
        return false;
    }
    switch ($size['mime']) {
      case 'image/jpeg':
        $img = imagecreatefromjpeg($image);
        break;
      case 'image/png':
        $img = imagecreatefrompng($image);
        break;
      case 'image/gif':
        $img = imagecreatefromgif($image);
        break;
      default:
        return false;
    }
    if (!$img) {
        return false;
    }
    for ($i = 0; $i < $size[0]; $i += $level) {
        for ($j = 0; $j < $size[1]; $j += $level) {
            $thisColor = imagecolorat($img, $i, $j);
            $rgb = imagecolorsforindex($img, $thisColor);
            $color = sprintf('%02X%02X%02X', (round(round(($rgb['red'] / 0x33)) * 0x33)), round(round(($rgb['green'] / 0x33)) * 0x33), round(round(($rgb['blue'] / 0x33)) * 0x33));
            $palette[$color] = isset($palette[$color]) ? ++$palette[$color] : 1;
        }
    }
    arsort($palette);

    return array_slice(array_keys($palette), 0, $num);
}
