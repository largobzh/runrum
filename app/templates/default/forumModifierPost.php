<?php $this->layout('layout', ['title' => 'Modification d\'un post ']) ?>

<!-- 'erreur'=>$erreur]); -->
<!-- <p>Et maintenant, RTFM dans <strong><a href="../docs/tuto/" title="Documentation de W">docs/tuto</a></strong>.</p> -->
<!-- include -->
<?php $this->start('main_content') ?>

<form name="forumModifierPost" class="form-horizontal" method="POST" action="">

  <div class="form-group">
    <label for="titreId"  class="col-sm-2 control-label">Titre : </label>
    <div class="col-sm-4">
      <input  name="form[titre]" type="text" id="titreId" class="form-control"   value="<?php 
      if(!empty($_POST['form']['titre']))
        { echo $_POST['form']['titre'];} 
        elseif(!empty($post['titre'])) 
          {echo $post['titre'] ;}
         
          ?> ">
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
        <textarea  name="form[post]" id="postId" class="form-control"> <?php 
           if(!empty($_POST['form']['post']))
        { echo $_POST['form']['post'];} 
        elseif(!empty($post['post'])) 
          {echo $post['post'] ;}
         
          ?> 
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
   <input  name="form[date_publication]" type="text" id="date_publicationId" class="form-control"  disabled value=<?php 
   if(!empty($_POST['form']['date_publication']))
    { echo $_POST['form']['date_publication']; } 
    elseif(!empty($post['date_publication']))
    { echo date("d/m/Y", strtotime($post['date_publication'])) ;}
     ?> >

</div>


<label for="type_echange_id"  class="col-sm-2 control-label">Choisir une catégorie : </label>
<div class="col-sm-4">
   <select  name="form[type_echange_id]" id="type_echange_id" class="form-control">
     <option disabled selected>Choisir</option>
   <?php foreach ($type_echange as $value) { ?>
   <option  value="<?= $this->e($value['id']) ?>" <?php if ($this->e($value['id']) == $post['type_echange_id']) {
        echo "selected";
      } ?> > <?= $this->e($value['type_echange']) ?></option>
      <?php } ?>
    </select><br>
</div>


<?php
foreach ($msg as $key => $value) {
  if(is_array($value) && array_key_exists('type_echange', $value))
     {?><p><?= $value['type_echange'] ?></p> <?php } ?>  
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