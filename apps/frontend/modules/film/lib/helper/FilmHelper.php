<?php

function file_info_format($file_info_str){
	if ($file_info_str){
		$strings = explode("\n", $file_info_str);
		$new_string = array();
		foreach ($strings as $str){
			if (strpos($str, ":") !== false){
				$s_text = explode(":", $str);
				$bold_text = $s_text[0];
				array_shift($s_text);
				$new_string[] = "<b>".$bold_text.":</b>".implode(":", $s_text);
			} else {
				$new_string[] = $str;
			}
		}
		return nl2br(implode("\n", $new_string));
	} else {
		return "";
	}
}