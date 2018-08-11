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