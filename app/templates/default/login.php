<?php $this->layout('layout', ['title' => 'Connexion']) ?>



<?php $this->start('side_content') ?>
  <h3>
    Accès membres
  </h3>
    
  <p>
    Connectez-vous pour pouvoir enregistrer entraînements et compétitions dans votre carnet et pour pouvoir participer à la vie de la communauté de <span>rum</span>, notre forum.
  </p>
<?php $this->stop('side_content') ?>



<!-- Un carnet d’entrainement et un forum pour la course à pied -->

<?php $this->start('main_content') ?>
<article>

<form method="POST" action="login">
        <div class="colonne2_3">
    
            <p>
                <label>En cas d'oubli :</label>
                <small>Cliquer sur le bouton 'oubli', un et remplissez le champ 'email'. Le processus sécurisé de redéfinission du mot de passe vous est alors envoyé.</small>
            </p>

 


        </div>

        <div class="colonne1_3">

            <p>
                <label for="emailId"   id="labelDateNote">Email : </label>

                <input name="form[email]" type="text" tabindex="1" class="boxLogin"  placeholder="John.Doe@domain.com" value="<?php 
                if(!empty($_POST['form']['email']))
                    { echo $_POST['form']['email'];} ?>"> 

                <?php
                    foreach ($msg as $key => $value) {
                        if(is_array($value) && array_key_exists('email', $value))
                    {?>
                        <p><?= $value['email'] ?></p>
                    <?php } ?>  
                <?php } ?> 
            </p>


            <p>
                <label for="passwordId">Mot de passe : </label>
                <input  class="boxLogin" name="form[password]" type="password" id="passwordId" tabindex="2" value="<?php 
                    if(!empty($_POST['form']['password']))
                        { echo $_POST['form']['password'];} ?>"  placeholder ="votre mot de passe">
                    
                <?php
                foreach ($msg as $key => $value) {
                    if(is_array($value) && array_key_exists('password', $value))
                        {?><p><?= $value['password'] ?></p> <?php } ?>  
                <?php } ?> 
            </p>




  
            <?php  if (array_key_exists('info', $msg)) { ?>
            <p>
                <?= $msg['info'] ?>
            </p>
            <?php } ?>  

            <p>
                <ul id="navComment">
                    <li class="mod4">
                        <a class="sansSoulign" href="<?= $this->url('oubliPassword') ?>">Oubli</a>
                    </li>
                    
                     <li class="mod3">
                        <a class="sansSoulign" href="<?= $this->url('inscription') ?>">Inscription</a>
                    </li>
                    <li class="mod1">
                        <button class="sansSoulign" name="submit" type="submit" >Valider</button>
                    </li>

                   
                </ul>
            </p>

        </div>
  
    </form>
</article>
<?php $this->stop('main_content') ?>







