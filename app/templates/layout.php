<!DOCTYPE html>
<html lang="FR-fr">

<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/dist/sweetalert.css') ?>">
<!-- TO DO : mettre le titre dynamique de la page   -->
    <title><?= $this->e($title) ?></title>
    <!--    TO DO régler le problème de lien du favicon      -->
<link rel="icon" type="image/png" href="<?= $this->assetUrl('img/favicon_rnm.png') ?>">
    
    <link href='https://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
<!--     <link rel="stylesheet" href="assets/css/main.css"> -->
    <link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/main.css') ?>">
<!-- utile pour le forum , affiche les photos en modale -->
    <link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('newerton/fancy-box/source/jquery.fancybox.css') ?>">
</head>

<body>
    <header>
        <h2 id="maison">run<span>|</span>rum</h2>
    </header>

    <main class="wrapper">
       
<!--   zone d'inclusion des templates alternatifs selon routes    -->
       
        <section class="content">
			
			<?= $this->section('main_content') ?>
		
        </section>
        
<!-- fin de zone d'inclusion des templates alternatifs selon routes -->
       
       
        <aside>
            
            <?= $this->section('side_content') ?>
            
        </aside>

        <nav id="navigation">
           
      <!-- TO DO : mettre le titre dynamique de la page   --> 
            <h1><?= $this->e($title) ?></h1>
            
            <a href="<?=$this->url('home') ?>">Retour accueil</a>             
            <a href="<?=$this->url('login') ?>">Connexion on/off</a>
            <a href="<?=$this->url('afficherCarnet') ?>">Carnet</a>
            <a href="<?=$this->url('forumListePosts') ?>">forum</a>     
   

        </nav>


    </main>

    <footer>
           <div>
           <span>&copy; Y. le Brigand, M. Thiam, t. mezenge | WF3 | 2016 • </span>
            <a href="#">FAQ</a>
            <span> • </span>
            <a href="#">À propos</a>
            <span> • </span>
            <a href="#">Contact</a>
            </div>
            
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?= $this->assetUrl('js/vendor/jquery-2.2.4.min.js')?>"><\/script>')</script>
    <script src="<?= $this->assetUrl('css/dist/sweetalert.min.js')?>"></script> 

    <!-- yvan  utile pour le forum , affiche les photos en modale -->
    <script src="<?= $this->assetUrl('newerton/fancy-box/source/jquery.fancybox.pack.js')?>"</script>
    <script src="<?= $this->assetUrl('newerton/fancy-box/lib/jquery.mousewheel.pack.js')?>"</script>

    <script src="<?= $this->assetUrl('js/main.js')?>"></script> 

</body>

</html>