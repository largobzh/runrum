<?php $this->layout('layout', ['title' => 'ajout d\'un post' ]) ?>

<!-- 'erreur'=>$erreur]); -->
<!-- <p>Et maintenant, RTFM dans <strong><a href="../docs/tuto/" title="Documentation de W">docs/tuto</a></strong>.</p> -->
<!-- include -->
<?php $this->start('main_content') ?>


<form name="fAddPost" id="fAddPost" enctype="multipart/form-data" class="form-horizontal" method="POST" action="">


  <div class="form-group">
    <label for="titreId"  class="col-sm-2 control-label">Titre : </label>
    <div class="col-sm-4">
      <input  name="form[titre]" type="text" id="titreId" class="form-control"  placeholder ="Le titre pour votre nouveau post" value=<?php 
      if(!empty($_POST['form']['titre']))
        { echo $_POST['form']['titre'];} ?> >
    </div>

        <?php
        foreach ($msg as $key => $value) {
          if(is_array($value) && array_key_exists('titre', $value))
             {?><p><?= $value['titre'] ?></p> <?php } ?>  
         <?php } ?> 
    </div>

<!-- ============================================================= -->

<div class="form-group">
    <label for="postId"  class="col-sm-2 control-label">votre question : </label>
    <div class="col-sm-4">
        <textarea  name="form[post]" id="postId" class="form-control" placeholder ="le détail ..." > <?php 
           if(!empty($_POST['form']['post']))
              { echo $_POST['form']['post'];} ?>
        </textarea>
    </div>

    <?php
    foreach ($msg as $key => $value) {
      if(is_array($value) && array_key_exists('post', $value))
         {?><p><?= $value['post'] ?></p> <?php } ?>  
     <?php } ?> 

</div>

<!-- ============================================================= -->

<label for="date_publicationId"  class="col-sm-2 control-label">date de publication : </label>
<div class="col-sm-4">
   <input  name="form[date_publication]" type="text" id="date_publicationId" class="form-control"  disabled value=<?php 
   if(!empty($_POST['form']['date_publication']))
      { echo $_POST['form']['date_publication'];}
  else { echo date('d-m-Y') ;} ?>>
</div>
<!-- ============================================================= -->

<label for="type_echange_id"  class="col-sm-2 control-label">Choisir une catégorie : </label>
<div class="col-sm-4">
   <select  name="form[type_echange_id]" id="type_echange_id" class="form-control">
     <option disabled selected>Choisir</option>
   <?php foreach ($type_echange as $value) { ?>
    <option value="<?= $this->e($value['id']) ?>"> <?= $this->e($value['type_echange']) ?></option>
    <?php } ?>
    </select><br>
</div>

<?php
foreach ($msg as $key => $value) {
  if(is_array($value) && array_key_exists('type_echange_id', $value))
     {?><p><?= $value['type_echange_id'] ?></p> <?php } ?>  
 <?php } ?> 
</div>



<!-- ============================================================= -->
<div class="form-group">
  <label for="photoId"  class="col-sm-2 control-label">Sélectionner une photo : </label>
  <div class="col-sm-4">
     <input type="file" id="photoId" name="photo" accept="image/*" >
  </div>

    <?php
      foreach ($msg as $key => $value) {
        if(is_array($value) && array_key_exists('photo', $value))
           {?><p><?= $value['photo'] ?></p> <?php } ?>  
       <?php } ?> 

</div>

 <!-- on préaffiche les photos -->
  <div class="form-group" style="margin-bottom: 0;">
  <div id="image_preview" class="col-lg-10 col-lg-offset-2">
      <div class="thumbnail hidden">
          <img src="" alt="">
          <div class="caption">
              <h4></h4>
              <p></p>
              <p><button id="image_supp" type="button" class="btn btn-default btn-danger">Annuler</button></p>
          </div>
      </div>
  </div>
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