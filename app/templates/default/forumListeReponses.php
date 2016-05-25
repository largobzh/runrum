<?php $this->layout('layout', ['title' => 'Listes des réponses !']) ?>


<?php $this->start('main_content') ?>


<h2>Liste des reponses... </h2>

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




<!-- // todo : insérer les photos ici -->



<hr>
<?php foreach ($reponses as $reponse) { ?>
<p>
	<?=$reponse['reponse'] ?>
</p>

<p>
	<?=$reponse['pseudo'] ?> le <?= date('j-M-Y', strtotime($post['date_publication']))  ?> 
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
			<button name="submit" type="submit" class="btn btn-primary" >Commenter</button>
		</div>
	</div>
</form>
<?php $this->stop('main_content') ?>
