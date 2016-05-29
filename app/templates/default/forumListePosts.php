<!-- ==================================================================================== -->
<!-- le 28/05/16 modif du titre  et site content-->
<!-- ==================================================================================== -->
<?php $this->layout('layout', ['title' => 'Forum - Liste des posts']) ?>

<?php $this->start('side_content') ?>
	<h3>
		Comment ajouter et modifier des posts :
	</h3>

    <p>
		Se connecter pour ajouter comptes-rendus, news ou questions puis cliquer sur le boutton ajouter.

        Pour modifier un post que vous avez publié, cliquez sur le texte de ce post., la fenêtre d'édition s'ouvrira.


    </p> 
    <p>
    	<?php if(isset($totalNbPosts) && isset($nbPostsAffiche))
		{
			echo $nbPostsAffiche  . " Post sont affichés.";
			if($totalNbPosts > $nbPostsAffiche)
			{
			 echo ". Utilisez les boutons de navigation pour afficher les posts suivants"; 
			}
		?><p>N° de page :<?php echo $page ?></p>
		<?php }?>
        
    </p> 
	
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
                    <li class="infosPost2 mod3">
						<?php  if(isset($_SESSION["user"])){ ?>
							<a class="sansSoulign" href="<?= $this->url('forumSignalerPost', ['id' => $post['id']]) ?>">Signaler</a>	
						<?php } ?>
					</li>
                </ul>
           </div>      

	<?php }} ?>
  	</div>
                  
	</div>
	<div>
        <ul id="navPages">
            <li>
            <!-- modif yvan 29/05/16 pagination -->
            <!-- si le n° de la page courante est < au nombre de page total on affiche le bouton nav droit -->
	            <?php  if(isset($page) && isset($nbPage) && $page>1)
	            { ?>
            <!-- ============================================= -->
            	<a  href="<?= $this->url('forumListePostsN', ['techange' => "prec", 'page' => $page]) ?>" class="sansSoulign"  >Page précédente</a>

            	<?php } ?>
            </li>
            <!-- ============================================= -->

            <li>
				<?php  if(isset($_SESSION["user"])){ ?>
					<a href="<?= $this->url('forumAjouterPost') ?>" class="sansSoulign" title="accès au formulaire de saisie d'un nouveau post.">Ajouter</a>
				<?php } ?>
			</li>

            <li>
			<!-- modif yvan 29/05/16 pagination -->
		   	<!-- si le n° de la page courante est < au nombre de page total on affiche le bouton nav droit -->
		  
            <?php  if(isset($page) && isset($nbPage) && $page < $nbPage)
            {?>	
            
				<a  href="<?= $this->url('forumListePostsN', ['techange' => "suiv", 'page' => $page]) ?>" class="sansSoulign" id="PostSuiv">Page suivante</a>
            <?php } ?>
             <!-- ============================================= -->
				
            </li>
        </ul>
   	</div>

</article>
<?php $this->stop('main_content') ?>
