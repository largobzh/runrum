<?php $this->layout('layout', ['title' => 'Inscription au carnet d’entrainement de la course à pied']) ?>

<!-- 'erreur'=>$erreur]); -->
<!-- <p>Et maintenant, RTFM dans <strong><a href="../docs/tuto/" title="Documentation de W">docs/tuto</a></strong>.</p> -->
<!-- include -->
<?php $this->start('main_content') ?>

 
<form name="finscription" class="form-horizontal" method="POST" action="inscription">
  <div class="form-group">
    <label for="emailId"   class="col-sm-2 control-label" >Email : </label>
    <div class="col-sm-4">
         <input name="form[email]" type="text" id="emailId" class="form-control" placeholder ="votre email"> 
    </div>
     <?php  if (array_key_exists('email', $erreur)) { ?>
    <p><?= $erreur['email'] ?></p> <?php } ?>  
  </div>
  



  <div class="form-group">
    <label for="passwordId"  class="col-sm-2 control-label">Mot de passe : </label>
    <div class="col-sm-4">
   		 <input  name="form[password]" type="password" id="passwordId" class="form-control" placeholder ="Saisissez votre mot de passe">
    </div>
  </div>

  <label for="pseudoId"  class="col-sm-2 control-label">Pseudo : </label>
    <div class="col-sm-4">
       <input  name="form[pseudo]" type="text" id="pseudoId" class="form-control" placeholder ="Saisissez votre pseudo">
    </div>
    <?php  if (array_key_exists('email', $erreur)) { ?>
    <p><?= $erreur['pseudo'] ?></p> <?php } ?>  
  </div>
  

    <?php  if (array_key_exists('info', $info)) { ?>
    <p><?= $info['info'] ?></p> <?php } ?>  
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
     <button name="submit" type="submit" class="btn btn-primary" >Valider</button>
    </div>
  </div>
</form>


<?php $this->stop('main_content') ?>