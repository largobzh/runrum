<?php $this->layout('layout', ['title' => 'Modification d\'un post ']) ?>

<!-- 'erreur'=>$erreur]); -->
<!-- <p>Et maintenant, RTFM dans <strong><a href="../docs/tuto/" title="Documentation de W">docs/tuto</a></strong>.</p> -->



<?php $this->start('side_content') ?>
    <h3>
        Comment modifier des posts :
    </h3>

    <p>
        Rien de plus simple, il n'y a qu'à modifier les champs souhaités et valider.
    </p> 
  
<?php $this->stop('side_content') ?>



<!-- include -->
<?php $this->start('main_content') ?>
<article>

    <form method="POST" action="">

        <div>
            <p>
                <!-- champ caché -->
                <input type="hidden" name="form[post_id]" value=<?php 
                    if(!empty($_POST['form']['post_id']))
                        { echo trim($_POST['form']['post_id']);} 
                    elseif(isset($post['id'])) 
                        {echo trim($post['id']) ;}
                    ?> 
            </p>

            <p>
                <label for="titreId">Titre : </label>
                <input  name="form[titre]" type="text" id="titreId" class="fondForum" value="<?php 
                    if(!empty($_POST['form']['titre']))
                        { echo $_POST['form']['titre'];} 
                    elseif(isset($post['titre'])) 
                        {echo $post['titre'] ;} ?>">
                <?php
                    foreach ($msg as $key => $value) {
                        if(is_array($value) && array_key_exists('titre', $value))
                {?><p><?= $value['titre'] ?></p> <?php } ?>  
                <?php } ?> 
            </p> 

            <p>
                <label for="posteId">votre question : </label>
                <textarea  name="form[post]" id="postId" class="fondForum"><?php 
                    if(!empty($_POST['form']['post']))
                        { echo trim($_POST['form']['post']);} 
                    elseif(isset($post['post'])) 
                        {echo trim($post['post']) ;}?></textarea>
                <?php
                    foreach ($msg as $key => $value) {
                        if(is_array($value) && array_key_exists('post', $value))
                {?><p><?= $value['post'] ?></p> <?php } ?>  
                <?php } ?> 
            </p>


<!-- ============================================================= -->
            <div class="enLigne">

            <p>  
                <label for="date_publicationId">Date de publication : </label>
                <input  name="form[date_publication]" type="text" id="date_publicationId" class="fondForum"  readonly="readonly" value=<?php 
                    if(!empty($_POST['form']['date_publication']))
                        { echo $_POST['form']['date_publication']; } 
                    elseif(isset($post['date_publication'])) 
                        { echo date("d/m/Y", strtotime($post['date_publication'])) ;} ?> >
            </p>

            <p>
                <label for="type_echange_id">Choisir une catégorie : </label>
                <select  name="form[type_echange_id]" id="type_echange_id" class="fondForum">
                    <option disabled selected>Choisir</option>
                    <?php foreach ($type_echange as $value) { ?>
                    <option  value="<?= $this->e($value['id']) ?>" <?php 
                        if(isset($post))
                            {
                                if($this->e($value['id']) == $post['type_echange_id']) {echo "selected";}
                            }
                            else
                            {
                            if($this->e($value['id']) == $_POST['type_echange_id']) {echo "selected";}
                            } ?> > <?= $this->e($value['type_echange']) ?></option>
                        <?php } ?>
                </select>
            </p>

            </div>

<!-- ============================================================= -->
            <div class="enLigne">
                <p>
                    <?php
                    foreach ($msg as $key => $value) {
                        if(is_array($value) && array_key_exists('type_echange', $value))
                        {?>
                            <p>
                                <?= $value['type_echange'] ?>   
                            </p> <?php } ?>  
                                <?php } ?> 

                    <?php
                        if (array_key_exists('info', $msg)) { ?>
                            <p>
                                <?= $msg['info'] ?>
                            </p>
                                <?php } ?>  
                </p>

            </div>


<!--                 <p>
                    <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit iure sit ad soluta quae veniam architecto, nesciunt veritatis quod odio ipsam id accusantium voluptatibus in ipsa iste ut optio suscipit.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit iure sit ad soluta quae veniam architecto, nesciunt veritatis quod.</small>
                </p> -->


            <div>
                <ul id="navComment">

                    <li>
                        <a href="<?= $this->url('forumListePosts') ?>" class="sansSoulign">Annuler</a>
                    </li>
                    <li>
                       <!--  <input type="submit" name="submit" value="Valider"> -->
                        <button name="submit" type="submit" >Valider</button>
                    </li>
                </ul>
            </div>

        </div>
    </form>

</article>
<?php $this->stop('main_content') ?>







