
var FilmSiteJs = {
	init: function(){
		this.initRegForm();
		this.initSearchForm();
		this.initGallery();
		this.initAddGallerySort();
		this.initAddLinkSort();
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
			search_auto_complete_path(), {
				minChars: 3,
				indicator: 'search_indicator',
				frequency: 1
			});
		}
	},
	initGallery: function(){
		if ($('galleryBox')){
			$('galleryBox').select("a.img_link").each(function(s){
				s.observe('click', FilmSiteJs.selectGalleryImage);
			});
		}
	},
	checkRegName: function(){
		new Ajax.Request(user_ajax_registration_path(), {
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
		new Ajax.Request(user_ajax_registration_path(), {
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
	},
	selectGalleryImage: function(event){
		$('galleryBox').select("a.img_link").each(function(s){
			s.setOpacity(1);
		});	
		var element = Event.findElement(event, 'a');
		var img = element.readAttribute('rel');
		if (img && $('mainGalleryImg')){
			var tempImg = new Image();
			tempImg.src = img;
			$('mainGalleryImg').writeAttribute('src', img);
			element.setOpacity(0.8);
		}
	},
	initAddGallerySort: function(){
		if ($('add_gallery_list') && $('js_add_film_id')){
			Sortable.create("add_gallery_list", {
		        tag: 'li', handles:$$('#add_gallery_list div.sort_cursor'),
		        onUpdate: function(){
					new Ajax.Request(film_sort_step2_path($F('js_add_film_id')),{ method: "post", postBody: Sortable.serialize('add_gallery_list')});
				}  
		    });
		}	
	},
	initAddLinkSort: function(){
		if ($('add_link_list') && $('js_add_film_id')){
			Sortable.create("add_link_list", {
		        tag: 'li', handles:$$('#add_link_list div.sort_cursor'),
		        onUpdate: function(){
					new Ajax.Request(film_sort_step3_path($F('js_add_film_id')),{ method: "post", postBody: Sortable.serialize('add_link_list')});
				}  
		    });
		}	
	}
};

Event.observe(window, 'load', function(){
	FilmSiteJs.init();
});
