<?php


function make_path_resource($old_path, $new_path) {
	$old_dir = pathinfo($old_path, PATHINFO_DIRNAME);
	$new_dir = pathinfo($new_path, PATHINFO_DIRNAME);

	if (is_dir($new_dir)) {
		return true;
	} else {
		if (make_path($old_dir, $new_dir)) {
			if (mkdir($new_dir)) {
				chmod($new_dir, fileperms($old_dir));
				return true;
			}
		}
	}
	return false;
}


function make_path($path)
{
	$dir = pathinfo($path , PATHINFO_DIRNAME);

	if( is_dir($dir) )
	{
		return true;
	}
	else
	{
		if( make_path($dir) )
		{
			if( mkdir($dir) )
			{
				chmod($dir , 0777);
				return true;
			}
		}
	}

	return false;
}
