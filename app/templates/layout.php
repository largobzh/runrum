<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	<link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/dist/sweetalert.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('newerton/fancy-box/source/jquery.fancybox.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
</head>
<body>
	<div class="container">
		<header>
			<h1>W :: <?= $this->e($title) ?></h1>
		</header>

		<section>
			<?= $this->section('main_content') ?>
		</section>

		<footer>
		</footer>
	</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>   
<script>window.jQuery || document.write('<script src="<?= $this->assetUrl('js/vendor/jquery-2.2.4.min.js')?>"><\/script>')</script> 
<script src="<?= $this->assetUrl('css/dist/sweetalert.min.js')?>"></script>

<script src="<?= $this->assetUrl('newerton/fancy-box/source/jquery.fancybox.pack.js')?>"</script>
<script src="<?= $this->assetUrl('newerton/fancy-box/lib/jquery.mousewheel.pack.js')?>"></script>

<script src="<?= $this->assetUrl('js/main.js')?>"></script>  
</body>
</html>