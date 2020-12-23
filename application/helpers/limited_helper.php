<?php
function limit_append($str)
{
	$str = strip_tags($str);
		if (strlen($str) > 20)
		{
			$stringCut = substr($str, 0, 20);
			$endPoint = strrpos($stringCut, ' ');
			$str = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
			$str .= '...';
		}
		return $str;
}
?>