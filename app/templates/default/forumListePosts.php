<?php $this->layout('layout', ['title' => 'Forum !']) ?>

<?php $this->start('main_content') ?>

	<h2>Liste des posts...<?= $user['pseudo'] ?></h2>
	
	<?php foreach ($posts as $post) { ?>
		<h3>
			<a href="<?= $this->url('forumModifierPost', ['id' => $post['id']]) ?>">
				<?= $this->e($post['titre']) ?>
			</a>
			<span> <?= $this->e($post['type_echange']) ?></span> 
        <p>
           le <?= date('j-M-Y', strtotime($post['date_publication']))  ?>  par  <?=$post['pseudo'] ?> 
           nb vues :    <?= intval($post['nbvues']) ?>
           nb réponse : <?= intval($post['nbreponses'] )?>
           
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
