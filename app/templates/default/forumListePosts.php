<?php $this->layout('layout', ['title' => 'Forum !']) ?>

<?php $this->start('main_content') ?>

	<h2>Liste des posts...<?= $user['pseudo'] ?></h2>
	
<?php print_r($type_echange_short); ?>
 <hr>
<?php print_r($posts); ?>
	<!-- on affiche les boutons correspondant au type echange pour filter les enregistrements  -->
	<?for ($i=0; $i < length($type_echange_short); $i++) { ?>
		<a href="<?= $this->url('forumListePosts', ['type_echange_short' => $type_echange_short[$i]]) ?>">
				<?= $this->e($type_echange_short['type_echange_short']) ?>
		</a>
	<?php } ?> 
	<!-- <?php foreach ($type_echange_short as $techanges) { ?>
		 <hr>
		<?php print_r($techanges) ?> 
		<a href="<?= $this->url('forumListePosts', ['type_echange_short' => $type_echange_short['type_echange_short']]) ?>">
				<?= $this->e($type_echange_short['type_echange_short']) ?>
		</a>
	<?php } ?> -->
	

	<?php foreach ($posts as $post) { ?>
		<h3>
			<?php print_r($post); ?>
		
			<span> <?= $this->e($post['type_echange_short']) ?></span> 

			<a href="<?= $this->url('forumListeReponses', ['id' => $post['id']]) ?>">
				<?= $this->e($post['titre']) ?>
			</a>

		
        <p>
           <?=$post['pseudo'] ?>  <?= date('j-M-Y', strtotime($post['date_publication']))  ?>  
           vues :    <?= intval($post['nbvues']) ?>
           Réponses : <?= intval($post['nbreponses'] )?>
           
        </p>
        <!-- Corps de la question -->
        <p >
            <?=$post['post'] ?>
        </p>
        <hr>

		</h3>
	<?php } ?>
	<a href="<?= $this->url('forumAjouterPost') ?>">ajouter</a>
<?php $this->stop('main_content') ?>
