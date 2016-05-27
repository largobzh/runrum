$(document).ready(function() {

	/* This is basic - uses default settings */
	
	$("a#single_image").fancybox();
	
	/* Using custom settings */
	
	$("a#inline").fancybox({
		'hideOnContentClick': true
	});


// function MOMMAR

$('.choix').on('click', function() {
		// data afin de recupere le contenu de "data-id" dans le lien "a"
		url = $(this).data('id');
		// affiche la route dans le na
		console.log(url);
		swal({
			title: "Êtes-vous sûr ?",
			text: "Suppression définitive",
			type: "warning",
			font:'Oxygen',
			showCancelButton: true,
			confirmButtonColor: '#e56e56',
			confirmButtonText: ' Supprimer',
			cancelButtonColor: '#807e7b',
			cancelButtonText: " Annuler",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm){
			if (isConfirm){
				swal("Supprimer!", "Note supprimée !", "success");
				console.log(url);
				setTimeout(function(){ window.location.href = "http://localhost:8888"+url; }, 2000);
				

			} else {
				swal("Annuler", "Suppression annulée", "error");
			}	
		})
	})


// function Yvan : suppression d'un post

	$('.suppPost').on('click', function() {
		// data afin de recupere le contenu de "data-id" dans le lien "a"
		url = $(this).data('id');
		
		console.log(url);
		swal({
			title: "Êtes-vous sûr ?",
			text: "Suppression définitive",
			type: "warning",
			font:'Oxygen',
			showCancelButton: true,
			confirmButtonColor: '#e56e56',
			confirmButtonText: ' Supprimer',
			cancelButtonColor: '#807e7b',
			cancelButtonText: " Annuler",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm){
			if (isConfirm){
				swal("Supprimer!", "Post supprimée !", "success");
				console.log(url);
				setTimeout(function(){ window.location.href = "http://runrum"+url; }, 1000);
							

			} else {
				swal("Annuler", "Suppression annulée", "error");
			}	
		})
	})
})