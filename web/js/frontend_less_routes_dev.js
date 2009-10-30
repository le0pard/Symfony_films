var less_routes_prefix_url = '/frontend_dev.php';
captcha_demo_path = function(){ return less_routes_prefix_url + '/captcha_demo.html'; }
captcha_refresh_path = function(random){ return less_routes_prefix_url + '/captcha/' + random + '.html'; }
captcha_path = function(){ return less_routes_prefix_url + '/captcha.html'; }
user_login_path = function(){ return less_routes_prefix_url + '/login.html'; }
user_registration_path = function(){ return less_routes_prefix_url + '/registration.html'; }
user_ajax_registration_path = function(){ return less_routes_prefix_url + '/ajax_registration.html'; }
user_profile_path = function(){ return less_routes_prefix_url + '/profile.html'; }
user_films_list_path = function(){ return less_routes_prefix_url + '/unpublic_films.html'; }
user_logout_path = function(){ return less_routes_prefix_url + '/logout.html'; }
user_show_path = function(id){ return less_routes_prefix_url + '/userinfo/' + id + '.html'; }
search_path = function(){ return less_routes_prefix_url + '/search.html'; }
search_auto_complete_path = function(){ return less_routes_prefix_url + '/search_auto_complete.html'; }
film_types_path = function(id, url){ return less_routes_prefix_url + '/cathegory/' + id + '/' + url + '.html'; }
film_types_rss_path = function(id, url){ return less_routes_prefix_url + '/cathegory/' + id + '/' + url + '/rss.html'; }
film_types_atom_path = function(id, url){ return less_routes_prefix_url + '/cathegory/' + id + '/' + url + '/atom.html'; }
film_add_step1_path = function(){ return less_routes_prefix_url + '/film/add1.html'; }
film_edit_step1_path = function(id){ return less_routes_prefix_url + '/film/edit1/' + id + '.html'; }
film_delete_step1_path = function(id){ return less_routes_prefix_url + '/film/delete1/' + id + '.html'; }
film_add_step2_path = function(id){ return less_routes_prefix_url + '/film/add2/' + id + '.html'; }
film_edit_step2_path = function(id){ return less_routes_prefix_url + '/film/edit2/' + id + '.html'; }
film_delete_gallery_path = function(id){ return less_routes_prefix_url + '/film/delete_gallery/' + id + '.html'; }
film_add_step3_path = function(id){ return less_routes_prefix_url + '/film/add3/' + id + '.html'; }
film_edit_step3_path = function(id){ return less_routes_prefix_url + '/film/edit3/' + id + '.html'; }
film_delete_step3_path = function(id){ return less_routes_prefix_url + '/film/delete_link/' + id + '.html'; }
film_add_final_path = function(id){ return less_routes_prefix_url + '/film/add_final/' + id + '.html'; }
film_show_path = function(id, url){ return less_routes_prefix_url + '/film/' + id + '/' + url + '.html'; }
comment_add_path = function(){ return less_routes_prefix_url + '/comment/add.html'; }
comment_edit_path = function(id){ return less_routes_prefix_url + '/comment/edit/' + id + '.html'; }
comment_delete_path = function(id){ return less_routes_prefix_url + '/comment/delete/' + id + '.html'; }
static_page_path = function(id, url){ return less_routes_prefix_url + '/page/' + id + '/' + url + '.html'; }
statistic_path = function(){ return less_routes_prefix_url + '/statistic.html'; }
statistic_cathegory_films_path = function(){ return less_routes_prefix_url + '/statistic_cathegory_films.html'; }
statistic_films_by_day_path = function(){ return less_routes_prefix_url + '/statistic_films_by_day.html'; }
sitemap_path = function(){ return less_routes_prefix_url + '/sitemap.xml'; }
homepage_atom_path = function(){ return less_routes_prefix_url + '/atom.html'; }
homepage_rss_path = function(){ return less_routes_prefix_url + '/rss.html'; }
homepage_path = function(){ return less_routes_prefix_url + '/'; }
default_index_path = function(module){ return less_routes_prefix_url + '/' + module + '.html'; }
default_path = function(module, action){ return less_routes_prefix_url + '/' + module + '/' + action + '/*.html'; }
