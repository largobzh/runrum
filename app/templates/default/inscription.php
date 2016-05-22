<?php $this->layout('layout', ['title' => 'Inscription au carnet d’entrainement de la course à pied']) ?>

<!-- 'erreur'=>$erreur]); -->
<!-- <p>Et maintenant, RTFM dans <strong><a href="../docs/tuto/" title="Documentation de W">docs/tuto</a></strong>.</p> -->
<!-- include -->
<?php $this->start('main_content') ?>


<form name="finscription" class="form-horizontal" method="POST" action="inscription">
  <div class="form-group">
    <label for="emailId"   class="col-sm-2 control-label" >Email : </label>
    <div class="col-sm-4">
         <input name="form[email]" type="text" id="emailId" class="form-control" 
         placeholder ="Votre email" value=<?php 
         if(!empty($_POST['form']['email']))
            { echo $_POST['form']['email'];} ?>> 

    </div>
    <?php
    foreach ($msg as $key => $value) {
      if(is_array($value) && array_key_exists('email', $value))
       {?><p><?= $value['email'] ?></p> <?php } ?>  
    <?php } ?> 
  </div>
  


  <div class="form-group">
    <label for="passwordId"  class="col-sm-2 control-label">Mot de passe : </label>
    <div class="col-sm-4">
   		 <input  name="form[password]" type="password" id="passwordId" class="form-control"  value=<?php 
         if(!empty($_POST['form']['password']))
            { echo $_POST['form']['password'];} ?>  placeholder ="Votre mot de passe">
    </div>
  </div>



  <label for="pseudoId"  class="col-sm-2 control-label">Pseudo : </label>
    <div class="col-sm-4">
       <input  name="form[pseudo]" type="text" id="pseudoId" class="form-control"  placeholder ="Votre pseudo"
         value=<?php 
         if(!empty($_POST['form']['pseudo']))
            { echo $_POST['form']['pseudo'];} ?> >
    </div>


  <?php
    foreach ($msg as $key => $value) {
      if(is_array($value) && array_key_exists('pseudo', $value))
       {?><p><?= $value['pseudo'] ?></p> <?php } ?>  
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