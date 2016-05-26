<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>

	<a class="styleBouton" href="runrum/forumListePosts">run</a>
	<a class="styleBouton" href="/forumListePosts">rum</a>
	<!--<p>run</p>-->
	<!--<p>rum</p>-->



<?php $this->stop('main_content') ?>







<?php $this->start('side_content') ?>



<?php if(isset($msg) && array_key_exists('info', $msg))
	{
		echo $msg['info'];
	}
	?>

<?php $this->stop('side_content') ?>
