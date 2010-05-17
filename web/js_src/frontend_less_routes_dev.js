var less_routes_prefix_url = '/frontend_dev.php';
captcha_demo_path = function(){ return less_routes_prefix_url + '/captcha_demo.html'; }
captcha_refresh_path = function(random){ return less_routes_prefix_url + '/captcha/' + random + '.html'; }
captcha_path = function(){ return less_routes_prefix_url + '/captcha.html'; }
user_login_path = function(){ return less_routes_prefix_url + '/login.html'; }
user_registration_path = function(){ return less_routes_prefix_url + '/registration.html'; }
user_ajax_registration_path = function(){ return less_routes_prefix_url + '/ajax_registration.html'; }
user_registration_done_path = function(){ return less_routes_prefix_url + '/registration_done.html'; }
user_activate_path = function(id, persistence_token){ return less_routes_prefix_url + '/activate/' + id + '/' + persistence_token + '.html'; }
user_forgot_pass_path = function(){ return less_routes_prefix_url + '/forgot_pass.html'; }
user_forgot_pass_token_path = function(id, persistence_token){ return less_routes_prefix_url + '/forgot_pass_token/' + id + '/' + persistence_token + '.html'; }
user_profile_path = function(){ return less_routes_prefix_url + '/profile.html'; }
user_change_password_path = function(){ return less_routes_prefix_url + '/change_password.html'; }
user_logout_path = function(){ return less_routes_prefix_url + '/logout.html'; }
user_films_list_path = function(){ return less_routes_prefix_url + '/unpublic_films.html'; }
user_moder_films_list_path = function(){ return less_routes_prefix_url + '/unvisible_films.html'; }
user_show_path = function(id){ return less_routes_prefix_url + '/userinfo/' + id + '.html'; }
search_path = function(){ return less_routes_prefix_url + '/search.html'; }
search_auto_complete_path = function(){ return less_routes_prefix_url + '/search_auto_complete.html'; }
film_types_all_path = function(){ return less_routes_prefix_url + '/cathegory/all.html'; }
film_types_all_pages_path = function(page){ return less_routes_prefix_url + '/cathegory/all/' + page + '.html'; }
film_types_all_atom_path = function(){ return less_routes_prefix_url + '/cathegory/all.atom'; }
film_types_all_rss_path = function(){ return less_routes_prefix_url + '/cathegory/all.rss'; }
film_types_path = function(id, url){ return less_routes_prefix_url + '/cathegory/' + id + '/' + url + '.html'; }
film_types_rss_path = function(id, url){ return less_routes_prefix_url + '/cathegory/' + id + '/' + url + '.rss'; }
film_types_atom_path = function(id, url){ return less_routes_prefix_url + '/cathegory/' + id + '/' + url + '.atom'; }
film_year_path = function(year){ return less_routes_prefix_url + '/year/' + year + '.html'; }
film_year_pager_path = function(year, page){ return less_routes_prefix_url + '/year/' + year + '/' + page + '.html'; }
film_add_step1_path = function(){ return less_routes_prefix_url + '/film/add1.html'; }
film_edit_step1_path = function(id){ return less_routes_prefix_url + '/film/edit1/' + id + '.html'; }
film_delete_step1_path = function(id){ return less_routes_prefix_url + '/film/delete1/' + id + '.html'; }
film_add_step2_path = function(id){ return less_routes_prefix_url + '/film/add2/' + id + '.html'; }
film_add_swf_step2_path = function(id){ return less_routes_prefix_url + '/film/add_swf2/' + id + '.html'; }
film_edit_step2_path = function(id){ return less_routes_prefix_url + '/film/edit2/' + id + '.html'; }
film_sort_step2_path = function(id){ return less_routes_prefix_url + '/film/sort2/' + id + '.html'; }
film_delete_gallery_path = function(id){ return less_routes_prefix_url + '/film/delete_gallery/' + id + '.html'; }
film_add_step3_path = function(id){ return less_routes_prefix_url + '/film/add3/' + id + '.html'; }
film_edit_step3_path = function(id){ return less_routes_prefix_url + '/film/edit3/' + id + '.html'; }
film_sort_step3_path = function(id){ return less_routes_prefix_url + '/film/sort3/' + id + '.html'; }
film_delete_step3_path = function(id){ return less_routes_prefix_url + '/film/delete_link/' + id + '.html'; }
film_add_step4_path = function(id){ return less_routes_prefix_url + '/film/add4/' + id + '.html'; }
film_edit_step4_path = function(id){ return less_routes_prefix_url + '/film/edit4/' + id + '.html'; }
film_sort_step4_path = function(id){ return less_routes_prefix_url + '/film/sort4/' + id + '.html'; }
film_delete_step4_path = function(id){ return less_routes_prefix_url + '/film/delete_trailer/' + id + '.html'; }
film_add_final_path = function(id){ return less_routes_prefix_url + '/film/add_final/' + id + '.html'; }
film_twitter_path = function(id){ return less_routes_prefix_url + '/film/twitter/' + id + '.html'; }
film_show_path = function(id, url){ return less_routes_prefix_url + '/film/' + id + '/' + url + '.html'; }
film_raiting_path = function(id){ return less_routes_prefix_url + '/film/raiting/' + id + '.html'; }
comment_add_path = function(id){ return less_routes_prefix_url + '/comment/add/' + id + '.html'; }
comment_edit_path = function(id){ return less_routes_prefix_url + '/comment/edit/' + id + '.html'; }
comment_delete_path = function(id){ return less_routes_prefix_url + '/comment/delete/' + id + '.html'; }
comments_last_list_path = function(){ return less_routes_prefix_url + '/comments_list.html'; }
go_by_link_id_path = function(id, hash){ return less_routes_prefix_url + '/go/' + id + '/' + hash + '.html'; }
static_page_path = function(id, url){ return less_routes_prefix_url + '/page/' + id + '/' + url + '.html'; }
news_all_path = function(){ return less_routes_prefix_url + '/news.html'; }
news_page_all_path = function(page){ return less_routes_prefix_url + '/news/' + page + '.html'; }
news_xml_all_path = function(){ return less_routes_prefix_url + '/news.xml'; }
news_atom_all_path = function(){ return less_routes_prefix_url + '/news.xml'; }
news_one_path = function(id, url){ return less_routes_prefix_url + '/news/' + id + '/' + url + '.html'; }
afisha_path = function(){ return less_routes_prefix_url + '/afisha.html'; }
afisha_get_shows_by_date_path = function(id, year, month, day){ return less_routes_prefix_url + '/afisha/city/' + id + '/date/' + year + '/' + month + '/' + day + '.html'; }
afisha_get_shows_path = function(id){ return less_routes_prefix_url + '/afisha/city/' + id + '.html'; }
afisha_get_cities_path = function(id){ return less_routes_prefix_url + '/afisha_get_cities/' + id + '.html'; }
afisha_cinema_by_date_path = function(id, year, month, day){ return less_routes_prefix_url + '/afisha/cinema/' + id + '/date/' + year + '/' + month + '/' + day + '.html'; }
afisha_cinema_path = function(id){ return less_routes_prefix_url + '/afisha/cinema/' + id + '.html'; }
afisha_film_by_date_path = function(id, year, month, day){ return less_routes_prefix_url + '/afisha/film/' + id + '/date/' + year + '/' + month + '/' + day + '.html'; }
afisha_film_path = function(id){ return less_routes_prefix_url + '/afisha/film/' + id + '.html'; }
afisha_film_city_path = function(id, city_id){ return less_routes_prefix_url + '/afisha/film/' + id + '/city/' + city_id + '.html'; }
afisha_film_city_by_date_path = function(id, city_id, year, month, day){ return less_routes_prefix_url + '/afisha/film/' + id + '/city/' + city_id + '/date/' + year + '/' + month + '/' + day + '.html'; }
afisha_films_today_ajax_path = function(){ return less_routes_prefix_url + '/afisha_films_today.html'; }
static_page_verlihub_path = function(){ return less_routes_prefix_url + '/statistic_verlihub.html'; }
static_page_jabber_path = function(){ return less_routes_prefix_url + '/statistic_jabber.html'; }
static_page_rules_path = function(){ return less_routes_prefix_url + '/statistic_rules.html'; }
static_page_contacts_path = function(){ return less_routes_prefix_url + '/statistic_contacts.html'; }
statistic_path = function(){ return less_routes_prefix_url + '/statistic.html'; }
statistic_cathegory_films_path = function(){ return less_routes_prefix_url + '/statistic_cathegory_films.html'; }
statistic_films_by_day_path = function(){ return less_routes_prefix_url + '/statistic_films_by_day.html'; }
sitemap_path = function(){ return less_routes_prefix_url + '/sitemap.xml'; }
page_404error_page_path = function(){ return less_routes_prefix_url + '/index/error404.html'; }
service_webslice_main_path = function(){ return less_routes_prefix_url + '/service/webslice.html'; }
service_webslice_city_path = function(city_id){ return less_routes_prefix_url + '/service/webslice/' + city_id + '.html'; }
mobile_afisha_film_path = function(id){ return less_routes_prefix_url + '/mobile/afisha/film/' + id + '.html'; }
mobile_afisha_cinema_path = function(id){ return less_routes_prefix_url + '/mobile/afisha/cinema/' + id + '.html'; }
mobile_afisha_cinemas_path = function(city_id){ return less_routes_prefix_url + '/mobile/afisha/cinemas/' + city_id + '.html'; }
mobile_afisha_path = function(){ return less_routes_prefix_url + '/mobile/afisha.html'; }
mobile_afisha_pages_path = function(page){ return less_routes_prefix_url + '/mobile/afisha/' + page + '.html'; }
film_poster_mobile_path = function(id){ return less_routes_prefix_url + '/mobile/film_poster/' + id + '.html'; }
film_mobile_path = function(id){ return less_routes_prefix_url + '/mobile/film/' + id + '.html'; }
films_mobile_path = function(page){ return less_routes_prefix_url + '/mobile/films/' + page + '.html'; }
search_mobile_path = function(){ return less_routes_prefix_url + '/mobile/search.html'; }
homepage_mobile_path = function(){ return less_routes_prefix_url + '/'; }
homepage_standard_path = function(){ return less_routes_prefix_url + '/'; }
homepage_path = function(){ return less_routes_prefix_url + '/'; }
