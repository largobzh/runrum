<?php $this->layout('layout', ['title' => 'Création Carnet']) ?>

<?php $this->start('main_content') ?>

	<form method="POST" >
		<label for="dateNoteID" id="labelDateNote">Date de l'activité</label>
		<input type="datetime-local" name="form[datenote]" id="dateNoteID" tabindex="1" ><br>

		<label for="HDepartID" id="labelHDepart">Heure de départ</label>
		<input type="time" name="form[heuredepart]" id="HDepartID" tabindex="2" ><br>

		
		<!-- <input type="hidden" name="utilisateur" > -->
		
		<label for="epreuveID" id="labelEpreuve">Choisir le type d'epreuve</label>
		<select name="form[type_epreuve_id]" id="epreuveID" tabindex="3" >
		<option disabled selected>choisir</option>
		<?php foreach ($epreuves as $value) {
		
		 ?>
		<option value="<?= $this->e($value['id']) ?>"> <?= $this->e($value['epreuve']) ?></option>
		<?php } ?>
		</select><br>
		
		<label for="exerciceID" id="labelExercice">Choisir le type d'exercice</label>
		<select name="form[type_exercice_id]" id="exerciceID" tabindex="4" >
		<option disabled selected>choisir</option>
		<?php foreach ($exercices as $valu) {
		
		 ?>
		<option value="<?= $this->e($valu['id']) ?>"> <?= $this->e($valu['exercice']) ?></option>
		<?php } ?>
		</select><br>


		<label for="dureeID" id="labelduree">La durée</label>
		<input type="text" name="heure" id="dureeID" placeholder="HH" maxlength="3" tabindex="5" >:
		<input type="text" name="minute" id="dureeID" placeholder="mm" maxlength="2" tabindex="6">:
		<input type="text" name="secondes" id="dureeID" placeholder="ss" maxlength="2" tabindex="7">
		<br>
		<!-- Afin de récuperer les valeurs de la durée et les convertires -->
		<!-- <input type="hidden" name="form[duree]"> -->

		<label for="distanceID" id="labelDistance">Distance effectuée</label>
		<input type="text" name="form[distance]" id="distanceID" placeholder="100, 200" tabindex="8" >KM<br>

		<!--  calculer la moyen  -->
		<!-- <input type="hidden" name="moyenne" > -->

		<label for="lieuID" id="labelLieu">Le lieu</label>
		<input list="lelieu" type="text" name="form[lieu]" id="lieuID" tabindex="9" ><br>
		<!-- liste de lieu dans la base de donnee -->
		<datalist id="lelieu">
			<option value="Paris">Paris</option>
			<option value="Marseille">Marseille</option>
			<option value="Bobigny">Bobigny</option>
		</datalist>

		<label for="meteoID" id="labelM">Condition Météo</label>
		<select name="form[conditionmeteo]" id="meteoID" tabindex="10">
			<option value="Ensoleillé">Ensoleillé</option>
			<option value="Voilé">Voilé</option>
			<option value="Nuageux">Nuageux</option>
			<option value="Pluis/Vent">Pluis/Vent</option>
			<option value="Orage/neige">Orage/neige</option>
		</select><br>


		
		<textarea name="form[commentaire]" placeholder="Commentaire concernant l'activité..." tabindex="11"></textarea><br>

		
		<input type="submit" name="submit" value="Enregistrer">
	</form>
<?php $this->stop('main_content') ?>