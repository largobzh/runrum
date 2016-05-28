<?php $this->layout('layout', ['title' => 'Inscription']) ?>





<?php $this->start('side_content') ?>
  <h3>
    Accès aux services de run|rum
  </h3>
   
  <p>
        Afin de profiter des services de run|rum, il est nécessaire de s'inscrire.
  </p>
<?php $this->stop('side_content') ?>

<!-- 'erreur'=>$erreur]); -->
<!-- <p>Et maintenant, RTFM dans <strong><a href="../docs/tuto/" title="Documentation de W">docs/tuto</a></strong>.</p> -->
<!-- include -->
<?php $this->start('main_content') ?>
<article>

<form name="finscription" class="form-horizontal" method="POST" action="">
    <div id="colonne2_3">
        <p>
            <label for="emailId" >email : </label>
            <input name="form[email]" type="text" id="emailId" class="boxLogin" placeholder ="John.Doe@domain.com" value=<?php 
         
            if(!empty($_POST['form']['email']))
                { echo $_POST['form']['email'];} ?>> 


            <?php
                foreach ($msg as $key => $value) {
                    if(is_array($value) && array_key_exists('email', $value))
            {?>
                <p>
                <?= $value['email'] ?>
                </p>
                <?php } ?>  
            <?php } ?> 
            
        </p>
    
        <p>
            <label for="passwordId" >Mot de passe : </label>
            <input  name="form[password]" type="password" id="passwordId" class="boxLogin" value="<?php 
         if(!empty($_POST['form']['password']))
            { echo $_POST['form']['password'];} ?>"  placeholder ="Votre mot de passe">
        </p>



        <p>
            <label for="pseudoId">Pseudo : </label>
            <input  class="boxLogin" name="form[pseudo]" type="text" id="pseudoId" placeholder ="Votre pseudo" value=<?php 
                
                if(!empty($_POST['form']['pseudo']))
                    { echo $_POST['form']['pseudo'];} ?> >

            <?php
                foreach ($msg as $key => $value) {
                    if(is_array($value) && array_key_exists('pseudo', $value))
                {?><p><?= $value['pseudo'] ?></p> <?php } ?>  
            <?php } ?> 

  

            <?php  if (array_key_exists('info', $msg)) { ?>
                <p>
                <?= $msg['info'] ?>
                    
                </p>
            <?php } ?>  
        </p>
    </div>

    <div id="colonne1_3">

        <p>
            <label>
                En cas d'oubli :
            </label>
            <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit iure sit ad soluta quae veniam architecto, nesciunt veritatis quod odio ipsam id accusantium voluptatibus in ipsa iste ut optio suscipit.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit iure sit ad soluta quae veniam architecto, nesciunt veritatis quod.</small>
        </p>


        <p>
            <ul id="navComment">
                <li>
                    <button name="submit" type="submit" >Valider</button>
                </li>
            </ul>
        </p>

    </div>
</form>

</article>
<?php $this->stop('main_content') ?>