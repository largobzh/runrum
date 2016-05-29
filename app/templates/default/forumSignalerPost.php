<?php $this->layout('layout', ['title' => 'Signalement' ]) ?>

<?php $this->start('side_content') ?>
    <h3>
        Envoi d'un massage d'alerte.
    </h3>
    <p>
        Si vous remarquez un post inapproprié, merci de décrire les raisons de ce signalement, un message sera envoyé aux modérateurs de run|rum.
    </p>
<?php $this->stop('side_content') ?>
<!-- ============================================================= -->
<?php $this->start('main_content') ?>
<article>

    <form name="fSignalerPost"  enctype="multipart/form-data" method="POST" action="">

        <div>
            <!-- on stocke l'id du post pour réafficher toutes les réponses de ce post -->
            <p>
                <input type="hidden" name="form[post_id]" class="fondForum" value=<?php 
                    if(!empty($_POST['form']['post_id']))
                        { echo trim($_POST['form']['post_id']);} 
                    elseif(isset($post)) 
                        {echo $post ;}?>>
            </p>
<!-- ============================================================= -->

            <p>
                <label for="raisonId" >Raison : </label>
                <textarea name="form[raison]" type="text" id="raisonId" class="fondForum" ><?php 
                    if(!empty($_POST['form']['raison']))
                        { echo $_POST['form']['raison'];} ?></textarea>


                <?php
                    foreach ($msg as $key => $value) {
                        if(is_array($value) && array_key_exists('raison', $value)){?>
                                <p>
                                    <?= $value['raison'] ?>     
                                </p>
                                    <?php } ?>  
                <?php } ?> 
            </p>

                <?php  if (array_key_exists('info', $msg)) { ?>
            <p>
                <?= $msg['info'] ?>
            </p>
                <?php } ?>  



<!-- ============================================================= -->
            <div class="enLigne">


                <ul id="navComment">

                    <li>
                        <a href="<?= $this->url('forumListePosts') ?>" class="sansSoulign">Annuler</a>
                    </li>
                    <li>
                        <input type="submit" name="submit" value="Valider">
                    </li>
                </ul>
            </div>

        </div>
    </form>
  
    
</article>
<?php $this->stop('main_content') ?>





