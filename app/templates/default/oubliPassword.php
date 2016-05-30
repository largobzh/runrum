<?php $this->layout('layout', ['title' => 'Oubli du mot de passe']) ?>



<?php $this->start('side_content') ?>
  <h3>
    Nouveau password
  </h3>
    
  <p>
    Procédure de redéfinission du mot de passe.
  </p>
<?php $this->stop('side_content') ?>





<?php $this->start('main_content') ?>
<article>

    <form name="foubliPassword" method="POST" action="oubliPassword">
        <div class="colonne2_3">

            <p>
                <label>En cas d'oubli :</label>
                <small>Cliquer sur le bouton 'oubli', un et remplissez le champ 'email'. Le processus sécurisé de redéfinission du mot de passe vous est alors envoyé.</small>
            </p>
        </div>


        <div class="colonne2_3">
            <p>
                <label for="emailId">Email : </label>
                <input name="form[email]" type="text" id="emailId" class="boxLogin" placeholder ="votre email" value=<?php 
                    if(!empty($_POST['form']['email']))
                        { echo $_POST['form']['email'];} ?>> 
                <?php
                    foreach ($msg as $key => $value) {
                        if(is_array($value) && array_key_exists('email', $value))
                    {?><p><?= $value['email'] ?></p> <?php } ?>  
                <?php } ?> 


                <?php  if (array_key_exists('info', $msg)) { ?>
                    <p>
                        <?= $msg['info'] ?>
                    </p>
                <?php } ?>  
            </p>

            <p>
                <ul id="navComment">
                    <li class="mod1">
                        <button name="submit" type="submit" class="sansSoulign" >Valider</button>
                    </li>
                </ul>
            </p>

        </div>
  
    </form>
</article>
<?php $this->stop('main_content') ?>





