<?php $this->layout('layout', ['title' => 'Modifier Carnet']) ?>

<?php $this->start('main_content') ?>

<form method="POST" >
	<label for="dateNoteID" id="labelDateNote">Date de l'activité</label>
	<?php 

	$date= $contenues['datenote'];
	$result = date_format($date, 'd-m-Y H:i')

	 ?>
	<input type="datetime-local" name="form[datenote]" id="dateNoteID" tabindex="1" value="<?php echo $result; ?>" ><br>

	<label for="HDepartID" id="labelHDepart">Heure de départ</label>
	<input type="time" name="form[heuredepart]" id="HDepartID" tabindex="2" value="<?= $contenues['heuredepart'] ?>" ><br>


	<!-- <input type="hidden" name="utilisateur" > -->

	<label for="epreuveID" id="labelEpreuve">Choisir le type d'epreuve</label>
	<select name="form[type_epreuve_id]" id="epreuveID" tabindex="3" >
		<option disabled selected>choisir</option>
		<?php foreach ($epreuves as $val) {

			?>
			<option  value="<?= $this->e($val['id']) ?>" <?php if ($this->e($val['id']) == $contenues['type_epreuve_id']) {
				echo "selected";
			} ?> > <?= $this->e($val['epreuve']) ?></option>
			<?php } ?>
		</select><br>
		
		<label for="exerciceID" id="labelExercice">Choisir le type d'exercice</label>
		<select name="form[type_exercice_id]" id="exerciceID" tabindex="4" >
			<option disabled >choisir</option>
			<?php foreach ($exercices as $valu) {

				?>
				<option value="<?= $this->e($valu['id']) ?>" <?php if ($this->e($valu['id']) == $contenues['type_exercice_id']) {
					echo "selected";
				} ?> > <?= $this->e($valu['exercice']) ?></option>
				<?php } ?>
			</select><br>

			<?php

		 $total = $contenues['duree']; //ton nombre de secondes 


		 $heure = intval(abs($total / 3600)); 


		 $total = $total - ($heure * 3600); 


		 $minute = intval(abs($total / 60)); 


		 $total = $total - ($minute * 60); 


		 $seconde = $total;  

		 ?>

		 <label for="dureeID" id="labelduree">La durée</label>
		 <input type="text" name="heure" id="dureeID" placeholder="HH" maxlength="3" tabindex="5" value="<?php echo $heure ?>">:
		 <input type="text" name="minute" id="dureeID" placeholder="mm" maxlength="2" tabindex="6" value="<?php echo $minute ?>">:
		 <input type="text" name="secondes" id="dureeID" placeholder="ss" maxlength="2" tabindex="7" value="<?php echo $seconde ?>">
		 <br>
		 <!-- Afin de récuperer les valeurs de la durée et les convertires -->
		 <!-- <input type="hidden" name="form[duree]"> -->

		 <label for="distanceID" id="labelDistance">Distance effectuée</label>
		 <input type="text" name="form[distance]" id="distanceID" placeholder="100, 200" tabindex="8" value="<?= $contenues['distance'] ?>" >KM<br>

		 <!--  calculer la moyen  -->
		 <!-- <input type="hidden" name="moyenne" > -->

		 <label for="lieuID" id="labelLieu">Le lieu</label>
		 <input list="lelieu" type="text" name="form[lieu]" id="lieuID" tabindex="9" value="<?= $contenues['lieu'] ?>" ><br>
		 <!-- liste de lieu dans la base de donnee -->
		 <datalist id="lelieu">
		 	<option value="Paris">Paris</option>
		 	<option value="Marseille">Marseille</option>
		 	<option value="Bobigny">Bobigny</option>
		 </datalist>

		 <label for="meteoID" id="labelM">Condition Météo</label>
		 <select name="form[conditionmeteo]" id="meteoID" tabindex="10">
		 	<?php 
		 	$sel=''; 
		 	$e='Ensoleillé';
		 	$v ='Voilé';
		 	$n='Nuageux';
		 	$p='Pluis/Vent';
		 	$o='Orage/neige';

		 	?>
		 	<option value="<?php echo $e; ?>" <?php if ( $contenues['conditionmeteo'] == $e ) {
		 		echo "selected";
		 	} ?> >Ensoleillé</option>
		 	<option value="<?php echo $v; ?>" <?php if ($contenues['conditionmeteo'] == $v ) {
		 		echo "selected";
		 	} ?> >Voilé</option>
		 	<option value="<?php echo $n; ?>" <?php if ($contenues['conditionmeteo'] == $n) {
		 		echo "selected";
		 	}  ?> >Nuageux</option>
		 	<option value="<?php echo $p; ?>" <?php if ($contenues['conditionmeteo'] == $p) {
		 		echo "selected";
		 	}  ?> >Pluis/Vent</option>
		 	<option value="<?php echo $o; ?>" <?php if ($contenues['conditionmeteo'] == $o) {
		 		echo "selected";
		 	}  ?> >Orage/neige</option>
		 </select><br>



		 <textarea name="form[commentaire]" placeholder="Commentaire concernant l'activité..." tabindex="11"><?= $contenues['commentaire'] ?></textarea><br>


		 <input type="submit" name="submit" value="Enregistrer">
		</form>
		<?php $this->stop('main_content') ?>