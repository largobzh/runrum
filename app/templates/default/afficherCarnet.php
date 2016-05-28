<?php $this->layout('layout', ['title' => 'Mon Carnet']) ?>

<?php $this->start('side_content') ?>
  <h3>
    Notes
  </h3>
    
  <p>
   <a href="<?= $this->url('creationCarnet')?>">Créer une nouvelle note</a>
  </p>
<?php $this->stop('side_content') ?>

<?php $this->start('main_content') ?>
<article>
	
	<?php foreach ($listes as $value) { ?>

	<div id="apercuPosts">

		<h4 class="couleurTitreCarnet">Date de l'activité : <?= date('j-M-Y', strtotime($value['datenote'])) ?> </h4>

		<div>
			<table>
					<thead>
						<tr><td class="titreTabNote">Détails de la note :</td></tr>
					</thead>
				<tbody>
				



		<?php foreach ($exercices as $valu) {

			if ($value['type_exercice_id'] == $valu['id']) { ?>
				<tr><td>Exercice : </td><td><?= $valu['exercice']?></td></tr>
		<?php }	} ?>

		<?php foreach ($epreuves as $vali) {
			if ($value['type_epreuve_id'] == $vali['id']) { ?>
				<tr><td>type d'épreuve : </td><td><?= $vali['epreuve']?></td></tr>
		<?php }	} ?>

			<tr><td>Lieux : </td><td><?= $value['lieu'] ?> </td></tr>

			<tr><td>Heure de départ : </td><td><?= $value['heuredepart'] ?> </td></tr>
			
			<tr><td>Distance parcouru : </td><td><?= $value['distance'] ?> km</td></tr>
			
			<tr><td>Moyenne : </td><td><?= $value['moyenne'] ?> km/h </td></tr>

		<?php

		$total = $value['duree']; //ton nombre de secondes 


		$heure = intval(abs($total / 3600)); 


		$total = $total - ($heure * 3600); 


		$minute = intval(abs($total / 60)); 


		$total = $total - ($minute * 60); 


		$seconde = $total; 


	 	?>

	 	<tr><td>Durée : </td><td><?php echo "$heure H : $minute min : $seconde sec"; ?> </td></tr>

		<tr><td>Météo : </td><td><?= $value['conditionmeteo'] ?> </td></tr>


			</tbody>
			</table>
	</div>
	<div>
		<p><span>Commentaire : </span></p>
		<p class="couleurCommentNote"><?= $value['commentaire'] ?></p>
	</div>
		

		<div>
            <ul id="navComment">
            <!-- mettre la requête  -->
            	<? //= $this->url('supprimerCarnet', ['id' => $value['id']]) ?>
                <li><a href="#" data-id="<?= $this->url('supprimerCarnet', ['id' => $value['id']])?>" class="sansSoulign choix" >Supprimer</a></li>
                
                <li><a class="sansSoulign" href="<?= $this->url('modifierCarnet', ['id' => $value['id']]) ?>">Éditer</a></li>

            </ul>
		</div>


		<?php } ?>
		
	</div>
</article>
<?php $this->stop('main_content') ?>


