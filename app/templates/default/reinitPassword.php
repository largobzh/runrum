<!-- ==================================================================================== -->
<!-- le 28/05/16 modif du titre  et site content-->
<!-- ==================================================================================== -->
<?php $this->layout('layout', ['title' => 'Réinitialiser votre mot de passe']) ?>

<?php $this->start('side_content') ?>

 <?php
    if(!empty($msg))
    {
        if (array_key_exists('info', $msg)) { ?>
        <p><?= $msg['info'] ?></p>
    <?php }} ?>  

<?php $this->stop('side_content') ?>

<!-- ==================================================================================== -->

<?php $this->start('main_content') ?>


<form class="form-horizontal" method="POST">
    <div class="form-group">


        <input type="hidden" name="form[user_id]" value=<?php 
        if(!empty($user_id)) { echo $user_id;} ?>>

        <input type="hidden" name="form[token_id]" value=<?php 
        if(!empty($token_id)) { echo $token_id;} ?>>

        <div class="form-group">

            <label for="passwordId"  class="col-sm-2 control-label">Mot de passe : </label>
            <div class="col-sm-4">
                <input  name="form[password]" type="password" id="passwordId" class="form-control"  required value=<?php 
                if(!empty($_POST['form']['password']))
                { echo $_POST['form']['password'];} ?> >
            </div>
        <?php
            if(!empty($msg)) 
            {
                foreach ($msg as $key => $value)
                {
                    if(is_array($value) && array_key_exists('password', $value))
                    {?>
                        <p><?= $value['password'] ?></p>
                    <?php } ?>    
        <?php }} ?> 

    </div>



    <div class="form-group">

        <label for="confPasswordId"  class="col-sm-2 control-label">Confirmez votre mot de passe : </label>
        <div class="col-sm-4">
            <input  name="form[confPassword]" type="password" id="confPasswordId" class="form-control" required value=<?php 
            if(!empty($_POST['form']['confPassword']))
            { echo $_POST['form']['confPassword'];} ?>>
        </div>
        <?php
        if(!empty($msg))
        {
            foreach ($msg as $key => $value) {
            if(is_array($value) && array_key_exists('confPassword', $value))
                {?>
                    <p><?= $value['confPassword'] ?></p>
                <?php } ?>  
        <?php }}?> 

    </div>


   


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button name="submit" type="submit" class="btn btn-primary" >Valider</button>
        </div>
    </div>

</form>

<?php $this->stop('main_content') ?>