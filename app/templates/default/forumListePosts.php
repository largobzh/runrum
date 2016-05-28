<!-- ==================================================================================== -->
<!-- le 28/05/16 modif du titre  et site content-->
<!-- ==================================================================================== -->
<?php $this->layout('layout', ['title' => 'runrum-Forum - Liste des posts publiés!']) ?>

<?php $this->start('side_content') ?>
<h3>Connectez-vous pour ajouter vos comptes-rendus, news ou vos questions et cliquez sur le boutton ajouter.   </h3>
	
<?php $this->stop('side_content') ?>

<!-- ========================================================================================= -->

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
	<!-- ==================================================================================== -->
	<!-- le 28/05/16 ajout du bouton signaler un post -->
	<!-- en paramètre le type de post = question ou réponse (ici se sera pst ) -->
	<!-- ==================================================================================== -->
			<?php  if(isset($_SESSION["user"])){ ?>
				<a href="<?= $this->url('forumSignalerPost', ['id' => $post['id']]) ?>">Signaler</a>	
			<?php } ?>
<!-- =========================fin de modif===================================================== -->
		
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

		<!-- =========== ajout des photos -->

			<?php foreach ($photos as $photo)
			{ 
				if($photo['id_post'] == $post['id'])

					
				{ ?> 

				 	<div> 
				 	<?php 
					 	$pos = strpos($photo['ref_image'], 'min_') ;
					 	if ($pos !== false)
					 	{
					 		 $max_img =  str_replace('min_', 'max_' , $photo['ref_image']);
				 		?>
							
							<a id="single_image" href="http://runrum/<?= $max_img ?>"><img src="http://runrum/<?= $photo['ref_image']?>" alt=<?= $post['titre'] ?>></a>

		                <?php } ?>
		            </div>


			<?php }} ?>
            
			</h3>
			<hr>
	<?php }} ?>
	
	<?php  if(isset($_SESSION["user"])){ ?>
		<a href="<?= $this->url('forumAjouterPost') ?>">ajouter</a>	
	<?php } ?>
<?php $this->stop('main_content') ?>