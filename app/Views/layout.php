<!DOCTYPE html>

<html lang="fr">
<head>
	<title><?= $this->e($title)?> </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- $this->assetUrl('css/reset.css') vaudra 'assets/css/reset.css' -->

	<link rel="stylesheet" href="<?= $this->assetUrl('css/reset.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css'); ?>" type="text/css" />
</head>
<body>
	<header>
		<h1><?= $this->e($title) ?></h1>
	</header>
	<aside>
		<h3><a href="<?= $this->url('default_home');?> " title="Revenir à l'acceuil du site">Les salons</a></h3>
		<nav>
		    <ul id="menu-salons">

		    <?php foreach ($salons as  $salon) : ?>
		        <!-- ici $salon est équivalent à $salons[$id] dans la boucle for -->
		        <!-- mon href va pointer vers une nouvelle page (salon.php)
		           dans laquelle je vais pouvoir récupérer ma variable "id" 
		            grâce à $_GET['id']
		        -->
		        <li> <a href="<?php  echo $this->url('view_salon', array('id'=>$salon['id'])) ?>"><?php echo $this->e($salon['nom']); ?></a> </li>
		    <?php endforeach; ?>
			    <li>
				    <a href="<?= $this->url('users_list') ?>" title="Liste des utilisateurs ">Liste des utilisateurs</a>		    	
			    </li>
			    <li>
			    	<a href="<?php echo $this->url('logout');?>" title="Se deconnecter de T'chat">Deconnexion</a>		    	
			    </li>
		    </ul>
		</nav>
	</aside><main>
	<section>
		<?= $this->section('main_content') ?>
	</section>
	</main>
	<footer>
	</footer>
	<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="<?php echo $this->assetUrl('js/close-flash-messages.js'); ?>"></script>
</body>
</html>