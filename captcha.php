<?php
    session_start();


$image = imagecreate(100, 30);//图片大小
$bgcolor = imagecolorallocate($image, 255, 255, 255);//底图颜色
imagefill($image, 0, 0, $bgcolor);


//生成验证码
/*
for($i=0;$i<4;$i++){
    $fontsize=6;//字体大小
    $fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));//颜色随机深色
    $fontcontent=rand(0,9);//随机生成数字

    $x=($i*100/4)+rand(5,10);
    $y=rand(5,10);

    imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);//画数字
    
    }
*/




//字母加数字验证码
$captch_code='';
for($i =0;$i<4;$i++){
    $fontsize = 6;
    $fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
    
    $data = 'abcdefghijkmnopqrstuvwxy3456789';
    $fontcontent = substr($data,rand(0,strlen($data))-1,1);
    $captch_code = $fontcontent;

    $x=($i*100/4)+rand(5,10);
    $y=rand(5,10);
    
    imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
    }
$_SESSION['authcode']=$captch_code;

//生成点干扰元素
for($i=0;$i<200;$i++){
    $pointcolor = imagecolorallocate($image,rand(50,200),rand(50,200),rand(50,200));
    imagesetpixel($image,rand(1,99),rand(1,99),$pointcolor);
    }
//生成线干扰元素
for($i=0;$i<3;$i++){
    $linecolor = imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
    imageline($image,rand(1,99),rand(1,29),rand(1,99),rand(1,29),$linecolor);
}






header('content-type:image/png');

imagepng($image);

imagedestroy($image);