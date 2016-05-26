<?php $this->layout('layout', ['title' => 'Forum !']) ?>

<?php $this->start('main_content') ?>

	<h2>Liste des posts...<?= $user['pseudo'] ?></h2>

	<?php foreach ($type_echange_short as $techanges) { ?>
		
		<a href="<?= $this->url('forumListePostsT', ['techange' => $techanges['type_echange_short']]) ?>">
				<?= $this->e($techanges['type_echange_short']) ?>
		</a>

	<?php } ?> 
	<hr>

	<?php foreach ($posts as $post) { ?>
		
		<?php if(!empty($post)) 
		{ ?>

			<h3>
		
			<span> <?= $this->e($post['type_echange_short']) ?></span> 

			<a href="<?= $this->url('forumListeReponses', ['id' => $post['id']]) ?>">
				<?= $this->e($post['titre']) ?>
			</a>

		
        	<p>
	           <?=$post['pseudo'] ?>  <?= date('j-M-Y', strtotime($post['date_publication']))  ?>  
	           vues :    <?= intval($post['nbvues']) ?>
	           Réponses : <?= intval($post['nbreponses'] )?>
           
        	</p>
	       <!-- on accepte ma modification de la question si l'auteur est l'utilisateur courant -->
	       <!-- on cré donc un lien vers la route , sinon on affcihe l coprs -->
	       <p>
				<?php if($post['utilisateur_id'] == $user['id'])
				{?>
					<a href="<?= $this->url('forumModifierPost', ['id' => $post['id']]) ?>">
						<?= $this->e($post['post']) ?>
					</a>
				<?php
				}
				else
				{
					echo $this->e($post['post']);
				} 
				?>
				
	        </p>
            
			</h3>
			<hr>
	<?php }} ?>
	
	<p>
	<a href="<?= $this->url('forumAjouterPost') ?>">ajouter</a>
	</p>
<?php $this->stop('main_content') ?>
