<?php
//來源資料
$jsonstr = '{"id":1,"width":1920,"height":1080,"zones":[{"id":1,"width":500,"height":880,"left":0,"top":0,"name":"zone1"},{"id":2,"width":1420,"height":200,"left":500,"top":0,"name":"zone2"},{"id":3,"width":1920,"height":200,"left":0,"top":880,"name":"zone3"},{"id":4,"width":1420,"height":680,"left":500,"top":200,"name":"zone4"}]}';
$arr = json_decode($jsonstr,true);
//字型檔
$font = 'arial.ttf';
//邊界
$margin = 30;
// create a image
$img = imagecreatetruecolor(($arr['width']+($margin*2)), ($arr['height']+($margin*2)));
// 設定顏色
$white = imagecolorallocate($img, 255, 255, 255);
$red   = imagecolorallocate($img, 255, 0, 0);
$black = imagecolorallocate($img, 0, 0, 0);
// 填滿畫布
imagefill($img, 0, 0, $white);
// 畫空心矩形layout (底圖, X1座標, Y1座標, X2座標, Y2座標, 顏色);
imagerectangle($img, $margin, $margin, ($margin+$arr['width']), ($margin+$arr['height']), $black);
//畫區塊
foreach($arr['zones'] as $row)
{
	// 畫空心矩形(底圖, X1座標, Y1座標, X2座標, Y2座標, 顏色);
	imagerectangle($img, ($row['left']+$margin), ($row['top']+$margin), ($row['width']+$row['left']+$margin) , ($row['height']+$row['top']+$margin), $red);
	// 畫True Type文字(底圖, 大小, 角度, X座標, Y座標, 顏色, 字型, 文字); 注意:支援中文字型
	imagettftext( $img, 100, 0, ($margin*3+$row['left']), ($margin*6+$row['top']), $red, $font, $row['id']);
}

// output image in the browser
header("Content-type: image/png");
imagepng($img);

// free memory
imagedestroy($img);
?>
