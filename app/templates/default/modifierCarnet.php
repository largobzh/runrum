<?php $this->layout('layout', ['title' => 'Édition de note']) ?>

<?php $this->start('main_content') ?>
<article>

	<form method="POST" >
	<div>
		<p>
			<label for="dateNoteID" id="labelDateNote">Date de l'activité</label>
	
			<input type="date" name="form[datenote]" id="dateNoteID" tabindex="1" value="<?= $contenues['datenote'] ?>" >
		</p>

		<p>
			<label for="HDepartID" id="labelHDepart">Heure de départ</label>
			<input type="time" name="form[heuredepart]" id="HDepartID" tabindex="2" value="<?= $contenues['heuredepart'] ?>" >
		</p>



	<!-- <input type="hidden" name="utilisateur" > -->

		<p>
			<label for="epreuveID" id="labelEpreuve">Type d'epreuve</label>
			<select name="form[type_epreuve_id]" id="epreuveID" tabindex="3" >
				<option disabled selected>choisir</option>
				<?php foreach ($epreuves as $val) {

				?>
				<option  value="<?= $this->e($val['id']) ?>" <?php if ($this->e($val['id']) == $contenues['type_epreuve_id']) {
				echo "selected";
				} ?> > <?= $this->e($val['epreuve']) ?></option>
				<?php } ?>
			</select><br>
		</p>

		<p>
			<label for="exerciceID" id="labelExercice">Type d'exercice</label>
			<select name="form[type_exercice_id]" id="exerciceID" tabindex="4" >
				<option disabled >choisir</option>
				<?php foreach ($exercices as $valu) {

				?>
				<option value="<?= $this->e($valu['id']) ?>" <?php if ($this->e($valu['id']) == $contenues['type_exercice_id']) {
					echo "selected";
				} ?> > <?= $this->e($valu['exercice']) ?></option>
				<?php } ?>
			</select><br>
		</p>
		


		<?php

		 $total = $contenues['duree']; //ton nombre de secondes 


		 $heure = intval(abs($total / 3600)); 


		 $total = $total - ($heure * 3600); 


		 $minute = intval(abs($total / 60)); 


		 $total = $total - ($minute * 60); 


		 $seconde = $total;  

		?>
		
		<p>
		 	<label for="dureeID" id="labelduree">La durée</label>
		 	<input type="text" name="heure" id="dureeID" placeholder="h" maxlength="3" tabindex="5" value="<?php echo $heure ?>">:
			<input type="text" name="minute" id="dureeID" placeholder="min" maxlength="2" tabindex="6" value="<?php echo $minute ?>">:
		 <input type="text" name="secondes" id="dureeID" placeholder="s" maxlength="2" tabindex="7" value="<?php echo $seconde ?>">
		</p>
		 <!-- Afin de récuperer les valeurs de la durée et les convertires -->
		 <!-- <input type="hidden" name="form[duree]"> -->

		<p>
			<label for="distanceID" id="labelDistance">Distance effectuée</label>
		 	<input type="text" name="form[distance]" id="distanceID" placeholder="100, 200" tabindex="8" value="<?= $contenues['distance'] ?>" >	
		</p>


		 <!--  calculer la moyen  -->
		 <!-- <input type="hidden" name="moyenne" > -->
		<p>
			<label for="lieuID" id="labelLieu">Le lieu</label>
			<input list="lelieu" type="text" name="form[lieu]" id="lieuID" tabindex="9" value="<?= $contenues['lieu'] ?>" ><br>
		 <!-- liste de lieu dans la base de donnee -->
			<datalist id="lelieu">
		 		<option value="Paris">Paris</option>
		 		<option value="Marseille">Marseille</option>
		 		<option value="Bobigny">Bobigny</option>
				<option value="Tokyo">Tokyo</option>
		 	</datalist>			
		</p>

		<p>
			<label for="meteoID" id="labelM">Météo</label>
			<select name="form[conditionmeteo]" id="meteoID" tabindex="10">
		 	<?php 
		 		$sel=''; 
		 		$e='Ensoleillé';
		 		$v ='Soleil voilé';
		 		$n='Nuageux';
		 		$p='Pluie/Vent';
		 		$o='Orage/neige';
		 	?>

		 	<option value="<?php echo $e; ?>" <?php if ( $contenues['conditionmeteo'] == $e ) {
		 		echo "selected";
		 	} ?> >Ensoleillé</option>
		 	<option value="<?php echo $v; ?>" <?php if ($contenues['conditionmeteo'] == $v ) {
		 		echo "selected";
		 	} ?> >Soleil voilé</option>
		 	<option value="<?php echo $n; ?>" <?php if ($contenues['conditionmeteo'] == $n) {
		 		echo "selected";
		 	}  ?> >Nuageux</option>
		 	<option value="<?php echo $p; ?>" <?php if ($contenues['conditionmeteo'] == $p) {
		 		echo "selected";
		 	}  ?> >Pluie/Vent</option>
		 	<option value="<?php echo $o; ?>" <?php if ($contenues['conditionmeteo'] == $o) {
		 		echo "selected";
		 	}  ?> >Orage/neige</option>
		 </select><br>			
		</p>

		
	</div>

	<div>
		<p>
			<label for="commentText" id="labelCommentText">Commentaire</label>
		 	<textarea name="form[commentaire]" placeholder="Commentaire concernant l'activité..." tabindex="11"><?= $contenues['commentaire'] ?></textarea>			
		</p>

		<p>
			<small>Modifiez les champs concernés par la modification de votre note. Ces modifications n'influent pas sur l'attribution ou non de badges.</small>
		</p>

		<p>
			<input type="submit" name="submit" value="Mettre à jour" id="submitFormCarnet">
		</p>

		 
	</div>
	</form>
</article>
<?php $this->stop('main_content') ?>
