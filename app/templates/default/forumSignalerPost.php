<?php $this->layout('layout', ['title' => 'Signaler un message aux modérateurs' ]) ?>

<<?php $this->start('side_content') ?>
  <h3>Un massage d'alerte sera envoyé aux modérateurs du site.</h3>
  <p>Merci de détailler la raison du  signalement </p>
  
<?php $this->stop('side_content') ?>

<?php $this->start('main_content') ?>


<form name="fSignalerPost"  enctype="multipart/form-data" class="form-horizontal" method="POST" action="">


  <div class="form-group">
    <label for="raisonId"  class="col-sm-2 control-label">Raison : </label>
    <div class="col-sm-4">
      <input  name="form[raison]" type="text" id="raisonId" class="form-control"  value=<?php 
      if(!empty($_POST['form']['raison']))
        { echo $_POST['form']['raison'];} ?> >
    </div>

        <?php
        foreach ($msg as $key => $value) {
          if(is_array($value) && array_key_exists('raison', $value))
             {?><p><?= $value['raison'] ?></p> <?php } ?>  
         <?php } ?> 
    </div>


<!-- ============================================================= -->

<?php  if (array_key_exists('info', $msg)) { ?>
<p><?= $msg['info'] ?></p> <?php } ?>  

<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <a href="<?= $this->url('forumListePosts') ?>">Annuler</a>
     <button name="submit" type="submit" class="btn btn-primary" >Valider</button>
 </div>
</div>
</form>
  
    

<?php $this->stop('main_content') ?>