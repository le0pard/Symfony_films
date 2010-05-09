// This file is part of the Carrington Mobile Theme for WordPress
// http://carringtontheme.com
//
// Copyright (c) 2008-2009 Crowd Favorite, Ltd. All rights reserved.
// http://crowdfavorite.com
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************

jQuery(function($) {
	$('div.tabbed').prepend('<ul class="tabs tabs4 hide"><li class=""><a href="#yesterday">Вчера</a></li><li class="active"><a href="#today">Сегодня</a></li><li class=""><a href="#tomorrow">Завтра</a></li><li class=""><a href="#two_days">2 дня</a></li></ul>');
	var tabs = $('ul.tabs');
	if (tabs.size()) {
		tabs.removeClass('hide');
		$('#yesterday, #today, #tomorrow, #two_days').hide();
		$('ul.tabs a[href=#yesterday]').click(function() {
			$('ul.tabs li').removeClass('active');
			$(this).parent().addClass('active');
			$('#today_tab, #tomorrow_tab, #two_days_tab').hide();
			$('#yesterday_tab').show();
			return false;
		});
		$('ul.tabs a[href=#today]').click(function() {
			$('ul.tabs li').removeClass('active');
			$(this).parent().addClass('active');
			$('#yesterday_tab, #tomorrow_tab, #two_days_tab').hide();
			$('#today_tab').show();
			return false;
		});
		$('ul.tabs a[href=#tomorrow]').click(function() {
			$('ul.tabs li').removeClass('active');
			$(this).parent().addClass('active');
			$('#yesterday_tab, #today_tab, #two_days_tab').hide();
			$('#tomorrow_tab').show();
			return false;
		});
		$('ul.tabs a[href=#two_days]').click(function() {
			$('ul.tabs li').removeClass('active');
			$(this).parent().addClass('active');
			$('#yesterday_tab, #today_tab, #tomorrow_tab').hide();
			$('#two_days_tab').show();
			return false;
		});
		$('.tabbed ul.group').css({
			'border-top': '0',
			'margin-top': '0'
		});
	}
});