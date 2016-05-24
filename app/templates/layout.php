<!DOCTYPE html>
<html lang="FR-fr">

<head>
    <meta charset="UTF-8">
<!-- TO DO : mettre le titre dynamique de la page   -->
    <title><?= $this->e($title) ?></title>
    
<!--    TO DO régler le problème de lien du favicon      -->
<!--    <link rel="icon" type="image/png" href="<?= $this->assetUrl('../img/favicon_rnm.png') ?>">-->
    
    <link href='https://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
<!--     <link rel="stylesheet" href="assets/css/main.css"> -->
    <link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/main.css') ?>">
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
            <h3>texte explicatif</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore ratione quis, consequatur quas nemo numquam excepturi nihil veniam, dolor eum dignissimos. Ipsam, non consectetur voluptatem quasi odit eos dolore ex! </p>
        </aside>

        <nav id="navigation">
           
      <!-- TO DO : mettre le titre dynamique de la page   --> 
            <h1><?= $this->e($title) ?></h1>
            
            <a href="#maison">Retour accueil</a>             
            <a href="#">Connexion on/off</a>
            <a href="#">Carnet</a>
            <a href="#">forum</a>       
   

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

</body>

</html>