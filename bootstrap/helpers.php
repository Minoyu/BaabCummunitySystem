<?php
function numForHuman($num) {
    $k = 1000;
    $m = 1000000;
    if ($num>=$m){
        return floor($num/$m).__('other.million');
    }elseif ($num>=$k){
        return floor($num/$k).__('other.thousand');
    }else{
        return $num;
    }
}

function decodeBase64ImgToFile($image){
    $userId = Auth::id();
    $imageName = "tmpImg-".$userId . '-' . date('Y-m-d-H-i-s') . '-' . uniqid() .'.jpeg';
    if (strstr($image,",")){
        $image = explode(',',$image);
        $image = $image[1];
    }
    Storage::disk('base64ImgTmp')->put($imageName, base64_decode($image));
    $realPath= public_path()."/uploads/tmp/base64Img/". $imageName;  //图片名字
    return $realPath;
}