jQuery(document).ready(function($) {

	document.querySelector('#effet').onclick = function(){
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

    } else {
      swal("Annuler", "Suppression annulée", "error");
    }
	});

};



});

