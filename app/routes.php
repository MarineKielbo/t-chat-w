<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		['GET', '/user', 'Users#listUsers', 'users_list'],
		['GET|POST', '/salon/[i:id]', 'Salons#viewSalon', 'view_salon'],
		['GET|POST', '/login', 'Users#login', 'login'],
		['GET', '/logout', 'User#logout', 'logout'],
		['GET|POST', '/register', 'User#register', 'register']
	);