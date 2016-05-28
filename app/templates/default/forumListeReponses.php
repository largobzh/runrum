<!-- ==================================================================================== -->
<!-- le 28/05/16 modif du titre  et site content-->
<!-- ==================================================================================== -->
<?php $this->layout('layout', ['title' => 'runrum-Forum  - Liste des réponses publiés!']) ?>

<?php $this->start('side_content') ?>
<h3>Ajoutez votre commentaire, news ou compte-rendu ou tout simplement partagez !! </h3>
	
<?php $this->stop('side_content') ?>
<!-- ========================================================================================= -->

<?php $this->start('main_content') ?>


<h2>Liste des reponses... </h2>
<?php print_r( $posts) ?>
<hr>
<?php print_r( $reponses) ?>
<hr>
<?php foreach ($posts as $post) { ?>
		<span> <?= $this->e($post['type_echange_short']) ?></span> 
		<span> <?= $this->e($post['titre']) ?></span> 

        <p>
           <?=$post['pseudo'] ?>  <?= date('j-M-Y', strtotime($post['date_publication']))  ?>  
           vues :    <?= intval($post['nbvues']) ?>
           Réponses : <?= intval($post['nbreponses'] )?>
           
        </p>
        <!-- Corps de la question -->
        <p >
            <?=$post['post'] ?>
        </p>
       
		
	<?php } ?>



<hr>
<?php foreach ($reponses as $reponse) { ?>
<p>
	<?=$reponse['reponse'] ?>
</p>

<p>
	<?=$reponse['pseudo'] ?> le <?= date('j-M-Y', strtotime($post['date_publication']))  ?> 

	<!-- ==================================================================================== -->
	<!-- le 28/05/16 ajout du bouton signaler une réponse pour un post -->
	<!-- ==================================================================================== -->
		
			<?php  if(isset($_SESSION["user"])){ ?>
				<a href="<?= $this->url('forumSignalerReponse', ['post_id' => $post['id'] , 'reponse_id' => $reponse['id']]) ?>">Signaler</a>	
			<?php } ?>
<!-- =========================fin de modif===================================================== -->
<hr>
	<?php } ?>     


<form name="fAddReponse" class="form-horizontal" method="POST" action="">


<div class="form-group">
	<label for="reponseId"  class="col-sm-2 control-label">réponse : </label>
	<div class="col-sm-4">
		<textarea  name="form[reponse]" type="text" id="reponseId" class="form-control"  > <?php 
			if(!empty($_POST['form']['reponse']))
				{ echo $_POST['form']['reponse'];} ?> 
		</textarea>
	</div>
	<?php
	foreach ($msg as $key => $value) {
		if(is_array($value) && array_key_exists('reponse', $value))
			{?><p><?= $value['reponse'] ?></p> <?php } ?>  
		<?php } ?> 
	</div>


	<?php  if (array_key_exists('info', $msg)) { ?>
	<p><?= $msg['info'] ?></p> <?php } ?>  

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">

			<a href="<?= $this->url('forumListePosts') ?>">Annuler</a>

			<?php  if(isset($_SESSION["user"]))
			{ ?>
				<button name="submit" type="submit" class="btn btn-primary" >Commenter</button>
			<?php } ?>

		</div>
	</div>



</form>
<?php $this->stop('main_content') ?>
