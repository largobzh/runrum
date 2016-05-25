<?php $this->layout('layout', ['title' => 'Carnet : Nouvelle note']) ?>

<?php $this->start('main_content') ?> 
<article>


	<form method="POST" >
		<div>

			<p>
				<label for="dateNoteID" id="labelDateNote">Date de l'activité</label>
				<input type="date" name="form[datenote]" id="dateNoteID" tabindex="1" >
			</p>

			<p>
				<label for="HDepartID" id="labelHDepart">Heure de départ</label>
				<input type="time" name="form[heuredepart]" id="HDepartID" tabindex="2" >
			</p>


			<!-- <input type="hidden" name="utilisateur" > -->

			<p>
				<label for="epreuveID" id="labelEpreuve">Type d'épreuve</label>
				<select name="form[type_epreuve_id]" id="epreuveID" tabindex="3" >
					<option disabled selected>choisir</option>
					<?php foreach ($epreuves as $value) {

						?>
					<option value="<?= $this->e($value['id']) ?>"> <?= $this->e($value['epreuve']) ?></option>
						<?php } ?>
				</select>
			</p>

			<p>

				<label for="exerciceID" id="labelExercice">Type d'exercice</label>
				<select name="form[type_exercice_id]" id="exerciceID" tabindex="4" >
					<option disabled selected>choisir</option>
						<?php foreach ($exercices as $valu) {

							?>
					<option value="<?= $this->e($valu['id']) ?>"> <?= $this->e($valu['exercice']) ?></option>
							<?php } ?>
				</select>
			</p>

			<p>
				<label for="dureeID" id="labelduree">Durée</label>
				<input type="text" name="heure" id="dureeID" placeholder="h" maxlength="3" tabindex="5" > :
				<input type="text" name="minute" id="dureeID" placeholder="min" maxlength="2" tabindex="6"> :
				<input type="text" name="secondes" id="dureeID" placeholder="s" maxlength="2" tabindex="7">
			</p>
					<!-- Afin de récuperer les valeurs de la durée et les convertires -->
					<!-- <input type="hidden" name="form[duree]"> -->
			<p>
				<label for="distanceID" id="labelDistance">Distance</label>
				<input type="text" name="form[distance]" id="distanceID" placeholder="10km, 20km, 42km..." tabindex="8" >
			</p>

					<!--  calculer la moyen  -->
					<!-- <input type="hidden" name="moyenne" > -->
			<p>
				<label for="lieuID" id="labelLieu">Lieu</label>
				<input list="lelieu" type="text" name="form[lieu]" id="lieuID" tabindex="9" >

						<!-- liste de lieu dans la base de donnee -->
				<datalist id="lelieu">
					<option value="Paris">Paris</option>
					<option value="Marseille">Marseille</option>
					<option value="Bobigny">Bobigny</option>
					<option value="Tokyo">Tokyo</option>
				</datalist>
			</p>

			<p>
				<label for="meteoID" id="labelM">Condition Météo</label>
				<select name="form[conditionmeteo]" id="meteoID" tabindex="10">
					<option value="Ensoleillé">Ensoleillé</option>
					<option value="Voilé">Soleil voilé</option>
					<option value="Nuageux">Nuageux</option>
					<option value="Pluis/Vent">Pluie/Vent</option>
					<option value="Orage/neige">Orage/neige</option>
				</select>
			</p>

			</div>
			<div>

			<p>
				<label for="commentText" id="labelCommentText">Commentaire</label>
				<textarea name="form[commentaire]" id="commentText" placeholder="Zone de texte libre." tabindex="11"></textarea>
			</p>

			<p>
				<small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit iure sit ad soluta quae veniam architecto, nesciunt veritatis quod odio ipsam id accusantium voluptatibus in ipsa iste ut optio suscipit.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit iure sit ad soluta quae veniam architecto, nesciunt veritatis quod.</small>
			</p>

			<p>
<!-- 				<input type="submit" name="annulNote" value="Annuler" id="annulFormCarnet"> -->
				<input type="submit" name="submit" value="Enregistrer" id="submitFormCarnet">
			</p>
			


		</div>
	</form>
</article>

<?php $this->stop('main_content') ?>








