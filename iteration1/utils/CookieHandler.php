<?php

class CookieHandler {
	
	public static function setCookie($name, $value) {
		setCookie($name,$value,time()+3600*24*365); // 1 year
	}
	
	public static function isSetCookie($name) {
		return isset($_COOKIE[$name]);
	}
	
	public static function getCookie($name) {
		return $_COOKIE[$name];
	}
	
	public static function destroyCookie($name) {
		setCookie($name,"",time()-3600);
	}
	
}

?>