<?php
class SubStringHelper extends AppHelper {

	function getString($string, $limit)
	{
		$lenght = strlen($string);
		if($lenght>$limit)
		{
			return substr($string,'0',$limit).'...Read More';
		}
		else
		{
			return  $string;
		}		
	}
}
