<?php $this->layout('layout', ['title' => 'Ajout d\'un post' ]) ?>


  <!-- ======================= début 160528 ======================= -->
<?php $this->start('side_content') ?>
    <h3>
        Notes
    </h3>

    
    <p>
        Une fois connecté, vous pouvez publier un Compte-Rendu (entraînement, sortie OFF ou course), une NEWS (info sur une course à venir, bon plan matériel, etc.) ou poser une question à la communauté.
    </p> 

<?php $this->stop('side_content') ?>
  <!-- ======================= fin 160528 ======================= -->


    


<!-- 'erreur'=>$erreur]); -->
<!-- <p>Et maintenant, RTFM dans <strong><a href="../docs/tuto/" title="Documentation de W">docs/tuto</a></strong>.</p> -->
<!-- include -->
<?php $this->start('main_content') ?>
<article>

    <form name="fAddPost" enctype="multipart/form-data" method="POST" action="">


        <div>
            <p>
                <label for="titreId">Titre : </label>
                <input  name="form[titre]" type="text" id="titreId"  class="fondForum"placeholder ="Titre du post" value=<?php 
                    if(!empty($_POST['form']['titre']))
                    { echo $_POST['form']['titre'];} ?> >

                <?php
                    foreach ($msg as $key => $value) {
                        if(is_array($value) && array_key_exists('titre', $value))
                {?><p><?= $value['titre'] ?></p> <?php } ?>  
                <?php } ?> 
            </p>




<!-- ============================================================= -->

            <p>
                <label for="postId" >Votre question : </label>
                <textarea  name="form[post]" class="fondForum" id="postId" ><?php 
                    if(!empty($_POST['form']['post']))
                    { echo $_POST['form']['post'];} ?></textarea>


                <?php
                    foreach ($msg as $key => $value) {
                        if(is_array($value) && array_key_exists('post', $value))
                {?><p><?= $value['post'] ?></p> <?php } ?>  
                <?php } ?> 
            </p>


<!-- ============================================================= -->

            <div class="enLigne">

            <p>     
                <label for="date_publicationId"  >Date de publication : </label>
                <input  name="form[date_publication]" type="text" class="fondForum" id="date_publicationId"  disabled value=<?php 
                    if(!empty($_POST['form']['date_publication']))
                        { echo $_POST['form']['date_publication'];}
                    else { echo date('d-m-Y') ;} ?>>
            </p>

<!-- ============================================================= -->
            <p>
                <label for="type_echange_id" >Choisir une catégorie : </label>
                    <select  name="form[type_echange_id]" class="fondForum" id="type_echange_id" >
                        <option disabled selected>Choisir</option>
                        <?php foreach ($type_echange as $value) { ?>
                        <option value="<?= $this->e($value['id']) ?>"> <?= $this->e($value['type_echange']) ?></option>
                        <?php } ?>
                    </select>
                    <?php
                        foreach ($msg as $key => $value) {
                            if(is_array($value) && array_key_exists('type_echange_id', $value))
                    {?><p><?= $value['type_echange_id'] ?></p> <?php } ?>  
                    <?php } ?> 
            </p>


            </div>

<!-- ============================================================= -->
            <div class="enLigne">

                <p>
                    <label for="photoId">Sélectionner une photo : </label>
                    <input type="file" id="photoId" name="photo" class="fondForum">

                    <?php
                        foreach ($msg as $key => $value) {
                            if(is_array($value) && array_key_exists('photo', $value))
                    {?>
                        <p>
                            <?= $value['photo'] ?>
                        </p>
                        <?php } ?>  
                    <?php } ?> 
                </p>
<!-- ============================================================= -->


                    <?php  if (array_key_exists('info', $msg)) { ?>
                <p>
                    <?= $msg['info'] ?>
                </p>
                    <?php } ?>  



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
                        <input type="submit" name="submit" value="Valider">
                    </li>
                </ul>
            </div>



        </div>

    </form>
  
    
</article>
<?php $this->stop('main_content') ?>








