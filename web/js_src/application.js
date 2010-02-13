/*
 * @author leopard
 * 
 */
var FilmSiteJs = {
	scrollPadding: 0,
	maxScrollAfisha: 4,

	init: function(){
		this.initFlashHider();
		this.initRegForm();
		this.initSearchForm();
		/*this.initGallery();*/
		this.initAddGallerySort();
		this.initAddLinkSort();
		this.initAddTrailerSort();
		this.initGalleryMultUploader();
		this.initAfisha();
		this.initRating();
		this.initTextarea();
		this.initAfishaTopFilms();
	},
	initRegForm: function(){
		if ($('registration_form')) {
			if ($('registration_login')) {
				$('registration_login').observe('blur', FilmSiteJs.checkRegName);
			}
			if ($('registration_email')) {
				$('registration_email').observe('blur', FilmSiteJs.checkRegEmail);
			}
		}
	},
	initSearchForm: function(){
		if ($('search_field_input')){
			new Ajax.Autocompleter('search_field_input', 
			'search_field_auto_complete', 
			search_auto_complete_path(), {
				minChars: 3,
				indicator: 'search_indicator',
				frequency: 1
			});
			
			$('search_field_input').observe('focus', function(event){
				if ($F('search_field_input') == 'Поиск'){
					$('search_field_input').value = '';
				}
			});
			
			$('search_field_input').observe('blur', function(event){
				if ($F('search_field_input') == ''){
					$('search_field_input').value = 'Поиск';
				}
			});
			
			if ($('search_tip') && $('search_tip_descr')){
				$('search_tip').observe('click', function(event){
					$('search_tip_descr').toggle();
				});
			}	
		}
	},
/*	
	initGallery: function(){
		if ($('gallery_list')){
			$('gallery_list').select("a.img_link").each(function(s){
				s.observe('click', FilmSiteJs.selectGalleryImage);
			});
			
		}
	},
*/	
	checkRegName: function(){
		new Ajax.Request(user_ajax_registration_path(), {
		  method: 'post',
		  postBody: 'login=' + $F('registration_login'),
		  onComplete: function(request) {
		  	var jdata = request.responseText.evalJSON(true);
			if (jdata.error){
				$('registration_login').addClassName('ajax_input_error');
				$('registration_login').removeClassName('ajax_input_notice');
			} else {
				$('registration_login').addClassName('ajax_input_notice');
				$('registration_login').removeClassName('ajax_input_error');
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
				$('registration_email').addClassName('ajax_input_error');
				$('registration_email').removeClassName('ajax_input_notice');
			} else {
				$('registration_email').addClassName('ajax_input_notice');
				$('registration_email').removeClassName('ajax_input_error');
			}
		  }
		});
	},
/*	
	selectGalleryImage: function(event){
		$('gallery_list').select("a.img_link").each(function(s){
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
		
		Position.prepare();
		container_x = Position.cumulativeOffset($('gallery_list_box'))[0];
		element_x = Position.cumulativeOffset(element)[0];
		new Effect.Scroll('gallery_list_box', {x:(element_x-container_x - 200), y:0});
	},
*/	
	initAddGallerySort: function(){
		if ($('add_gallery_list') && $('js_add_film_id')){
			Sortable.create("add_gallery_list", {
		        tag: 'li', handles:$$('#add_gallery_list a.drag_right'),
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
	},
	initAddTrailerSort: function(){
		if ($('add_trailer_list') && $('js_add_film_id')){
			Sortable.create("add_trailer_list", {
		        tag: 'li', handles:$$('#add_trailer_list div.sort_cursor'),
		        onUpdate: function(){
					new Ajax.Request(film_sort_step4_path($F('js_add_film_id')),{ method: "post", postBody: Sortable.serialize('add_trailer_list')});
				}  
		    });
		}
	},	
	initGalleryMultUploader: function(){
		if ($('upload_gallery_form') && $('upload_gallery_link') && $('uploadLink')){
			$('upload_gallery_link').observe('click', FilmSiteJs.showHideMultUploader);
			$('uploadLink').observe('click', YUIUploader.upload);
		}	
	},
	showHideMultUploader: function(){
		if ($('upload_gallery_form').visible()){
			$('upload_gallery_form').blindUp();
		} else {
			$('upload_gallery_form').blindDown();
		}	
	},
	initRating: function(){
		if ($('rating_film')){
			var rating_film = new Control.Rating('rating_film',{
				max: 10, 
				rated: false,
				updateOptions: {
					method: 'post',
					onComplete: function(request){
						if ($('film_vote')){
							$('film_vote').update(request.responseText);
							if ($('rating_film_done')){
								var rating_film_done = new Control.Rating('rating_film_done',{
									max: 10, 
									rated: true,
									value: $('rating_film_done').readAttribute('rel')
								});
							}
						}
					}
				},
				updateParameterName: 'rating',
				updateUrl: film_raiting_path($('rating_film').readAttribute('rel'))	
			});
		}
		if ($('rating_film_done')){
			var rating_film_done = new Control.Rating('rating_film_done',{
				max: 10, 
				rated: true,
				value: $('rating_film_done').readAttribute('rel')
			});
		}
	},
	initAfisha: function(){
		if ($('afisha_country') && $('afisha_city') && $('afisha_city_box')){
			$('afisha_country').observe('change', FilmSiteJs.changeAfishaCountry);
			$('afisha_city').observe('change', FilmSiteJs.changeAfishaCity);
		}
	},
	changeAfishaCountry: function(){
		new Ajax.Updater('afisha_city_box', afisha_get_cities_path($F('afisha_country')), {
			method: 'post',
			onComplete: function(request) {
				$('afisha_city').observe('change', FilmSiteJs.changeAfishaCity);
			}
		});
	},
	changeAfishaCity: function(){
		if ($('afisha_film_id')){
			location.href = afisha_film_city_path($F('afisha_film_id'),$F('afisha_city'));
		} else {	
			location.href = afisha_get_shows_path($F('afisha_city'));
		}
	},
	initTextarea: function(){
		var textarea_id = null;
		if ($('profile_about')){
			textarea_id = 'profile_about';
		} else if ($('film_add_about')){
			textarea_id = 'film_add_about';
		} else if ($('comments_description')){
			textarea_id = 'comments_description';
		}	
		
		if (textarea_id){
			var textarea = new Control.TextArea(textarea_id);  
			var toolbar = new Control.TextArea.ToolBar(textarea);  
			toolbar.container.id = 'markdown_toolbar'; //for css styles
					
			toolbar.addButton('Bold',function(){  
				this.wrapSelection('<b>','</b>');  
			},{  
				id: 'markdown_bold_button'  
			});  
			toolbar.addButton('Italics',function(){  
				this.wrapSelection('<i>','</i>');  
			},{  
				id: 'markdown_italics_button'  
			}); 
			toolbar.addButton('Link',function(){  
				var selection = this.getSelection();  
				var response = prompt('Укажите ссылку','');  
				if(response == null) return;  
				var url = (response == '' ? 'http://link_url/' : response).replace(/^(?!(f|ht)tps?:\/\/)/,'http://');
				this.replaceSelection('<a href="' + url + '">' + (selection == '' ? 'Link Text' : selection) + '</a>');  
			},{  
				id: 'markdown_link_button'  
			});
			toolbar.addButton('Image',function(){  
				var selection = this.getSelection();  
				var response = prompt('Enter Image URL','');  
				if(response == null) return;
				var img_url = (response == '' ? 'http://image_url/' : response).replace(/^(?!(f|ht)tps?:\/\/)/,'http://');
				this.replaceSelection('<img src="' + img_url + '" alt="' + (selection == '' ? 'Image Alt Text' : selection) + '" />');  
			},{  
				id: 'markdown_image_button'  
			});
		}
	},
	initAfishaTopFilms: function(){
		if ($('scrl_left_afisha') && $('scrl_right_afisha') && $('afisha_list_2')){
			
			var element = 'afisha_today_box';
			var child = 'afisha_list_2';
			var scroll_counter = 2;
			var is_scroll = false;
			
			$(element).scrollLeft = Position.cumulativeOffset($(child))[0] - Position.cumulativeOffset($(element))[0];
			
			$('scrl_left_afisha').observe('click', function(event){
				
				if (is_scroll){
					return false;
				}	
				
				scroll_counter = scroll_counter - 1;
				if (scroll_counter < 1) scroll_counter = FilmSiteJs.maxScrollAfisha;

				Position.prepare();
				container_x = Position.cumulativeOffset($(element))[0];
				element_x = Position.cumulativeOffset($(child))[0];
				new Effect.Scroll(element, {x:(element_x-container_x), y:0,
					beforeSetup: function(effect){
						var childs = $(element).childElements();
						if (childs.length && childs[0] && childs[childs.length - 1]){
							var el = childs[childs.length - 1].cloneNode(true);
							childs[childs.length - 1].remove();
							childs[0].insert({before: el});
						}
						$(element).scrollLeft = Position.cumulativeOffset($(child))[0] - Position.cumulativeOffset($(element))[0];
						is_scroll = true;
					},
					afterFinishInternal: function(effect){
						child = 'afisha_list_' + scroll_counter;
						is_scroll = false;
					}
				});

			});

			$('scrl_right_afisha').observe('click', function(event){
				
				if (is_scroll){
					return false;
				}
				
				scroll_counter = scroll_counter + 1;
				if (scroll_counter > FilmSiteJs.maxScrollAfisha) scroll_counter = 1;
				
				Position.prepare();
				container_x = Position.cumulativeOffset($(element))[0];
				element_x = Position.cumulativeOffset($(child))[0];
				new Effect.Scroll(element, {x:(element_x-container_x), y:0,
					beforeSetup: function(effect){
						var childs = $(element).childElements();
						if (childs.length && childs[0] && childs[childs.length - 1]){
							var el = childs[0].cloneNode(true);
							childs[0].remove();
							childs[childs.length - 1].insert({after: el});
						}
						$(element).scrollLeft = Position.cumulativeOffset($(child))[0] - Position.cumulativeOffset($(element))[0];
						is_scroll = true;
					},
					afterFinishInternal: function(effect){
						child = 'afisha_list_' + scroll_counter;
						is_scroll = false;
					}
				});

			});
		}
	},
	initFlashHider: function(){
		if ($('flash_success') || $('flash_error')){
			setTimeout(FilmSiteJs.flashHiderOn, 5000);
		}	
	},
	flashHiderOn: function(){
		if ($('flash_success')){
			Effect.BlindUp('flash_success', {duration: 0.8, scaleMode: 'contents'});
		} else if ($('flash_error')){
			Effect.BlindUp('flash_error', {duration: 0.8, scaleMode: 'contents'});
		}
	}	
};

Event.observe(window, 'load', function(){
	FilmSiteJs.init();
});
