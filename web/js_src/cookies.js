get_cookie = function(name) {
var cookie = " " + document.cookie;
var search = " " + name + "=";
var set_str = null;
var offset = 0;
var end = 0;
if (cookie.length > 0) {
	offset = cookie.indexOf(search);
	if (offset != -1) {
		offset += search.length;
		end = cookie.indexOf(";", offset)
			if (end == -1)
				end = cookie.length;
			
			set_str = unescape(cookie.substring(offset, end));
		}
	}
	return(set_str);
}

set_cookie = function(c_name, value, expiredays, path, domain, secure){
  var exdate=new Date();
  exdate.setDate(exdate.getDate()+expiredays);
  document.cookie = c_name + "=" +escape( value ) +
    ( ( expiredays ) ? ";expires=" + exdate.toGMTString() : "" ) +
    ( ( path ) ? ";path=" + path : "" ) +
    ( ( domain ) ? ";domain=" + domain : "" ) +
    ( ( secure ) ? ";secure" : "" );
}