
var FilmSiteJs = {
	url: '/frontend_dev.php/',
	init: function(){
		this.initRegForm();
		this.initSearchForm();
	},
	initRegForm: function(){
		if ($('registration_form')) {
			if ($('registration_login')) {
				$('registration_login').observe('blur', FilmSiteJs.checkRegName)
			}
			if ($('registration_email')) {
				$('registration_email').observe('blur', FilmSiteJs.checkRegEmail)
			}
		}
	},
	initSearchForm: function(){
		if ($('search_field')){
			new Ajax.Autocompleter('search_field', 
			'search_field_auto_complete', 
			FilmSiteJs.url + 'search_auto_complete', {
				minChars: 3,
				indicator: 'search_indicator',
				frequency: 1
			});
		}
	},
	checkRegName: function(){
		new Ajax.Request(FilmSiteJs.url + 'ajax_registration', {
		  method: 'post',
		  postBody: 'login=' + $F('registration_login'),
		  onComplete: function(request) {
		  	var jdata = request.responseText.evalJSON(true);
			if (jdata.error){
				$('registration_login').addClassName('ajax_error');
				$('registration_login').removeClassName('ajax_notice');
			} else {
				$('registration_login').addClassName('ajax_notice');
				$('registration_login').removeClassName('ajax_error');
			}
		  }
		});
	},
	checkRegEmail: function(){
		new Ajax.Request(FilmSiteJs.url + 'ajax_registration', {
		  method: 'post',
		  postBody: 'email=' + $F('registration_email'),
		  onComplete: function(request) {
		  	var jdata = request.responseText.evalJSON(true);
			if (jdata.error){
				$('registration_email').addClassName('ajax_error');
				$('registration_email').removeClassName('ajax_notice');
			} else {
				$('registration_email').addClassName('ajax_notice');
				$('registration_email').removeClassName('ajax_error');
			}
		  }
		});
	}
};

Event.observe(window, 'load', function(){
	FilmSiteJs.init();
});
