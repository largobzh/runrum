<?php $this->layout('layout', ['title' => 'Mon Carnet']) ?>

<?php $this->start('main_content') ?>
<article>
	


<?php foreach ($listes as $value) { ?>

<div id="apercuPosts">
	<h4>Date de départ : <?= $value['datenote'] ?> </h4>



	<?php foreach ($exercices as $valu) {

		if ($value['type_exercice_id'] == $valu['id']) { ?>
			<p>Exercice : <?= $valu['exercice']?></p>
			<?php }	} ?>

			<?php foreach ($epreuves as $vali) {
				if ($value['type_epreuve_id'] == $vali['id']) { ?>
					<p>type d'épreuve : <?= $vali['epreuve']?></p>
					<?php }	} ?>

					<p>Lieux : <?= $value['lieu'] ?> </p>
					<p>Heure de départ : <?= $value['heuredepart'] ?> </p>
					<p>Distance parcouru : <?= $value['distance'] ?> KM</p>
					<p>Moyenne : <?= $value['moyenne'] ?> KM/H </p>
					<?php

	$total = $value['duree']; //ton nombre de secondes 


	$heure = intval(abs($total / 3600)); 


	$total = $total - ($heure * 3600); 


	$minute = intval(abs($total / 60)); 


	$total = $total - ($minute * 60); 


	$seconde = $total; 


	 ?>

	 <p>Durée : <?php echo "$heure H : $minute min : $seconde sec"; ?> </p>
	<p>Condition météo : <?= $value['conditionmeteo'] ?> </p>
	<p>Votre Commentaire :<br><?= $value['commentaire'] ?></p>
	<a href="<?= $this->url('modifierCarnet', ['id' => $value['id']]) ?>">Editer</a>
	<a href="<?= $this->url('supprimerCarnet', ['id' => $value['id']]) ?>">Supprimer</a>
	<br><br>


	<?php } ?>
	</div>
	</article>
	<?php $this->stop('main_content') ?>


