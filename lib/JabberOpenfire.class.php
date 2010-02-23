<?php
// jabber integration (openfire && User Service plugin) 
// 

class JabberOpenfire {
	static private $secret = '5hxjGNNMwCCAQ9BY';
	static private $url = 'http://coocoorooza.com:9091/plugins/userService/userservice';
	
	static public function add_user($username, $password, $email){
		$content = file_get_contents(self::$url."?type=add&secret=".self::$secret.
			"&username=".$username."&password=".$password."&name=".$username."&email=".$email);
		if ("<result>ok</result>" == $content){
			return true;
		} else {
			return false;
		}
	}
	
	static public function edit_user($username, $new_password, $new_email){
		$content = file_get_contents(self::$url."?type=update&secret=".self::$secret.
			"&username=".$username."&password=".$new_password."&name=".$username."&email=".$new_email);
		if ("<result>ok</result>" == $content){
			return true;
		} else {
			return false;
		}
	}
	
	static public function delete_user($username){
		$content = file_get_contents(self::$url."?type=delete&secret=".self::$secret.
			"&username=".$username);
		if ("<result>ok</result>" == $content){
			return true;
		} else {
			return false;
		}
	}
}
