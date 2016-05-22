<?php $this->layout('layout', ['title' => 'Un carnet d’entrainement et un forum pour la course à pied']) ?>


<?php $this->start('main_content') ?>


<form name="flogin" class="form-horizontal" method="POST" action="reinitPassword">
  <div class="form-group">
    
  <input type="hidden" name="form[user_id]" value=<?php 
           if(!empty($GET['user_id'])) { echo $_GET['user_id'] ;} ?>
  
  <div class="form-group">
    
    <label for="passwordId"  class="col-sm-2 control-label">Mot de passe : </label>
    <div class="col-sm-4">
       <input  name="form[password]" type="password" id="passwordId" class="form-control"  value=<?php 
         if(!empty($_POST['form']['password']))
            { echo $_POST['form']['password'];} ?>  require placeholder ="Saisissez votre mot de passe">
    </div>
  <?php
  foreach ($msg as $key => $value) {
    if(is_array($value) && array_key_exists('password', $value))
     {?><p><?= $value['password'] ?></p> <?php } ?>  
  <?php } ?> 

  </div>



<div class="form-group">
    
    <label for="confPasswordId"  class="col-sm-2 control-label">Confirmez votre mot de passe : </label>
    <div class="col-sm-4">
       <input  name="form[confPassword]" type="password" id="confPasswordId" class="form-control"  value=<?php 
         if(!empty($_POST['form']['confPassword']))
            { echo $_POST['form']['confPassword'];} ?> require placeholder ="Ressaisissez votre mot de passe">
    </div>
  <?php
  foreach ($msg as $key => $value) {
    if(is_array($value) && array_key_exists('confPassword', $value))
     {?><p><?= $value['confPassword'] ?></p> <?php } ?>  
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