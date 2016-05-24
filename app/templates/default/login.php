<?php $this->layout('layout', ['title' => 'Un carnet d’entrainement et un forum pour la course à pied']) ?>



<!-- <p>Et maintenant, RTFM dans <strong><a href="../docs/tuto/" title="Documentation de W">docs/tuto</a></strong>.</p> -->
<!-- include -->
<?php $this->start('main_content') ?>


Username : <input type="text" name="myform[username]"><br />
  Password <input type="password" name="myform[password]"><br />
  <input type="submit" name="create" value="Valider">

<form name="flogin" class="form-horizontal" method="POST" action="">
  <div class="form-group">
    
    <label for="emailId"   class="col-sm-2 control-label" >Email : </label>
    <div class="col-sm-4">
         <input name="flogin[email]" type="text" id="emailId" class="form-control" placeholder ="votre email"> 
    </div>
  </div>
  <div class="form-group">
    
    <label for="passwordId"  class="col-sm-2 control-label">Mot de passe : </label>
    <div class="col-sm-4">
   		 <input  name="flogin[password]" type="password" id="passwordId" class="form-control" placeholder ="Saisissez votre mot de passe">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
     <button name="flogin[submit]" type="submit" class="btn btn-primary" >Valider</button>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
     <button name="flogin[inscription]" type="submit" class="btn btn-primary" >S'inscrire</button>
    </div>
  </div>
</form>

<?php $this->stop('main_content') ?>