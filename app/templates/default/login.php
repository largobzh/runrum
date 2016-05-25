<?php $this->layout('layout', ['title' => 'Un carnet d’entrainement et un forum pour la course à pied']) ?>


<?php $this->start('main_content') ?>


<form class="form-horizontal" method="POST" action="login">
  <div class="form-group">
    

     
    <label for="emailId"   class="col-sm-2 control-label" >Email : </label>
    <div class="col-sm-4">

 <input name="form[email]" type="text" id="emailId" class="form-control" 
         placeholder ="votre email" value=<?php 
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
            { echo $_POST['form']['password'];} ?>  placeholder ="votre mot de passe">
    </div>
  <?php
  foreach ($msg as $key => $value) {
    if(is_array($value) && array_key_exists('password', $value))
     {?><p><?= $value['password'] ?></p> <?php } ?>  
  <?php } ?> 

  </div>
  
 <?php  if (array_key_exists('info', $msg)) { ?>
    <p><?= $msg['info'] ?></p> <?php } ?>  

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">

  <a href="<?= $this->url('oubliPassword') ?>">Mot de passe oublé</a>
     <button name="submit" type="submit" class="btn btn-primary" >Valider</button>
    </div>
  </div>
  
</form>

<?php $this->stop('main_content') ?>