<!-- ==================================================================================== -->
<!-- le 28/05/16 modif du titre  et site content-->
<!-- ==================================================================================== -->
<?php $this->layout('layout', ['title' => 'runrum-Forum - Liste des posts publiés!']) ?>

<?php $this->start('side_content') ?>
<h3>Connectez-vous pour ajouter vos comptes-rendus, news ou vos questions et cliquez sur le boutton ajouter.   </h3>
	
<?php $this->stop('side_content') ?>

<!-- ========================================================================================= -->


<?php $this->start('main_content') ?>
<article>
	<!-- <h4>Liste des posts...<?= $user['pseudo'] ?></h4>
 -->
	<div>
		<ul id="categories">
		<?php foreach ($type_echange_short as $techanges) { ?>
		
			<li class="infosPost1 mod2 couleurCR"><a href="<?= $this->url('forumListePostsT', ['techange' => $techanges['type_echange_short']]) ?>">
				<?= $this->e($techanges['type_echange_short']) ?></a>
			</li>
		<?php } ?> 
		</ul>
	</div>


   <div id="apercuPosts">
                 
      	<div class="postListe">

	<?php foreach ($posts as $post) { ?>
		
		<?php if(!empty($post)) 
		{ ?>


			<h4 class="couleurCR">
				<span>[<?= $this->e($post['type_echange_short']) ?>]</span><a id="lienTitrePost" href="<?= $this->url('forumListeReponses', ['id' => $post['id']]) ?>">
				<?= $this->e($post['titre']) ?></a>
			</h4>


	       <p>
				<?php if($post['utilisateur_id'] == $user['id'])
				{?>
					<a  href="<?= $this->url('forumModifierPost', ['id' => $post['id']]) ?>">
						<?= $this->e($post['post']) ?>
					</a>

				<!-- ==================================================================================== -->
				<!-- le 28/05/16 ajout du bouton signaler un post -->
				<!-- en paramètre le type de post = question ou réponse (ici se sera pst ) -->
				<!-- ==================================================================================== -->
						<?php  if(isset($_SESSION["user"])){ ?>
							<a href="<?= $this->url('forumSignalerPost', ['id' => $post['id']]) ?>">Signaler</a>	
						<?php } ?>
				<!-- =========================fin de modif===================================================== -->
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
		<!-- ======================== -->
           <div>
                <ul id="renseignPost">
                    <li class="infosPost2 mod3">Auteur : <?=$post['pseudo'] ?></li>

                    <li class="infosPost2 mod3"><?= date('j-M-Y', strtotime($post['date_publication']))  ?></li>
                    <li class="infosPost2 mod3">Nbre réponses : <?= intval($post['nbreponses'] )?></li>
                    <li class="infosPost2 mod3">Vues : <?= intval($post['nbvues']) ?></li>
                </ul>
           </div>      

	<?php }} ?>
  	</div>
                  
	</div>
	<div>
        <ul id="navPages">
            <li>
            	<a href="pagePreced" class="sansSoulign">Page précédente</a></li>
            <li>
				<?php  if(isset($_SESSION["user"])){ ?>
					<a href="<?= $this->url('forumAjouterPost') ?>" class="sansSoulign" title="accès au formulaire de saisie d'un nouveau post.">Ajouter</a>
				<?php } ?>
			</li>

            <li>
            	<a href="pageSuiv" class="sansSoulign">Page suivante</a>
            </li>
        </ul>
   	</div>

</article>
<?php $this->stop('main_content') ?>
