<?php

function preview_trailer_link($trailer){
	if ($trailer){
		$url_b = '<a href="';
		$url_e = '" target="_blank">Просмотреть</a>';
		$url_href = "#";
		switch($trailer->getTrailerType()){
			//youtube
			case 1:
				$url_href = "http://www.youtube.com/watch?v=".$trailer->getTrailerCode();
				break;
			//vimeo	
			case 2:
				$url_href = "http://www.vimeo.com/".$trailer->getTrailerCode();
				break;
			//rutube
			case 3:
				$url_href = "http://video.rutube.ru/".$trailer->getTrailerCode();
				break;
		}
		return $url_b.$url_href.$url_e;
	} else {
		return "";
	}
}