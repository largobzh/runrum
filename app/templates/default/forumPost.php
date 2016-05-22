<?php $this->layout('layout', ['title' => 'détail d\'un post ']) ?>

<!-- 'erreur'=>$erreur]); -->
<!-- <p>Et maintenant, RTFM dans <strong><a href="../docs/tuto/" title="Documentation de W">docs/tuto</a></strong>.</p> -->
<!-- include -->
<?php $this->start('main_content') ?>

<h2>Détail du post id = <?= $post['id']?></h2>
  <hr />
  <h2><?= $post['post']?></h5>
  <div>
    <?= $post['corps']?>
  </div>
  <h2><?= $post['post']?></h5>

  <hr />
  <a href="<?= $this->url('edit', ['id' => $post['id']]) ?>">editer</a>
  <a href="<?= $this->url('delete', ['id' => $post['id']]) ?>">supprimer</a>
  <a href="<?= $this->url('home') ?>">retour</a>


<form name="feditPost" class="form-horizontal" method="POST" action="">

  <div class="form-group">
    <label for="titreId"  class="col-sm-2 control-label">Titre : </label>
    <div class="col-sm-4">
      <input  name="form[titre]" type="text"  disabled id="titreId" class="form-control"   value="<?=
      $post['titre'] ?>">
    </div>
      
    </div>



<div class="form-group">
    <label for="postId"  class="col-sm-2 control-label">votre question : </label>
    <div class="col-sm-4">
        <textarea  name="form[post]" id="postId" disabled class="form-control"  > <?= 
           $post['post'] ?> 
        </textarea>
    </div>

  </div>


<label for="date_publicationId"  class="col-sm-2 control-label">date de publication : </label>
<div class="col-sm-4">
   <input  name="form[date_publication]" type="date" id="date_publicationId" class="form-control"  disabled value=<?= $post['date_publication'] ?> >
</div>


<label for="typepostId"  class="col-sm-2 control-label">Catégorie : </label>
<div class="col-sm-4">
   <select  name="form[type_echange_id]"  disabled id="typepostId" class="form-control">
     <option selected>Question / Réponse</option>
     <option >News</option>
 </select>
</div>




<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
     <button name="editpost" type="submit" class="btn btn-primary" >Valider</button>
     <button name="detepost" type="submit" class="btn btn-primary" >Valider</button>
     <button name="submit" type="submit" class="btn btn-primary" >Valider</button>
 </div>
</div>
</form>


<?php $this->stop('main_content') ?>