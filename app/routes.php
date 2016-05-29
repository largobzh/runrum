<?php
	

	$w_routes = array(
		['GET', '/home', 'default#home', 'home'],
		['GET|POST', '/login', 'AdminController#login', 'login'],
		['GET|POST', '/logout', 'AdminController#logout', 'logout'],
		['GET|POST', '/inscription', 'AdminController#inscription', 'inscription'],
		['GET|POST', '/oubliPassword', 'AdminController#oubliPassword', 'oubliPassword'],
				
		['GET|POST', '/forumAjouterPost',          'ForumController#forumAjouterPost',    'forumAjouterPost'],
        
        // route pour la creation des carnets
		['GET|POST','/creationcarnet','Carnet#creationCarnet','creationCarnet'],
		// route pour afficher la liste des carnets
		['GET|POST','/listecarnet','Carnet#afficherCarnet','afficherCarnet'],
		// route pour la modification une note du carnet
		['GET|POST','/modifiercarnet/[i:id]','Carnet#modifierCarnet','modifierCarnet'],
		// afin de supprimer une note du carnet
		['GET|POST','/supprimercarnet/[i:id]','Carnet#supprimerCarnet','supprimerCarnet'],	
        
        
        
		
		['GET|POST', '/reinitPassword/[i:user_id]/[a:token_id]/', 'AdminController#reinitPassword', 'reinitPassword'],
		['GET',       '/activerCompte/[i:user_id]/[a:token_id]/',  'AdminController#activerCompte', 'activerCompte'],

		['GET|POST', '/forumModifierPost/[i:id]/',     'ForumController#forumModifierPost' , 'forumModifierPost'],
		['GET|POST', '/forumSupprimerPost/[i:id]/[a:Post_Reponse]/',    'ForumController#forumSupprimerPost' , 'forumSupprimerPost'],
		['GET|POST', '/forumSignalerPost/[i:id]/',  'ForumController#forumSignalerPost',    'forumSignalerPost'],
		['GET|POST', '/forumSignalerReponse/[i:post_id]/[i:reponse_id]/',  'ForumController#forumSignalerReponse',    'forumSignalerReponse'],
		['GET|POST', '/forumListeReponses/[i:id]/',     'ForumController#forumListeReponses', 'forumListeReponses'], 
		['GET',      '/forumListePosts',                'ForumController#forumListePosts', 'forumListePosts'], 
	   	['GET',      '/forumListePostsT/[a:techange]/', 'ForumController#forumListePosts', 'forumListePostsT'], 
	    

	);