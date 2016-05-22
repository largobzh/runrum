<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>
	<h2>Let's code.</h2>
	<p>Vous avez atteint la page d'accueil. Bravo.</p>
	<p>Et maintenant, RTFM dans <strong><a href="../docs/tuto/" title="Documentation de W">docs/tuto</a></strong>.</p>

	<?php  if (array_key_exists('info', $msg) && isset($_SESSION['user']['pseudo']))
	{ 
    	echo $_SESSION["user"]['pseudo'] . ", " .$msg['info'];
    }
    elseif (array_key_exists('info', $msg) && !isset($_SESSION['user']['pseudo']))
    {
      echo $msg['info'] ;
    }
    ?>  
<?php $this->stop('main_content') ?>
