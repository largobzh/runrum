<?php
	

	$w_routes = array(
		['GET|POST', '/login', 'AdminController#login', 'login'],
		['GET|POST', '/inscription', 'AdminController#inscription', 'inscription'],
		['GET|POST', '/oubliPassword', 'AdminController#oubliPassword', 'oubliPassword'],
		['POST', '/reinitPasswordForm', 'AdminController#reinitPasswordForm', 'reinitPasswordForm'],
		

		['GET',      '/forumListePosts',        'ForumController#forumListePosts', 'forumListePostes'], 
		['GET|POST', '/forumAjouterPost',          'ForumController#forumAjouterPost',    'forumAjouterPost'],
		
	
		['GET|POST', '/reinitPassword/[i:user_id]/[a:token_id]/', 'AdminController#reinitPassword', 'reinitPassword'],
		['GET', '/activerCompte/[i:user_id]/[a:token_id]/', 'AdminController#activerCompte', 'activerCompte'],

		['GET|POST', '/forumModifierPost/[i:id]',  'ForumController#forumModifierPost',   'forumModifierPost'],
	    
	    // ['GET|POST', '/inscription', 'Default#inscription', 'inscription'],
		// Attention à la gloutonnerie = ordre des routes
		// ['GET|POST', '/', 'Default#home', 'home'],
		// Attention à la gloutonnerie = ordre des routes
		// ['GET', '/liste', 'Default#liste', 'liste'],
		 // ['GET', '/contact', 'Default#contact', 'contact'],
		// // ['POST', '/murl', 'Default#murl', 'murl'],
		// ['GET', '/[:code]', 'Default#go', 'redirection'],

	);