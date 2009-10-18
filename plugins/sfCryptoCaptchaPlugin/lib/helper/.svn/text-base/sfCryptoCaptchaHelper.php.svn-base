<?php

function captcha_image()
{
  $ret = '<img id="captcha_img" src="'.url_for('sfCryptoCaptcha/captcha?random='.time()).'" alt="Captcha Image">';
	return $ret;
}

function captcha_reload_button()
{
  //get the refresh image
  $refresh_image = sfConfig::get('app_sf_crypto_captcha_refresh_image', '/sfCryptoCaptchaPlugin/images/reload_original.png');
  
  //extract the suffix if there is one
  $delimiter= '_-cutter'.rand(1000,9999).'-_';
  $refresh_url = url_for('@captcha_refresh?random='.$delimiter);
  $delimiter_position = strpos($refresh_url,$delimiter);
  $delimiter_length = strlen($delimiter);
  
  $length_normal_url = $delimiter_position - 1;
  $suffix_offset = $delimiter_position + $delimiter_length;
  $suffix_length = strlen($refresh_url) - $suffix_offset;
	//cut the url in pieces
	$normal_url = substr($refresh_url, 0, $length_normal_url);
	$suffix = substr($refresh_url, $suffix_offset, $delimiter_length);
	
  $onclick = 'javascript:document.getElementById(\'captcha_img\').src=\''.$normal_url.'/\'+Math.round(Math.random(0)*1000)+1+\''.$suffix.'\'';
	$ret = '<a style="cursor:pointer" onclick="'.$onclick.'">'.image_tag($refresh_image).'</a>';
	return $ret;
}
