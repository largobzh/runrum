<?php $this->layout('layout', ['title' => 'Modification d\'un post ']) ?>

<!-- 'erreur'=>$erreur]); -->
<!-- <p>Et maintenant, RTFM dans <strong><a href="../docs/tuto/" title="Documentation de W">docs/tuto</a></strong>.</p> -->
<!-- include -->
<?php $this->start('main_content') ?>


<form name="feditPost" class="form-horizontal" method="POST" action="">

  <div class="form-group">
    <label for="titreId"  class="col-sm-2 control-label">Titre : </label>
    <div class="col-sm-4">
      <input  name="form[titre]" type="text" id="titreId" class="form-control"   value="<?=
      $post['titre'] ?>">
    </div>

        <?php
        foreach ($msg as $key => $value) {
          if(is_array($value) && array_key_exists('titre', $value))
             {?><p><?= $value['titre'] ?></p> <?php } ?>  
         <?php } ?> 
    </div>



<div class="form-group">
    <label for="postId"  class="col-sm-2 control-label">votre question : </label>
    <div class="col-sm-4">
        <textarea  name="form[post]" id="postId" class="form-control"  > <?= 
           $post['post'] ?> 
        </textarea>
    </div>

    <?php
    foreach ($msg as $key => $value) {
      if(is_array($value) && array_key_exists('post', $value))
         {?><p><?= $value['post'] ?></p> <?php } ?>  
     <?php } ?> 

</div>


<label for="date_publicationId"  class="col-sm-2 control-label">date de publication : </label>
<div class="col-sm-4">
   <input  name="form[date_publication]" type="date" id="date_publicationId" class="form-control"  disabled value=<?= $post['date_publication'] ?> >
</div>


<label for="typepostId"  class="col-sm-2 control-label">Catégorie : </label>
<div class="col-sm-4">
   <select  name="form[type_echange_id]" id="typepostId" class="form-control">
     <option selected>Question / Réponse</option>
     <option >News</option>
 </select>
</div>


<?php
foreach ($msg as $key => $value) {
  if(is_array($value) && array_key_exists('typepost', $value))
     {?><p><?= $value['typepost'] ?></p> <?php } ?>  
 <?php } ?> 
</div>


<?php  if (array_key_exists('info', $msg)) { ?>
<p><?= $msg['info'] ?></p> <?php } ?>  

<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
     <button name="submit" type="submit" class="btn btn-primary" >Valider</button>
 </div>
</div>
</form>


<?php $this->stop('main_content') ?>