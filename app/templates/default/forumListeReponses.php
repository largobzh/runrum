<!-- ==================================================================================== -->
<!-- le 28/05/16 modif du titre  et site content-->
<!-- ==================================================================================== -->

<?php $this->layout('layout', ['title' => 'Forum  - Liste des réponses']) ?>

<?php $this->start('side_content') ?>
<h3>Ajoutez votre commentaire,</h3>
<p>news ou compte-rendu ou tout simplement partagez !! </p>


<?php $this->stop('side_content') ?>
<!-- ========================================================================================= -->

<?php $this->start('main_content') ?>
<article>


	<?php foreach ($posts as $post) { ?>


	<div id="apercuPosts">
                 
  		<div class="postListe">


			<h4 class="couleurCR">
				<span>[<?= $this->e($post['type_echange_short']) ?>]</span><a id="lienTitrePost" ><?= $this->e($post['titre']) ?></a>
			</h4>


    		<!-- Corps de la question -->
    		<p >
        		<?=$post['post'] ?>
    		</p>
       

			<div>
        		<ul id="renseignPost">
            		<li class="infosPost2 mod3">Auteur : <?=$post['pseudo'] ?></li>

	            	<li class="infosPost2 mod3"><?= date('j-M-Y', strtotime($post['date_publication']))  ?></li>
    	        	<li class="infosPost2 mod3">Nbre réponses : <?= intval($post['nbreponses'] )?></li>
        	    	<li class="infosPost2 mod3">Vues : <?= intval($post['nbvues']) ?></li>
            	</ul>
   			</div>
		
	<?php } ?>
   		</div>

	</div>


<!-- // todo : insérer les photos ici -->


<?php foreach ($reponses as $reponse) { ?>
	<div id="apercuReponses">
		<p class="textReponse">
			<?=$reponse['reponse'] ?>
		</p>


		<div  class="reponses">
    		<ul id="renseignPost" class="couleurreponses">
        		<li class="infosPost2 mod3">Par : <?=$reponse['pseudo'] ?></li>

            	<li class="infosPost2 mod3">Le : <?= date('j-M-Y', strtotime($post['date_publication']))  ?></li>
            	<li class="infosPost2 mod3">&thinsp;</li>
            	<li class="infosPost2 mod3">&thinsp;</li>
            	<li class="infosPost2 mod3">
						<?php  if(isset($_SESSION["user"])){ ?>
							<a class="sansSoulign" href="<?= $this->url('forumSignalerReponse', ['post_id' => $post['id'] , 'reponse_id' => $reponse['id']]) ?>">Signaler</a>
						<?php } ?>
				</li>


        	</ul>
		</div>
	</div>
<?php } ?> 





    

<div>
<form name="fAddReponse" class="form-horizontal" method="POST" action="">


	<div>
		<p>
			<label for="commentText" id="labelCommentText">Réponse :</label>
			<textarea name="form[reponse]" type="text" id="commentText" tabindex="5" class="fondZoneComment"><?php 
				if(!empty($_POST['form']['reponse']))
				{ echo $_POST['form']['reponse'];} ?></textarea>
		</p>


		<?php
		foreach ($msg as $key => $value) {
			if(is_array($value) && array_key_exists('reponse', $value))
				{?><p><?= $value['reponse'] ?></p> <?php } ?>  
		<?php } ?> 
	

		<p>
		<?php  if (array_key_exists('info', $msg)) { ?>
			<p><?= $msg['info'] ?></p>
		<?php } ?>  
		</p>
	<div>

	</div>
		<p>
			<small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit iure sit ad soluta quae veniam architecto, nesciunt veritatis quod odio ipsam id accusantium voluptatibus in ipsa iste ut optio suscipit.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit iure sit ad soluta quae veniam architecto, nesciunt veritatis quod.</small>
		</p>

<!-- modif affichage pages -->
		<p>
            <ul id="navComment">
			

                <li>
                	<a class="sansSoulign" href="<?= $this->url('forumListePosts') ?>">Annuler</a>
            	</li>

                <li>
                	<?php  if(isset($_SESSION["user"])){ ?>
						<button name="submit" type="submit" class="sansSoulign" >Commenter</button>
                	<?php  } ?>
                </li>

            </ul>
		</p>


	</div>
</form>
</div>

</article>
<?php $this->stop('main_content') ?>


