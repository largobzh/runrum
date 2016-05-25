<?php
	

	$w_routes = array(
		['GET', '/home', 'default#home', 'home'],
		['GET|POST', '/login', 'AdminController#login', 'login'],
		['GET|POST', '/inscription', 'AdminController#inscription', 'inscription'],
		['GET|POST', '/oubliPassword', 'AdminController#oubliPassword', 'oubliPassword'],
				

		['GET|POST', '/forumAjouterPost',          'ForumController#forumAjouterPost',    'forumAjouterPost'],
		
	
		['GET|POST', '/reinitPassword/[i:user_id]/[a:token_id]/', 'AdminController#reinitPassword', 'reinitPassword'],
		['GET',      '/activerCompte/[i:user_id]/[a:token_id]/',  'AdminController#activerCompte', 'activerCompte'],

		['GET|POST', '/forumModifierPost/[i:id]/',  'ForumController#forumModifierPost' , 'forumModifierPost'],
		['GET|POST', '/forumListeReponses/[i:id]/',  'ForumController#forumListeReponses', 'forumListeReponses'], 
		['GET',      '/forumListePosts',        'ForumController#forumListePosts', 'forumListePosts'], 
	   	['GET',      '/forumListePostsT/[a:techange]/',        'ForumController#forumListePosts', 'forumListePostsT'], 
	    // ['GET|POST', '/inscription', 'Default#inscription', 'inscription'],
		// Attention à la gloutonnerie = ordre des routes
		// ['GET|POST', '/', 'Default#home', 'home'],
		// Attention à la gloutonnerie = ordre des routes
		// ['GET', '/liste', 'Default#liste', 'liste'],
		 // ['GET', '/contact', 'Default#contact', 'contact'],
		// // ['POST', '/murl', 'Default#murl', 'murl'],
		// ['GET', '/[:code]', 'Default#go', 'redirection'],

	);