get_cookie=function(b){var d=" "+document.cookie;var c=" "+b+"=";var e=null;var f=0;var a=0;if(d.length>0){f=d.indexOf(c);if(f!=-1){f+=c.length;a=d.indexOf(";",f);if(a==-1){a=d.length;}e=unescape(d.substring(f,a));}}return(e);};set_cookie=function(b,d,a,g,c,f){var e=new Date();e.setDate(e.getDate()+a);document.cookie=b+"="+escape(d)+((a)?";expires="+e.toGMTString():"")+((g)?";path="+g:"")+((c)?";domain="+c:"")+((f)?";secure":"");};