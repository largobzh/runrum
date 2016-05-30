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
				<label for="distanceID" id="labelDistance">Distance (en km)</label>
				<input type="text" name="form[distance]" id="distanceID" placeholder="10, 20, 42..." tabindex="8" >
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
				<small>Pour vous encourager dans votre pratique de la course à pied, des badges vous sont décernés quand vous atteignez certains paliers de temps et de distance. Les distances ajoutées à chaque nouvelle note sont cumulées, le compteur temps est quant à lui remis à zéro à chaque sortie. L'obtention d'un nouveau badge est annoncé à la communauté 'rum' via un nouveau post. </small>
			</p>

			<p>
<!-- 				<input type="submit" name="annulNote" value="Annuler" id="annulFormCarnet"> -->
				<input type="submit" name="submit" value="Enregistrer" id="submitFormCarnet">
			</p>
			


		</div>
	</form>
</article>

<?php $this->stop('main_content') ?>


		<?php $this->start('javascripts') ?>
		<!-- Pour les kilométres -->
		<?php if($alert == True) { ?>
			<script>
				swal({   title: "Badge kilomètres",   text: "<?= $alert ?>",   imageUrl: "<?= $this->assetUrl('img/logo/badgekilometre.png') ?>" });
			</script>
			<?php } ?>
			<!--  -->
			<?php if($noalert == True) { ?>
				<script>
				swal("<?= $noalert ?>");
				</script>
				<?php } ?>

				<!-- Pour les durées -->
				<?php if($alurt == True) { ?>
					<script>
					setTimeout(function(){ swal({ title: "Badge Durée",   text: "<?= $alurt ?>",   imageUrl: "<?= $this->assetUrl('img/logo/badgeduree.png') ?>" }); }, 4000);
						
					</script>
					<?php } ?>
					<!--  -->
					<?php if($noalurt == True) { ?>
					<script>
					setTimeout(function(){ swal("<?= $noalurt ?>"); }, 4000);
						
					</script>
					<?php } ?>

					<?php $this->stop('javascripts') ?>








