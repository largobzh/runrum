<?php $this->layout('layout', ['title' => 'Ajout d\'un post' ]) ?>


  <!-- ======================= début 160528 ======================= -->
<?php $this->start('side_content') ?>
  <h3>
      Notes
  </h3>

  <p>
   Une fois connecté, vous pouvez publier un Compte-Rendu (entraînement, sortie OFF ou course), une NEWS (info sur une course à venir, bon plan matériel, etc.) ou poser une question à la communauté.
  </p> 

<?php $this->stop('side_content') ?>
  <!-- ======================= fin 160528 ======================= -->





<!-- 'erreur'=>$erreur]); -->
<!-- <p>Et maintenant, RTFM dans <strong><a href="../docs/tuto/" title="Documentation de W">docs/tuto</a></strong>.</p> -->
<!-- include -->
<?php $this->start('main_content') ?>
<article>

    <form name="fAddPost" enctype="multipart/form-data" method="POST" action="">


        <div>
            <p>
                <label for="titreId">Titre : </label>
                <input  name="form[titre]" type="text" id="titreId"  placeholder ="Le titre du post" value=<?php 
                    if(!empty($_POST['form']['titre']))
                    { echo $_POST['form']['titre'];} ?> >

                <?php
                    foreach ($msg as $key => $value) {
                        if(is_array($value) && array_key_exists('titre', $value))
                {?><p><?= $value['titre'] ?></p> <?php } ?>  
                <?php } ?> 
            </p>




<!-- ============================================================= -->

            <p>
                <label for="postId" >votre question : </label>
                <textarea  name="form[post]" id="postId" placeholder ="le détail ..." > <?php 
                    if(!empty($_POST['form']['post']))
                    { echo $_POST['form']['post'];} ?>
                </textarea>


                <?php
                    foreach ($msg as $key => $value) {
                        if(is_array($value) && array_key_exists('post', $value))
                {?><p><?= $value['post'] ?></p> <?php } ?>  
                <?php } ?> 
            </p>


<!-- ============================================================= -->
            <p>     
                <label for="date_publicationId"  >date de publication : </label>
                <input  name="form[date_publication]" type="text" id="date_publicationId" class="form-control"  disabled value=<?php 
                    if(!empty($_POST['form']['date_publication']))
                        { echo $_POST['form']['date_publication'];}
                    else { echo date('d-m-Y') ;} ?>>
            </p>

<!-- ============================================================= -->
            <p>
                <label for="type_echange_id" >Choisir une catégorie : </label>
                    <select  name="form[type_echange_id]" id="type_echange_id" >
                        <option disabled selected>Choisir</option>
                        <?php foreach ($type_echange as $value) { ?>
                        <option value="<?= $this->e($value['id']) ?>"> <?= $this->e($value['type_echange']) ?></option>
                        <?php } ?>
                    </select>
                    <?php
                        foreach ($msg as $key => $value) {
                            if(is_array($value) && array_key_exists('type_echange_id', $value))
                    {?><p><?= $value['type_echange_id'] ?></p> <?php } ?>  
                    <?php } ?> 
            </p>






<!-- ============================================================= -->
<p>
  <label for="photoId"  class="col-sm-2 control-label">Sélectionner une photo : </label>
  <div class="col-sm-4">
     <input type="file" id="photoId" name="photo"  >
  </div>

    <?php
      foreach ($msg as $key => $value) {
        if(is_array($value) && array_key_exists('photo', $value))
           {?><p><?= $value['photo'] ?></p> <?php } ?>  
       <?php } ?> 

</p>
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
  
    
</article>
<?php $this->stop('main_content') ?>