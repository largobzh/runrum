$(document).ready(function() {

	/* This is basic - uses default settings */
	
	$("a#single_image").fancybox();
	
	/* Using custom settings */
	
	$("a#inline").fancybox({
		'hideOnContentClick': true
	});

// Ajouter un aperçu de l’image au moment de sa sélection

$(function () {
	// console.log('titi');
    // A chaque sélection de fichier
    // $('#photoId').find('input[name="photo"]').on('change', function (e) {
    $('#photoId').on('change', function (e) {
        var files = $(this)[0].files;
 console.log(files);
        if (files.length > 0) {
            // On part du principe qu'il n'y qu'un seul fichier
            // étant donné que l'on a pas renseigné l'attribut "multiple"
            var file = files[0],
                $image_preview = $('#image_preview');
 
            // Ici on injecte les informations recoltées sur le fichier pour l'utilisateur
            $image_preview.find('.thumbnail').removeClass('hidden');
            $image_preview.find('img').attr('src', window.URL.createObjectURL(file));
            $image_preview.find('h4').html(file.name);
            $image_preview.find('.caption p:first').html(file.size +' bytes');
        }
    });
 
    // Bouton "Annuler" pour vider le champ d'upload
    $('#image_supp').on('click', function (e) {
        e.preventDefault();
 // alert("toto");
 	    
        $('#photoId').find('input[name="photo"]').val(' ');
        $('#image_preview').find('.thumbnail').addClass('hidden');
    });
});

// function MOMMAR

$(function() {

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
				setTimeout(function(){ window.location.href = "http://runrum"+url; }, 2000);
				

			} else {
				swal("Annuler", "Suppression annulée", "error");
			}	
		})
	})
})

// function Yvan : suppression d'un post

	$('.suppPost').on('click', function() {
		// data afin de recupere le contenu de "data-id" dans le lien "a"
		url = $(this).data('id');
		
		console.log(url);
		swal({
			title: "Êtes-vous sûr ?",
			text: "Suppression définitive, attention toutes les réponses et photos correspondantes seront supprimées !!",
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