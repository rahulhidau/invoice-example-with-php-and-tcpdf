<?php
function check_empty($variable, $text)
{
	if(empty($variable))
	{
		echo $text;
		die();
	}
}
function htmlen($string)
{
	global $conn;
	$return = htmlentities($string);
	return $return;
}

function check_numeric($integer, $message)
{
	if(!is_numeric($integer))
	{
		echo $message;
		die();
	}
}
?>