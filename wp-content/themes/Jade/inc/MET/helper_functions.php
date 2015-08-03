<?php
/*
 *
 * */
function current_page_url($with_port = false) {
	$pageURL = 'http';
	if( isset($_SERVER["HTTPS"]) ) {
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80" AND $with_port) {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

/*
 *
 * */
function video_url_to_embed($url) {

	if( strpos($url,'youtube.com') > 0 ){
		$videoID = explode('v=',$url);
		$videoID = $videoID[1];

		$returnURL = 'http://www.youtube.com/embed/'.$videoID;
	}elseif(strpos($url,'vimeo.com') > 0){
		$videoID = explode('/',$url);
		$videoID = $videoID[count($videoID)-1];

		$returnURL = 'http://player.vimeo.com/video/'.$videoID;
	}else{
		$returnURL = false;
	}

	return $returnURL;
}

/*
 *
 * */
function hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	return implode(",", $rgb); // returns the rgb values separated by commas
	//return $rgb; // returns an array with the rgb values
}

/*
 *
 * */
function convert_twitter_links($status,$targetBlank=true,$linkMaxLen=250){

	// the target
	$target=$targetBlank ? " target=\"_blank\" " : "";

	// convert link to url
	$status = preg_replace("/((http:\/\/|https:\/\/)[^ )
	]+)/e", "'<a class=\"met_color\" href=\"$1\" title=\"$1\" $target >'. ((strlen('$1')>=$linkMaxLen ? substr('$1',0,$linkMaxLen).'...':'$1')).'</a>'", $status);

	// convert @ to follow
	$status = preg_replace("/(@([_a-z0-9\-]+))/i","<a class=\"met_color\" href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);

	// convert # to search
	$status = preg_replace("/(#([_a-z0-9\-]+))/i","<a class=\"met_color\" href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);

	// return the status
	return $status;
}

/*
 * Compabilty for older PHP version ( < 5.3.x )
 * */
if (!function_exists('array_replace_recursive')) {

	function mc_array_replace_recursive_recurse($array, $array1) {
		foreach ($array1 as $key => $value)
		{
			// create new key in $array, if it is empty or not an array
			if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key])))
			{
				$array[$key] = array();
			}

			// overwrite the value in the base array
			if (is_array($value))
			{
				$value = mc_array_replace_recursive_recurse($array[$key], $value);
			}
			$array[$key] = $value;
		}
		return $array;
	}

	function array_replace_recursive($array, $array1) {
		// handle the arguments, merge one by one
		$args = func_get_args();
		$array = $args[0];
		if (!is_array($array))
		{
			return $array;
		}
		for ($i = 1; $i < count($args); $i++)
		{
			if (is_array($args[$i]))
			{
				$array = mc_array_replace_recursive_recurse($array, $args[$i]);
			}
		}
		return $array;
	}
}