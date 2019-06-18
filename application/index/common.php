<?php
function arr_unique($arr2d)
{
	foreach ($arr2d as $k => $v) {
		$v=join(',',$v);
		$temp[]=$v;
	}
	if($temp){
		$temp=array_unique($temp);
	//去重完毕再转换成二维数组
	foreach ($temp as $k => $v) {
		$temp[$k]=explode(',', $v);
	}
	return $temp;
	}
	
}