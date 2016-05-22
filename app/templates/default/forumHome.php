<?php $this->layout('layout', ['title' => 'Forum !']) ?>

<?php $this->start('main_content') ?>
<?php print_r($posts); ?> 
	<h2>Liste des posts...<?= $user['pseudo'] ?></h2>
	
	<?php foreach ($posts as $post) { ?>
		<h3>
			<a href="<?= $this->url('forumPost', ['id' => $post['id']]) ?>">
				<?= $this->e($post['titre']) ?>
			</a>
			<span> <?= $this->e($post['type_echange']) ?></span> 


 		<!-- Date de publication, vote et nb vues -->
        <p>
            posté le <?=$post['date_publication']  ?>  par  <?=$post['pseudo'] ?>
            
            <!-- Ajout d'un "+" si positif -->
            || nb vues : <?=$post['nbvues'] ?>
            || nb réponsevote : <?=$post['nbreponses'] ?>
           
        </p>
        <!-- Corps de la question -->
        <p >
            <?=$post['post'] ?>
        </p>
        <hr>




		</h3>
	<?php } ?>
	<a href="<?= $this->url('addPost') ?>">ajouter</a>
<?php $this->stop('main_content') ?>
