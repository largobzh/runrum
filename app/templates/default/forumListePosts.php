<?php $this->layout('layout', ['title' => 'rum : liste']) ?>

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
