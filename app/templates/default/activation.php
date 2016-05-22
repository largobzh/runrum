<?php $this->layout('layout', ['title' => 'activation de votre compte']) ?>

<!-- 'erreur'=>$erreur]); -->
<!-- <p>Et maintenant, RTFM dans <strong><a href="../docs/tuto/" title="Documentation de W">docs/tuto</a></strong>.</p> -->
<!-- include -->
<?php $this->start('main_content') ?>


<form name="factivation" class="form-horizontal" method="POST" action="inscription">

<input type="hidden" name="form[user_id]" value=<?php 
           if(!empty($GET['user_id'])) { echo $_GET['user_id'] ;} ?>

           
  <div class="form-group">
    <label for="emailId"   class="col-sm-2 control-label" >Email : </label>
    <div class="col-sm-4">
         <input name="form[email]" type="text" disabled id="emailId" class="form-control" 
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

<?php  if (array_key_exists('info', $msg)) { ?>
    <p><?= $msg['info'] ?></p> <?php } ?>  
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
     <button name="submit" type="submit" class="btn btn-primary" >Activer</button>
    </div>
  </div>
</form>






<?php $this->stop('main_content') ?>