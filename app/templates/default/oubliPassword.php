<?php $this->layout('layout', ['title' => 'Nouveau password']) ?>


<?php $this->start('side_content') ?>
  <h3>
    Password
  </h3>
    
  <p>
  Procédure de création d'un nouveau mot de passe.
  </p>
<?php $this->stop('side_content') ?>






<?php $this->start('main_content') ?>
<article>

    <form name="foubliPassword" method="POST" action="oubliPassword">
        <div class="colonne2_3">
            <p>
                <label>Envoi d'un email :</label>
                <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit iure sit ad soluta quae veniam architecto, nesciunt veritatis quod odio ipsam id accusantium voluptatibus in ipsa iste ut optio suscipit.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit iure sit ad soluta quae veniam architecto, nesciunt veritatis quod.</small>
            </p>

        </div>


  
        <div class="colonne1_3">


            <p>
   
                <label for="emailId">email : </label>
                <?php print_r($_POST['form']['email']) ?>

                <input name="form[email]" type="text" id="emailId" class="form-control" value=<?php 
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



                <?php  if (array_key_exists('info', $msg)) { ?>
                    <p>
                    <?= $msg['info'] ?>
                    </p>
                <?php } ?>  
            </p>


            <p>
                <ul id="navComment">
                    <li>
                        <button name="submit" type="submit" >Envoyer</button>
                    </li>
                </ul>
            </p>
        </div>

    </form>

</article>

<?php $this->stop('main_content') ?>






