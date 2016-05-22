<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'home'],

		// route pour la creation des carnets
		['GET|POST','/creationcarnet','Carnet#creationCarnet','creationCarnet'],
		// route pour afficher la liste des carnets
		['GET|POST','/listecarnet','Carnet#afficherCarnet','afficherCarnet'],
		// route pour la modification des carnets
		['GET|POST','/modifiercarnet/[i:id]','Carnet#modifierCarnet','modifierCarnet'],

	);